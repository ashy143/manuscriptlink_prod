<?php
    
    include_once './includes/config.php';
    include_once './includes/functions.php';
    include_once './utils/process_search.php';
    include_once './data_models/CodicologicalQuery.php';
    include_once './data_models/BibliographicalQuery.php';
    include_once './utils/SearchTermsMap.php';
    
    session_start();    
    if (login_check() == true) {
        $logged = 'in';
    } else {
        $logged = 'out';
    }   
    
    $tableName = "folios";
    $con = mysql_connect(HOST.':'.PORT, USER, PASSWORD) or die("Unable to connect to MySQL");
    mysql_select_db(DATABASE, $con) or die("Could not select" .mysql_error());

    if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }else{    
        $biblioQueries = array();
        for ( $i = 1; $i < 5; $i++ ) {
           $biblioQuery = new BibliographicalQuery();
           if($_GET["bibliographical".$i]==''){
               continue;
           }
           if(  count($biblioQueries) > 0 || (strcasecmp($_GET["bibliographicalLog".$i ], 'NOT') == 0)){
               $biblioQuery->logic = $_GET["bibliographicalLog".$i ]; 
           }
           $biblioQuery->term = $_GET["bibliographical".$i];
           $biblioQueries[] = $biblioQuery;
        }
        
        
        $codologQueries = array();
        for ( $i = 1; $i < 8; $i++ ) {
            $codologQuery = new CodicologicalQuery();
            if($_GET["codicologicalTerm".$i]=='NA'){
                continue;
            }
            if( count($codologQueries) > 0  ||  (strcasecmp($_GET["codicologicalLogic".$i ], 'NOT') == 0) ){
                $codologQuery->logic = $_GET["codicologicalLogic".$i ]; 
            }
            $codologQuery->min = $_GET["codicologicalMin".$i]; 
            $codologQuery->max = $_GET["codicologicalMax".$i ]; 
            $codologQuery->term = $_GET["codicologicalTerm".$i];
            $codologQueries[] = $codologQuery;

        }
         //build where class
        $bibQueryStr = '';        
        $count = 0; //for first term if user selected  not then we have to search for NOT LIKE
        foreach($biblioQueries as $bib){
            $like = 'LIKE';
            if(strcasecmp($bib->logic , 'NOT') == 0){
                if($count == 0){
                    $bib->logic = '';
                }else{
                    $bib->logic = 'AND';
                }                
                $like = 'NOT LIKE';
            }
            
            $bibQueryStr.= $bib->logic . " CONCAT (fol.title, fol.author, fol.folio_contents, fol.coll_admin, fol.col_staff, fol.faculty_liason, fol.meta_catag, fol.scan_tech, "
                    ." ms.artist, ms.bibliography, ms.century, ms.collation, ms.date_manuscript, ms.decoration, ms.edition_cited, ms.language, ms.liturgicaluse, ms.miniatures,"
                    . " ms.publisher_digital, ms.writing_support, ms.ruling_medium, ms.ruling_pattern, ms.schoenberg_num, ms.text_contents, ms.text_type, ms.writing_support, " 
                    ." ori.country, ori.institution, ori.commagent, ori.municipality, ori.region, ori.state,"
                    ." loc.callno, loc.collection, loc.country, loc.division, loc.institution, loc.municipality, loc.series, loc.state  )"
                    . $like ."  '%" . $bib->term . "%' " ;
        
            $count++;    
        }
        
        
        $codQueryStr = '';
        $count = 0;
        foreach($codologQueries as $cod){            
            $between = 'BETWEEN';
            if(strcasecmp($cod->logic , 'NOT') == 0){
                error_log("came for not between ");
                //if the not is selected for first term then we should not append AND in where clause because querry will be " WHERE AND "
                if($count == 0){
                    $cod->logic = '';
                }else{
                    $cod->logic = 'AND';
                }
                $between = 'NOT BETWEEN';                
            }
            $codQueryStr.= " " . $cod->logic . " " . $cod->term . "  " . $between . " " .$cod->min .  " AND "  .$cod->max ;
            $count++;
        }
        
        $query_place_holder = "SELECT ms.mscript_id, fol.title, fol.height, fol.width, fol.height_written, fol.width_written, fol.no_of_lines, fol.dim_staff "
                    ." FROM "
                ." (manuscript AS ms INNER JOIN origin AS ori ON ms.mscript_id = ori.mscript_id) "
                    ." INNER JOIN "
                ." (folios AS fol INNER JOIN location AS loc ON fol.folio_id = loc.folio_id )"
                    . " ON ms.mscript_id = fol.mscript_id ";
        
        if(count($biblioQueries) < 1 && count($codologQueries) < 1){        
            $query_place_holder .= " " ;
            $query = sprintf("$query_place_holder ", $bibQueryStr, $codQueryStr );
        }else if(count($biblioQueries) > 0 && count($codologQueries) > 0){
            $query_place_holder .= " WHERE %s  AND ( %s )" ;
            $query = sprintf("$query_place_holder ", $bibQueryStr, $codQueryStr );
        }else if(count($biblioQueries) < 1){
            $query_place_holder .= " WHERE %s  " ;
            $query = sprintf("$query_place_holder ", $codQueryStr );
        }else if(count($codologQueries) < 1){
            $query_place_holder .= " WHERE %s  " ;
            $query = sprintf("$query_place_holder ", $bibQueryStr );
        }
        
        $query = sprintf("$query_place_holder ", $bibQueryStr, $codQueryStr );
        $query .= " GROUP BY ms.mscript_id ";
        error_log($query);
        $result = mysql_query($query) or die(mysql_error());
        class MSEXT_OBJ{
            public $title  = "--";
            public $height;
            public $width;
            public $height_written;
            public $width_written;
            public $no_of_lines;
            public $dim_staff;
            public $mscript_obj;

        }
        $manuscript_ext_objs = array();
        while($row = mysql_fetch_row($result)){
            $manuscript_obj = getManuscriptById($row[0]);
            $mext_obj = new MSEXT_OBJ();
            $mext_obj->mscript_obj = $manuscript_obj;
            $mext_obj->mscript_id = $row[0];
            $mext_obj->title = $row[1];
            $mext_obj->height = $row[2];
            $mext_obj->width = $row[3];
            $mext_obj->height_written = $row[4];
            $mext_obj->width_written = $row[5];
            $mext_obj->no_of_lines = $row[6];
            $mext_obj->dim_staff = $row[7];
            
            
            $manuscript_ext_objs[] = $mext_obj;
        }
    }
    
            
//    $search_util = new SearchUtil();
//    $result_set = $search_util->process_search();
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>manuscriptlink</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mslink.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script type="text/javascript">
        function view_record(form) {
            $(form).submit(); 
        }
    </script>
  </head>
  <body>

    <div class="container">
      	<div class="row">
            <div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" alt="" /></a></div>
          	<div class="col-md-9" style=" height: 55px;">
            		<ul class="link-nav pull-right">
              		<li class="active"><a href="#">search</a></li>
  		            <li><a href="about.php">about</a></li>
  		            <li><a href="browse.php">browse</a></li>
  		            <li><a href="resources.php">resources</a></li>
  		            <li><a href="#">citation shelfmarks</a></li>
  		            <li><a href="#"><?php echo $_SESSION['name'];?></a></li>
            		</ul>
          	</div>
      	</div>
    </div>

    	<div class="container">
            <div class="row">
                <div class="col-md-3 sideButtons">
                    <h4 class="arc-button puff" id="addToArchives" ><a href="user.php">Add to My Archive</a></h4>
                    <h4 class="arc-search puff"><a href="search.php"><i class="fa fa-wrench"></i> Refine Results</a></h4>
                </div>
                <div id="results" class="col-md-9">
                    <!-- THis is the line where you will output the search terms, all of which wrapped in a span tag with class search-terms -->
                    <h4>Showing results for: 
                        <small>
                            <?php foreach($biblioQueries as $bib){?>
                                <span class="search-terms"><?php echo $bib->logic . " ". $bib->term ; ?></span>
                            <?php } ?>
                                
                                <?php if(count($codologQueries) > 0){ ?>
                                    <span> &nbsp; AND &nbsp; </span>
                                <?php }?>
                                    
                            <?php foreach($codologQueries as $cod){?>
                                <span class="search-terms"><?php echo $cod->logic . " ". $columnNamesMap[$cod->term] . " between ". $cod->min . " to " . $cod->max ;   ?></span>
                            <?php } ?>
                                
                        </small>
                    </h4>
                
                    
                        <!--Here we will display the search results-->
                    <?php $count=1; foreach($manuscript_ext_objs as $mobj){ ?>
                        <form name='<?php echo $count; ?>' method="GET" action='record.php'>
                            <input type="hidden" name='id' value ='<?php echo $mobj->mscript_obj->mscript_id; ?>'/>
                            <input type="hidden" name='data' value ='<?php echo json_encode($mobj);?>'/>
                        </form>
                        <div class="search-result" data-mscriptId = "<?php echo $mobj->mscript_id; ?>"  >                            
                            <h4><a onclick="view_record(document.getElementsByName('<?php echo $count;?>'));"><?php echo 'manuscriptlink # ' . htmlspecialchars($mobj->mscript_obj->mlinknum . "." . $mobj->mscript_obj->part)  ; ?></a></h4>
                            <p><?php echo $mobj->title . ",  " . $mobj->mscript_obj->origin->country . ", " . $mobj->mscript_obj->date_manu ;  ?> <br />                               
                               <?php echo "Available Folios: " . htmlspecialchars($mobj->mscript_obj->no_of_avail_fol)  ?>
                        </div>
                            
                    <?php $count = $count+1; } ?>
                   
                </div>               

            </div>
    	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript">
        $('.search-result').click(function() {            
          $(this).toggleClass('clicked', 1000, "easeOutSine");
        });
        
        $('#addToArchives').click(function(){
            //Iterate through each search result and check if it is selected
            $('.search-result').each(function(){
               if($(this).hasClass('clicked')){
                   
               } 
            });
            
        });
    
    </script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

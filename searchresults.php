<?php
    
    include_once './includes/config.php';
    include_once './includes/functions.php';
    include_once './data_models/CodicologicalQuery.php';
    include_once './data_models/BibliographicalQuery.php';
    include_once './utils/SearchTermsMap.php';
    
    session_start();    
    if (login_check() == true) {
        $logged = 'in';
    } else {
        $logged = 'out';
    }   
    $loggedInUserId = $_SESSION['user_id'];
    $tableName = "folios";
    global $mysqli;

        $search_desc = '';
        $manuscript_ext_objs = array();     //this variable saves the search query results
        $query = '';
        //If user has clicked on load previous search results and came here...
        if( !isset($_GET['load_prev']) ){ 
            //Here if user came from search page    
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
            for ( $i = 1; $i < 8; $i++ ){
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
                    $bib->actualLogic = 'NOT';
                }
                
                $bibQueryStr.= $bib->logic . " CONCAT (fol.title, fol.alt_title, fol.author, fol.folio_contents, fol.coll_admin, fol.col_staff, fol.faculty_liason, fol.meta_catag, fol.scan_tech, "
                        ." ms.mlink_part, ms.artist, ms.bibliography, ms.century, ms.collation, ms.date_manuscript, ms.decoration, ms.edition_cited, ms.language, ms.liturgicaluse, ms.miniatures,"
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
                    // error_log("came for not between ");
                    //if the not is selected for first term then we should not append AND in where clause because querry will be " WHERE AND "
                    if($count == 0){
                        $cod->logic = '';
                    }else{
                        $cod->logic = 'AND';
                    }
                    $between = 'NOT BETWEEN';
                    
                    $cod->actualLogic = 'NOT';
                }
                $codQueryStr.= " " . $cod->logic . " " . $cod->term . "  " . $between . " " .$cod->min .  " And "  .$cod->max ;
                $count++;
            }
            
            // error_log($count);
            // error_log($codQueryStr);
            
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
            
            $query .= " GROUP BY ms.mscript_id ";

        }else{
            //Here if user wants to load pervious search results
            //Get searchquery using user id

            //This query will actually return search query which user initially ran
            $search_query_extract = "SELECT search_query, search_desc FROM user_search_query WHERE user_id = $loggedInUserId" ;
            $temp_result = $mysqli->query($search_query_extract);
            if($row = $temp_result->fetch_assoc()){
                $query = $row['search_query'];
                $search_desc = $row['search_desc'];
            }
            // error_log($query);
        }
        
        if($query !== ''){
        
            error_log($query);
            $result = $mysqli->query($query);
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
            
            while($row = $result->fetch_assoc()){
                $manuscript_obj = getManuscriptById($row['mscript_id']);  //0 offset if using procedural style
                $mext_obj = new MSEXT_OBJ();
                $mext_obj->mscript_obj = $manuscript_obj;
                $mext_obj->mscript_id = $row['mscript_id'];
                $mext_obj->title = $row['title'];   //1
                $mext_obj->height = $row['height']; //2
                $mext_obj->width = $row['width'];   //3
                $mext_obj->height_written = $row['height_written']; //4
                $mext_obj->width_written = $row['width_written'];   //5
                $mext_obj->no_of_lines = $row['no_of_lines'];   //6
                $mext_obj->dim_staff = $row['dim_staff']; //7
                
                $manuscript_ext_objs[] = $mext_obj;
            }//end of while loop

            if(!isset($_GET['load_prev'])){
                //Save the search results query in the database
                foreach($biblioQueries as $bib){
                    $search_desc .= $bib->logic . " ". $bib->actualLogic. " " .$bib->term. " ";
                }
                    
                if(count($codologQueries) > 0){
                    $search_desc .= " AND "; 
                }
                        
                foreach($codologQueries as $cod){
                    $search_desc .= $cod->logic . " ". $columnNamesMap[$cod->term] . " " . $cod->actualLogic . " between ". $cod->min . " to " . $cod->max ;
                }

                $save_search_query_insert = "INSERT INTO user_search_query VALUES ($loggedInUserId, '" . $mysqli->real_escape_string($query) . "', '" . $mysqli->real_escape_string($search_desc)  ."') ON DUPLICATE KEY UPDATE search_query = '"  . $mysqli->real_escape_string($query) . "', search_desc = '" .$mysqli->real_escape_string($search_desc). "'"  ;
                error_log($save_search_query_insert);
                $res = $mysqli->query($save_search_query_insert);

                if (!$res) {
                   error_log($mysqli->error);
                }
            }
        }

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
    <link href="css/menubarStyles.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .arc-button,.arc-search{ cursor: pointer; cursor: hand; }
    </style>
    <script type="text/javascript">
        function view_record(form) {
            $(form).submit(); 
        };
        
    </script>
  </head>
  <body>

    <!-- copy this block where ever you require citation shelfmark -->
    <div class="modal fade" id="shelfmarks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        
    </div>

    <div class="container">
      	<div class="row">
            <div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" alt="" /></a></div>
          	<div class="col-md-9" style=" height: 55px;">
            		<ul class="link-nav pull-right">
              		<li class="active"><a href="search.php">search</a></li>
  		            <li><a href="about.php">about</a></li>
  		            <li><a href="browse.php">browse</a></li>
  		            <li><a href="resources.php">resources</a></li>
  		            <li><a href="#" data-toggle="modal" data-target="#shelfmarks">citation shelfmarks</a></li>
  		            <?php if(login_check()) { ?>
                    <li><a href="#"><?php echo $_SESSION['name'];?></a></li>
                    <?php }else{ ?>
                    <li><a href="login.php">login</a></li>
                    <?php } ?>
            		</ul>
          	</div>
      	</div>

        <?php if(login_check()) {?>
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb pull-right">
                    
                    <li <?php if(isset($_GET['load_prev'])){ echo "class='active'"; } ?> ><a href="searchresults.php?load_prev=">my results</a></li>
                    <li ><a href="myarchive.php">my archive</a></li>
                    <li><a href="utils/process_logout.php">logout</a></li>
                </ol>
                <ol class="breadcrumb pull-right">
                    <li <?php if(!isset($_GET['load_prev'])){ echo "class='active'"; } ?> >results</li>
                    <li>record</li>
                    <li>codex</li>
                    <li>pan&zoom</li>
                    <li>juxtapose&compare</li>
                </ol>
            </div>
        </div>
        <?php } ?>

    </div>

    	<div class="container">
            <div class="row">

                <?php if(isset($_GET['load_prev']) && count($manuscript_ext_objs) < 1 ){ ?>
                    <div class="no-entries">
                        <p>You don't currently have any previous search results. <a href="search.php">Click Here</a> to search through our database and begin building your collection</p>
                    </div>

                <?php }else{ ?>


                    <div class="col-md-3 sideButtons">
                        <h4 class="arc-button puff" id="addToArchives" >Add to My Archive</h4>
                        <?php if(!isset($_GET['load_prev'])){ ?>
                            <h4 class="arc-search puff" ><i class="fa fa-wrench"></i> Refine Results</h4>
                        <?php } ?>
                    </div>
                    <div id="results" class="col-md-9">
                        <!-- THis is the line where you will output the search terms, all of which wrapped in a span tag with class search-terms -->
                            <h4>Showing <?php echo count($manuscript_ext_objs); ?> results for: 
                                <?php if(!isset($_GET['load_prev'])){ ?>
                                    <small>
                                        <?php foreach($biblioQueries as $bib){?>
                                            <span class="search-terms"><?php echo $bib->logic . " ". $bib->actualLogic. " " .$bib->term ; ?></span>
                                        <?php } ?>
                                            
                                            <?php if(count($codologQueries) > 0){ ?>
                                                <span> &nbsp; AND &nbsp; </span>
                                            <?php }?>
                                                                                                        
                                        <?php foreach($codologQueries as $cod){?>
                                            <span class="search-terms"><?php echo $cod->logic . " ". $columnNamesMap[$cod->term] . " " . $cod->actualLogic . " between ". $cod->min . " to " . $cod->max ;   ?></span>
                                        <?php } ?>
                                            
                                    </small>
                                <?php }else{ ?>
                                    <small>
                                        <span class="search-terms"> <?php echo $search_desc; ?> </span>
                                    </small>
                                <?php } ?>

                            </h4>
                        
                            
                                <!--Here we will display the search results-->
                            <?php $count=1; foreach($manuscript_ext_objs as $mobj){ ?>
                                <form name='<?php echo $count; ?>' method="GET" action='record.php'>
                                    <input type="hidden" name='id' value ='<?php echo $mobj->mscript_obj->mscript_id; ?>'/>
                                    <!-- Send mlink number rather than complete data-->
                                    <!-- <input type="hidden" name='data' value ='<?php //echo json_encode($mobj);?>'/> -->
                                    <input type="hidden" name='mlinknum' value ='<?php echo $mobj->mscript_obj->mlinknum ;?>'/>
                                </form>
                                <div class="search-result" data-mscriptid = "<?php echo $mobj->mscript_id; ?>"  >                            
                                    <h4><a href="#" onclick="view_record(document.getElementsByName('<?php echo $count;?>'));"><?php echo 'manuscriptlink # ' . htmlspecialchars($mobj->mscript_obj->mlinknum . "." . $mobj->mscript_obj->part)  ; ?></a></h4>
                                    <p><?php echo $mobj->title . ",  " . $mobj->mscript_obj->origin->country . ", " . $mobj->mscript_obj->date_manu ;  ?> <br />                               
                                       <?php echo "Available Folios: " . htmlspecialchars($mobj->mscript_obj->no_of_avail_fol)  ?>
                                </div>
                                    
                            <?php $count = $count+1; } ?>
                    </div>

                <?php } ?>

            </div>
    	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript">
        $('.search-result').click(function() {            
          $(this).toggleClass('clicked', 1000, "easeOutSine");
        });

        $('.arc-search').click(function(){
            parent.history.back();
            return false;
            // window.history.go(-1);
        });
        
        $('#addToArchives').click(function(){
            //Iterate through each search result and check if it is selected
            var msIdsSelected = [];
            $('.search-result').each(function(){
               if($(this).hasClass('clicked')){
                   var mscriptId = $(this).data('mscriptid');
                   msIdsSelected.push(mscriptId);
               } 
            });
            if(msIdsSelected.length > 0){
                $.ajax({    
                    url: 'addManuscriptsToArchives.php',
                    type: 'GET',
                    data: {mscript_ids: msIdsSelected.toString() },
                                      
                    success: function (msg) {
                        //Add this folio to books
                        console.log(msg);
                        var decodedMsg = JSON && JSON.parse(msg) || $.parseJSON(msg);
                        if(decodedMsg.statusNum == 200){
                          alert('Manuscripts successfully added to your archives');
                        }else{
                          alert('Unable to add manuscripts to your archives. Please try again.');
                        }
                    }
                });
            }else{
                alert('Please select some manuscripts.');
            }

            $("#shelfmarks").load('citationShelfmark.php');
            
        });
    
    </script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

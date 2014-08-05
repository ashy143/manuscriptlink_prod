<?php
    
    include_once './includes/config.php';
    include_once './includes/functions.php';
    include_once './utils/process_search.php';
    include_once './data_models/CodicologicalQuery.php';
    include_once './data_models/BibliographicalQuery.php';
    
    session_start();    
    if (login_check() == true) {
        $logged = 'in';
    } else {
        $logged = 'out';
    }   
    
    $tableName = "folios";
    $con = mysql_connect(HOST.':'.PORT, USER, PASSWORD) or die("Unable to connect to MySQL");
    mysql_select_db(DATABASE, $con) or die("Could not select" .mysql_error());

    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }else{
    
        $biblioQueries = array();
        for ( $i = 1; $i < 5; $i++ ) {
           $biblioQuery = new BibliographicalQuery();
           if($_POST["bibliographical".$i]==''){
               continue;
           }
            if(  count($biblioQueries) > 0){
               $biblioQuery->logic = $_POST["bibliographicalLog".$i ]; 
           }        

           $biblioQuery->term = $_POST["bibliographical".$i];
           $biblioQueries[] = $biblioQuery;
        }
        
        
        $codologQueries = array();
        for ( $i = 1; $i < 8; $i++ ) {
            $codologQuery = new CodicologicalQuery();
            if($_POST["codicologicalTerm".$i]=='NA'){
                continue;
            }
            if( count($biblioQueries) > 0 || count($codologQueries) > 0   ){               
                $codologQuery->logic = $_POST["codicologicalLogic".$i ]; 
            }
            $codologQuery->min = $_POST["codicologicalMin".$i]; 
            $codologQuery->max = $_POST["codicologicalMax".$i ]; 
            $codologQuery->term = $_POST["codicologicalTerm".$i];
            $codologQueries[] = $codologQuery;

        }
         //build where class
        $bibQueryStr = '';
        foreach($biblioQueries as $bib){
            $bibQueryStr.= " " . $bib->logic . " title " .  " LIKE '%" . $bib->term .  "%' " ;
        }         
         
        $codQueryStr = '';
        foreach($codologQueries as $cod){
            $codQueryStr.= " " . $cod->logic . " " . $cod->term . " BETWEEN " . $cod->min .  " AND "  .$cod->max ;
        }
        
        $query_place_holder = "SELECT ms.mscript_id, fol.title, fol.height, fol.width, fol.height_written, fol.width_written, fol.no_of_lines, fol.dim_staff FROM manuscript AS ms INNER JOIN folios AS fol ON ms.mscript_id = fol.mscript_id ";
        if(count($biblioQueries) > 0 || count($codologQueries) > 0){
            $query_place_holder .= " WHERE %s %s" ;
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
//            alert(form);
            $(form).submit(); 
        }
    </script>
  </head>
  <body>

    <div class="container">
      	<div class="row">
            <div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" /></div>
          	<div class="col-md-9" style=" height: 55px;">
            		<ul class="link-nav pull-right">
              		<li class="active"><a href="#">search</a></li>
  		            <li><a href="about.php">about</a></li>
  		            <li><a href="browse.php">browse</a></li>
  		            <li><a href="resources.php">resources</a></li>
  		            <li><a href="#">citation shelfmarks</a></li>
  		            <li><a href="login.php">login</a></li>
            		</ul>
          	</div>
      	</div>
    </div>

    	<div class="container">
            <div class="row">
                <div class="col-md-3 sideButtons">
                    <h4 class="arc-button puff"><a href="user.php">Add to My Archive</a></h4>
                    <h4 class="arc-search puff"><a href="search.php"><i class="fa fa-wrench"></i> Refine Results</a></h4>
                </div>
                <div id="results" class="col-md-9">
                    <!-- THis is the line where you will output the search terms, all of which wrapped in a span tag with class search-terms -->
                    <h4>Showing results for: <small><span class="search-terms">Old Documents</span>, <span class="search-terms">1420 — 1611</span>.</small></h4>
                
                    
                        <!--Here we will display the search results-->
                    <?php $count=1; foreach($manuscript_ext_objs as $mobj){ ?>
                        <?php //echo json_encode($mobj);?>
                        <form name='<?php echo $count; ?>' method="post" action='record.php'>
                            <input type="hidden" name='id' value ='<?php echo $mobj->mscript_obj->mscript_id; ?>'/>
                            <input type="hidden" name='data' value ='<?php echo json_encode($mobj);?>'/>
                        </form>
                        <div class="search-result" data-mscriptId = "<?php echo $mobj->mscript_id; ?>"  >                            
                            <h4><a onclick="view_record(document.getElementsByName('<?php echo $count;?>'));"><?php echo 'manuscriptlink # ' . htmlspecialchars($mobj->mscript_obj->mlinknum . "." . $mobj->mscript_obj->part)  ; ?></a></h4>
                            <p><?php echo $mobj->title . ",  " . $mobj->mscript_obj->origin->country . ", " . $mobj->mscript_obj->date_manu ;  ?> <br />                               
                               <?php echo "Available Folios: " . htmlspecialchars($mobj->mscript_obj->no_of_avail_fol)  ?>
                        </div>
                            
                    <?php $count = $count+1; } ?>
                        
                    <!--
                    <div class="search-result">
                        <h4><a href="record.php">USC Early MS 12 fol. 32r</a></h4>
                        <p>Breviary. Vellu. Italy (Naples), ca. 1460<br />
                           132 x 96 mm. Double column, 27-8 lines.<br />
                           Artist: Giorgio d' Alemagna (d. 1467-68)</p>

                    </div>    
                    -->
                </div>
                

    		</div>
    	</div>






    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script launguage="JavaScript">
        $('.search-result').click(function() { 
          $(this).toggleClass('clicked', 1000, "easeOutSine");
        });
        
   
    
    </script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

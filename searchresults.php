<?php
    
    include_once './includes/functions.php';
    require './utils/process_search.php';
    
    session_start();
    
    if (login_check() == true) {
        $logged = 'in';
    } else {
        $logged = 'out';
    }
    
    $host = "localhost:3306";
    $databaseName = "mydb";
    $tableName = "folios";
    $username = "root";
    $con = mysql_connect($host,$username) or die("Unable to connect to MySQL");

    mysql_select_db($databaseName, $con) or die("Could not select" .mysql_error());

    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }else{
    
        $log1 = $_POST['codicologicalLogic1'];
        $term1 = $_POST['codicologicalTerm1'];
        $min1 = $_POST['codicologicalMin1'];        
        $max1 = $_POST['codicologicalMax1'];

        $log2 = $_POST['codicologicalLogic2'];
        $term2 = $_POST['codicologicalTerm2'];
        $min2 = $_POST['codicologicalMin2'];        
        $max2 = $_POST['codicologicalMax2'];

        $query_place_holder = "SELECT distinct mscript_id, title, height, width, height_written, width_written, no_of_lines, dim_staff FROM folios WHERE %s BETWEEN %d AND %d ".
                "%s " .
                "%s BETWEEN %d AND %d ".
                "%s " .
                "%s LIKE '%s' ";
        $query = sprintf("$query_place_holder ",$term1,$min1,$max1, $log2, $term2, $min2 , $max2, 'AND', 'title', 'Breviary' );
//        echo $query;
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
            alert(form);
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

<?php
    
    include_once './includes/functions.php';
    require './utils/process_search.php';
    
    session_start();
    
    if (login_check() == true) {
        $logged = 'in';
    } else {
        $logged = 'out';
    }
    
    $search_util = new SearchUtil();
    $result_set = $search_util->process_search();
    
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
                    <?php foreach($result_set as $folio_obj){ ?>
                        <div class="search-result" data-folioId = "<?php echo $folio_obj->folio_id; ?>" data-mscriptId = "<?php echo $folio_obj->mscript_id; ?>"  >
                            <h4><a href="record.php?id=<?php echo $folio_obj->mscript_id ; ?>"><?php echo htmlspecialchars($folio_obj->abbreviated_shelf) . ", Fol. " . htmlspecialchars($folio_obj->folio_num) . " " . htmlspecialchars($folio_obj->folio_side) ; ?></a></h4>                        
                            <p><?php echo $folio_obj->title . " . " . $folio_obj->folio_location->country . " (" . $folio_obj->folio_location->municipality . ") " . $folio_obj->date_text  ;  ?> <br />
                               <?php echo htmlspecialchars($folio_obj->height) . " x " . htmlspecialchars($folio_obj->width) . " mm. ". htmlspecialchars($folio_obj->no_of_cols) . " column, " . htmlspecialchars($folio_obj->no_of_lines) . " lines."; ?></br> 
                               <?php echo "Artist: " . htmlspecialchars($folio_obj->author) ; ?>
                        </div>
                    <?php } ?>
                        
                    <div class="search-result">
                        <h4><a href="record.php">Duke Early MS 22 Fol. 4r</a></h4>
                        <p>Breviary. Vellu. Italy (Naples), ca. 1460<br />
                           132 x 96 mm. Double column, 27-8 lines.<br />
                           Artist: Giorgio d' Alemagna (d. 1467-68)</p>
                    </div>
                    <div class="search-result">
                        <h4><a href="record.php">UGA Early MS 3 fol. 26v</a></h4>
                        <p>Breviary. Vellu. Italy (Naples), ca. 1460<br />
                           132 x 96 mm. Double column, 27-8 lines.<br />
                           Artist: Giorgio d' Alemagna (d. 1467-68)</p>

                    </div>
                    <div class="search-result">
                        <h4><a href="record.php">USC Early MS 12 fol. 32r</a></h4>
                        <p>Breviary. Vellu. Italy (Naples), ca. 1460<br />
                           132 x 96 mm. Double column, 27-8 lines.<br />
                           Artist: Giorgio d' Alemagna (d. 1467-68)</p>

                    </div>                
                    <div class="search-result">
                        <h4><a href="record.php">Duke Early MS 22 Fol. 4r</a></h4>
                        <p>Breviary. Vellu. Italy (Naples), ca. 1460<br />
                           132 x 96 mm. Double column, 27-8 lines.<br />
                           Artist: Giorgio d' Alemagna (d. 1467-68)</p>
                    </div>
                    <div class="search-result">
                        <h4><a href="record.php">UGA Early MS 3 fol. 26v</a></h4>
                        <p>Breviary. Vellu. Italy (Naples), ca. 1460<br />
                           132 x 96 mm. Double column, 27-8 lines.<br />
                           Artist: Giorgio d' Alemagna (d. 1467-68)</p>

                    </div>
                    <div class="search-result">
                        <h4><a href="record.php">USC Early MS 12 fol. 32r</a></h4>
                        <p>Breviary. Vellu. Italy (Naples), ca. 1460<br />
                           132 x 96 mm. Double column, 27-8 lines.<br />
                           Artist: Giorgio d' Alemagna (d. 1467-68)</p>

                    </div>                  
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

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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <!-- copy this block where ever you require citation shelfmark -->
    <div class="modal fade" id="shelfmarks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        
    </div>

    <div class="container">
      	<div class="row">
            <div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" /></div>
          	<div class="col-md-9" style=" height: 55px;">
            		<ul class="link-nav pull-right">
              		<li><a href="search.php">search</a></li>
  		            <li><a href="about.php">about</a></li>
  		            <li class="active"><a href="browse.php">browse</a></li>
  		            <li><a href="resources.php">resources</a></li>
  		            <li><a href="#" data-toggle="modal" data-target="#shelfmarks">citation shelfmarks</a></li>
  		            <li><a href="login.php">login</a></li>
            		</ul>
          	</div>
      	</div>
    </div>

      <div class="container">
            <div class="row">
                <div class="col-md-4" id="sorters">
                  <h3 class="pageTitle">Browse By</h3>
                    <h4 class="arc-button puff"><a href="#">Location / Institution<br />Collection</a></h4>
                    <h4 class="arc-button puff"><a href="#">Place of Origin</a></h4>
                    <h4 class="arc-button puff"><a href="#">Date</a></h4>
                    <h4 class="arc-button puff"><a href="#">Author</a></h4>
                    <h4 class="arc-button puff"><a href="#">Title/Genre</a></h4>
                    <h4 class="arc-button puff"><a href="#">Artist</a></h4>
                    <h4 class="arc-button puff"><a href="#">Scribe</a></h4>
                    <h4 class="arc-button puff"><a href="#">Provenance</a></h4>
                    <h4 class="arc-button puff"><a href="#">Language</a></h4>
                    <h4 class="arc-button puff"><a href="#">Writing Support</a></h4>
                    <h4 class="arc-button puff"><a href="#">Script</a></h4>
                </div>
 
                <div id="browseResults" class="col-md-8">
                    <!-- THis is the line where you will output the search terms, all of which wrapped in a span tag with class search-terms -->
                    <h4>Showing results for: <small><span class="search-terms">Old Documents</span>, <span class="search-terms">1420 — 1611</span>.</small></h4>
                
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
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script launguage="JavaScript">
        $('#sorters h4').on('click', function () { 
          $('h4').removeClass('sorted');
          $(this).addClass('sorted');
        });

        $(document).ready(function(){
            $("#shelfmarks").load('citationShelfmark.php');
        });
    
    </script>

    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

<?php
    include_once './includes/dbconnect.php';
    include_once './includes/functions.php';

    session_start();
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<div class="modal fade" id="shelfmarks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        
        
</div>


    <div id="header" class="container">
      	<div class="row">
          	<div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" /></div>
          	<div class="col-md-9" style="height: 55px;">
            		<ul class="link-nav pull-right">
              		<li><a href="search.php">search</a></li>
  		            <li class="active"><a href="about.php">about</a></li>
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
        <div class="row">
            <div class="col-md-12">
                <?php if(login_check()) { ?>
                <ol class="breadcrumb pull-right">
                    <li ><a href="myarchive.php">my archive</a></li>
                    <li><a href="utils/process_logout.php">logout</a></li>
                </ol>
                <?php } ?>
                <ol class="breadcrumb pull-right">
                    <li class="active">mission</li>
                    <li><a href="partners.php">partners</a></li>
                    <li><a href="contribute.php">contribute</a></li>
                    <li><a href="contact.php">contact</a></li>
                    <li><a href="projectleaders.php">project leaders</a></li>
                    <li><a href="fairuse.php">fair use</a></li>
                </ol>
            </div>
        </div>

    </div>


    <div class="container one">
        <div class="row">
            <div class="col-md-7">
                <h3 class="pageTitle">About</h3>
                
                <p>
                Scholars at the University of South Carolina and The Ohio State University are pleased to announce their digital humanities project <i>manuscriptlink</i>, a powerful research tool for librarians, teachers, and scholars worldwide. While live, the site is still under construction and is being updated regularly.
                </p>
                <p>
                For centuries, book dealers and connoisseurs across Europe have cut out the pages of medieval and Renaissance manuscripts. These manuscripts comprise, among other things, mammoth choir books “illuminated” with sheets of gold leaf, prayer books with lavish miniatures, venerable relics from defunct monasteries, luxury volumes coveted by emperors and popes, lyric verse in vernacular tongues, and elegant anthologies of Classical texts. Designed at the University of South Carolina’s Center for Digital Humanities, <i>manuscriptlink</i> aims to undo this cultural destruction by identifying, re-aggregating, and publishing an estimated 300,000 manuscript fragments worldwide. This innovative project reunites digital surrogates of dismembered medieval manuscript leaves into virtual codices, thereby restoring thousands of manuscripts lost through the dispersal of individual pages. With its innovative technology, suite of image-navigation tools, archive of images, and comprehensive metadata, <i>manuscriptlink</i> will reveal a “virtual” medieval library and unlock a treasury of information. Such manuscript aggregation engages a host of Humanities disciplines, including art history, literature, book design and production, religious culture, translation, and so on. Imagine the immense cultural value of restoring a lost medieval library amounting to thousands of volumes. Imagine, too, the impact of a large-scale collaboration in which even the smallest repositories will see their holdings gain new value as part of an international consortium.
                </p>
                <p>
                Users of <i>manuscriptlink</i> will be able to undertake faceted (Boolean) searches in bibliographical and codicological fields. Metadata is exhaustively derived, recorded, and presented, including dimensions, number of lines, number of musical staves per page, provenance, auction catalogues, and texts. All texts and authors are indexed in variant forms for reliable and comprehensive searches. In the CODEX viewer, users can consult discrete fragments and related constituents as virtual codices, literally “turning” the pages in approximation of medieval reading. Users will also have access to advanced image enhancement tools, including a PAN+ZOOM function. Individual hair follicles, animal veins, and the minutest textual and decorative features will be visible at high magnification. An innovative BOOKSHELF enables users to store up to four images for comparison in the JUXTAPOSE & COMPARE function. Each of the four independent panes has PAN+ZOOM capability, and the panes can be repositioned and overlapped for comparison. When individual panes are deleted, the others dynamically re-size to fit your screen dimensions. Finally, all users will have personal ARCHIVE accounts where they will be able to store thousands of images for retrieval, exporting, or printing. Access to <i>manuscriptlink</i> is free for all users.
                </p>
                <p>
                Ultimately, <i>manuscriptlink</i> enables its contributors to recapture and redefine the textual and artistic significance of small fragment collections, harnessing the power of collaboration to enrich the research, teaching, and curatorship of medieval culture.
                </p>
                <i>manuscriptlink</i> Co-Directors

                <p><em>manuscriptlink</em> Co-Directors</p>
                <p>Dr. Scott Gwara, University of South Carolina<br /><a href="mailto:gwaras@mailbox.sc.edu">gwaras@mailbox.sc.edu</a><br />
                803-920-3582</p>
                <p>Dr. Eric J. Johnson, The Ohio State University<br /><a href="mailto:johnson.4156@osu.edu">johnson.4156@osu.edu</a><br />
                614-688-8795</p>
                </p>
            </div>
            <div class="col-md-5">
                <img class="img-responsive" src="img/manuscript.png" />
            </div>

        </div>
    </div> 

   



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function(){
          $("#shelfmarks").load('citationShelfmark.php');
      });
    </script>
  </body>
</html>

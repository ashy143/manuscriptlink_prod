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
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body data-spy="scroll" data-target="#master" data-offset="100">

    <div class="container">
      	<div class="row">
            <div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" /></div>
          	<div class="col-md-9" style=" height: 55px;">
            		<ul class="link-nav pull-right">
                  		<li><a href="search.php">search</a></li>
      		            <li><a href="about.php">about</a></li>
      		            <li><a href="browse.php">browse</a></li>
      		            <li class="active"><a href="resources.php">resources</a></li>
      		            <li><a href="#">citation shelfmarks</a></li>
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
                    <li><a href="resources.php">resources</a></li>
                    <li class="active">user guide</li>
                </ol>
            </div>
        </div>

    </div>
    <div class="back">
        <div id="viewer">
            <div class="player">
                <!-- Video goes here if any -->
                <iframe src="//player.vimeo.com/video/67805734?byline=0&amp;portrait=0&amp;color=d9305b" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4" id="help-filter">
                <div data-spy="affix" data-offset-top="639" id="master">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#start">Getting Started</a></li>
                        <li><a href="#search">Performing a Search</a></li>
                        <li><a href="#codex">Using the Codex</a></li>
                        <li><a href="#panzoom">Using Pan &amp; Zoom</a></li>
                        <li><a href="#bookhelp">Using the Bookshelf</a></li>
                        <li><a href="#building">Building an Archive</a></li>

                    </ul>
                </div>
            </div>

            <div class="col-md-8" id="helpContent">
                <div class="helpSection">
                    <h2 id="start"><i class="fa fa-check fa-fw"></i> Getting Started</h2>
                    <p><!-- Description goes here --></p>
                </div>
                <div class="helpSection">
                    <h2 id="search"><i class="fa fa-search fa-fw"></i> Performing a Search</h2>
                    <p><!-- Description goes here --></p>
                </div>
                <div class="helpSection">
                    <h2 id="codex"><i class="fa fa-book fa-fw"></i> Using the Codex</h2>
                    <p><!-- Description goes here --></p>
                </div>
                <div class="helpSection">
                    <h2 id="panzoom"><i class="fa fa-arrows fa-fw"></i> Using Pan and Zoom</h2>
                    <p><!-- Description goes here --></p>
                </div>
                <div class="helpSection">
                    <h2 id="bookhelp"><i class="fa fa-caret-square-o-down fa-fw"></i> Using the Bookshelf</h2>
                    <p><!-- Description goes here --></p>
                </div>
                <div class="helpSection">
                    <h2 id="building"><i class="fa fa-archive fa-fw"></i> Building an Archive</h2>
                    <p><!-- Description goes here --></p>

                </div>
            </div>
        </div>
    </div>

    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

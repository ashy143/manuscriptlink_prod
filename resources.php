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
  		            <li><a href="browse.php">browse</a></li>
  		            <li class="active"><a href="resources.php">resources</a></li>
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
                    <li class="active">resources</li>
                    <li><a href="help.php">user guide</a></li>
                </ol>
            </div>
        </div>


    </div>


    <div class="container resourcesSection">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <h3 class="pageTitle">Print Resources</h3>
            <dl>
              <dt><!-- Heading goes here--></dt>
              <dd><!-- Description goes here --></dd>
              
            </dl>

            <h3 class="pageTitle">Web Resources</h3>
            <dl>
              <dt><!-- Heading goes here--></dt>
              <dd><!-- Description goes here --></dd>
              
            </dl>

            <h3 class="pageTitle">News Resources</h3>
            <dl>
              <dt><!-- Heading goes here--></dt>
              <dd><!-- Description goes here --></dd>
              
            </dl>

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

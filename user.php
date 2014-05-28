<?php
    include_once '/includes/dbconnect.php';
    include_once '/includes/functions.php';
    
    session_start();

    if(login_check() == false){
        header("location: /index.php");
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
<div class="modal fade" id="clearArchive" tabindex="-1" role="dialog" aria-labelledby="clearArchiveLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="clearArchiveLabel"><strong><i class="fa fa-exclamation-triangle"></i> Warning</strong></h2>
      </div>
      <div class="modal-body">
          <p>Clicking Clear Archive will erase your entire archive. Continue?</p>
      </div>
      <div class="modal-footer">
          <div class="pull-right">
              <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
              <button type="button" data-dismiss="modal" class="btn btn-danger">Clear Archive</button>
          </div>
      </div>
    </div>
  </div>
</div>

    <div class="container">
      	<div class="row">
            <div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" /></div>
          	<div class="col-md-9" style=" height: 55px;">
            		<ul class="link-nav pull-right">
              		<li><a href="search.php">search</a></li>
  		            <li><a href="about.php">about</a></li>
  		            <li><a href="browse.php">browse</a></li>
  		            <li><a href="resources.php">resources</a></li>
  		            <li><a href="#">citation shelfmarks</a></li>
  		            <li class="active"><a href="user.php"><?php echo $_SESSION['name'];?></a></li>
            		</ul>
          	</div>
      	</div>
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb pull-right">
                    <li class="active"><a href="myarchive.php">my archive</a></li>
                    <li><a href="index.php">logout</a></li>
                </ol>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 sidecar">
                <h3 class="pageTitle">My Archive</h3>
                <div class="arc-button">Export Selections</div>
                <div class="arc-button">Print Selections</div>
                <a href="juxtapose.php"><div class="arc-button">Juxtapose &amp; Compare</div></a>
                <a href="searchresults.php"><div class="arc-search">Back to Search</div></a>
                <div class="arc-clear"><a href="#" data-toggle="modal" data-target="#clearArchive">Clear Archive</a></div>
            </div>
            <div class="col-md-8 pull-right">
          
                <div class="no-entries">
                    <p>You don't currently have any items selected for your archive. <a href="search.php">Click Here</a> to search through our database and begin building your collection</p>
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

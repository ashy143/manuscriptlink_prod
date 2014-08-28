<?php 
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
  		            <li><a href="login.php">login</a></li>
            		</ul>
          	</div>
      	</div>

        <?php if(login_check()) {?>
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb pull-right">
                    <li><a href="#">search</a></li>
                    <li><a href="#">results</a></li>
                    <li><a href="#">record</a></li>
                    <li><a href="#">codex</a></li>
                    <li><a href="#">pan&zoom</a></li>
                    <li class="active"><a href="#">juxtapose&compare</a></li>
                    <li ><a href="myarchive.php">my archive</a></li>
                    <li><a href="utils/process_logout.php">logout</a></li>
                </ol>
            </div>
        </div>
        <?php } ?>

    </div>
    <div class="back">
    </div>

    
    <!-- THIS IS THE BOOKSHELF :: COPY THIS OVER TO OTHER PAGES  & ADD THE COLLAPSE FUNCTION -->

    <div id="bookshelf">
        <div id="bookHead">
            <h4>Bookshelf</h4>
            <i class="fa fa-caret-square-o-down"></i>
        </div>
        <div id="bookBody">
              <div class="book" id="book1">
                <div class="myBook">
                  <h4>1. USC Early MS 17</h4>
                  <div class="delButton">Delete</div>
                  <div class="codexButton">Codex</div>
                </div>
              </div>
              <div class="book" id="book2">
                <div class="myBook">
                  <h4>2. USC Early MS 22a</h4>
                  <div class="delButton">Delete</div>
                  <div class="codexButton">Codex</div>
                </div>
              </div>
              <div class="book" id="book3">
                <div class="myBook">
                  <h4>3. USC Early MS 17</h4>
                  <div class="delButton">Delete</div>
                  <div class="codexButton">Codex</div>
                </div>  
              </div>
              <div class="book" id="book4">
                <div class="myBook">
                  <h4>4. USC Early MS 17</h4>
                  <div class="delButton">Delete</div>
                  <div class="codexButton">Codex</div>
                </div>
              </div>
              <div class="bookBtn">select</div>
              <div class="bookBtn">Add to archive</div>
              <div class="bookBtn"><a href="juxtapose.php">juxtapose &amp; Compare</a></div>
              <div class="bookBtn"><a href="myarchive.php">view archive</a></div>
       </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script language="javascript">
      $('.fa-caret-square-o-down').click(function () {
        $('#bookBody').slideToggle('2000',"swing", function () {
          // Animation complete.
        });
        $(".fa").toggleClass("fa-caret-square-o-down fa-caret-square-o-up");
      });
      $(".delButton").click(function(event) {
        event.preventDefault();
        $(this).parents('.myBook').fadeOut();
      });

    </script> 
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

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


    <div class="container">
      	<div class="row">
          	<div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" /></div>
          	<div class="col-md-9" style="height: 55px;">
            		<ul class="link-nav pull-right">
              		<li><a href="search.php">search</a></li>
  		            <li class="active"><a href="about.php">about</a></li>
  		            <li><a href="browse.php">browse</a></li>
  		            <li><a href="resources.php">resources</a></li>
  		            <li><a href="#" data-toggle="modal" data-target="#shelfmarks">citation shelfmarks</a></li>
  		            <li><a href="login.php">login</a></li>
            		</ul>
          	</div>
      	</div>
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb pull-right">
                    <li><a href="mission.php">mission</a></li>
                    <li><a href="partners.php">partners</a></li>
                    <li class="active">contribute</li>
                    <li><a href="contact.php">contact</a></li>
                    <li><a href="projectleaders.php">project leaders</a></li>
                    <li><a href="fairuse.php">fair use</a></li>
                </ol>
            </div>
        </div>
    </div>

    <div id="matchbox">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-6 col-md-offset-1">
            <div id="register-box">
              <h3>Contribute</h3>
      				
    					<form role="form" name="contrib_form" action="utils/process_register.php" method="post">

                <div class="form-group" >
                    <label for="inputName">Name</label>
                    <input type="name" name="name" class="form-control" id="inputName" placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label for="inputEmail">Email address</label>
                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Enter email">
                </div>
                
                <div class="form-group">
                    <label for="inputInfo">Information</label>
                    <textarea type="text" rows="4" name="info" class="form-control" id="info_area" placeholder="Type your content here"></textarea>
                </div>

              </form>
              <button type="submit" class="btn btn-default pull-right" onclick="register_form_submit(document.getElementsByName('contrib_form'))">Submit</button>
      			</div>
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

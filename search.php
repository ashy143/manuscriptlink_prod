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
				<div class="col-md-12">
          <div id="register-box">
            <h3>Search</h3>
            <form class="form-inline" action="searchresults.php">
            <div class="row">
              <div class="col-md-5">
                <h4>Bibliographical</h4>
                <div>
                    <select class="form-control">
                        <option>And</option>
                        <option>Or</option>
                        <option>Not</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="bibliographical1">Bibliographial Search String One</label>
                        <input type="text" class="form-control" id="bibliographical1" placeholder="search term">
                    </div>
                </div>
                <div>
                    <select class="form-control">
                        <option>And</option>
                        <option>Or</option>
                        <option>Not</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="bibliographical2">Bibliographial Search String Two</label>
                        <input type="text" class="form-control" id="bibliographical2" placeholder="search term">
                    </div>
                </div>
                <div>
                    <select class="form-control">
                        <option>And</option>
                        <option>Or</option>
                        <option>Not</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="bibliographical3">Bibliographial Search String Three</label>
                        <input type="text" class="form-control" id="bibliographical3" placeholder="search term">
                    </div>
                </div>
                <div>
                    <select class="form-control">
                        <option>And</option>
                        <option>Or</option>
                        <option>Not</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="bibliographical4">Bibliographial Search String Four</label>
                        <input type="text" class="form-control" id="bibliographical4" placeholder="search term">
                    </div>
                </div>

              </div>
              <div class="col-md-7">
                <h4>Codicological</h4>
                <div>
                    <select class="form-control">
                        <option>And</option>
                        <option>Or</option>
                        <option>Not</option>
                    </select>
                    <select class="form-control">
                       <option>----------</option>
                        <option>Lines</option>
                        <option>Columns</option>
                        <option>Dates</option>
                        <option>Miniatures</option>
                        <option>Folios</option>
                        <option>Height</option>
                        <option>Width</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMin1">Codicological String One Min Value</label>
                        <input type="text" class="form-control" id="codicologicalMin1" placeholder="min">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMax1">Codicological String One Max Value</label>
                        <input type="text" class="form-control" id="codicologicalMin1" placeholder="max">
                    </div>
                </div>
                <div>
                    <select class="form-control">
                        <option>And</option>
                        <option>Or</option>
                        <option>Not</option>
                    </select>
                    <select class="form-control">
                       <option>----------</option>
                        <option>Lines</option>
                        <option>Columns</option>
                        <option>Dates</option>
                        <option>Miniatures</option>
                        <option>Folios</option>
                        <option>Height</option>
                        <option>Width</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMin2">Codicological String Two Min Value</label>
                        <input type="text" class="form-control" id="codicologicalMin2" placeholder="min">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMax2">Codicological String Two Max Value</label>
                        <input type="text" class="form-control" id="codicologicalMin2" placeholder="max">
                    </div>
                </div>
                <div>
                    <select class="form-control">
                        <option>And</option>
                        <option>Or</option>
                        <option>Not</option>
                    </select>
                    <select class="form-control">
                       <option>----------</option>
                        <option>Lines</option>
                        <option>Columns</option>
                        <option>Dates</option>
                        <option>Miniatures</option>
                        <option>Folios</option>
                        <option>Height</option>
                        <option>Width</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMin3">Codicological String Three Min Value</label>
                        <input type="text" class="form-control" id="codicologicalMin3" placeholder="min">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMax3">Codicological String Three Max Value</label>
                        <input type="text" class="form-control" id="codicologicalMin3" placeholder="max">
                    </div>
                </div>
                <div>
                    <select class="form-control">
                        <option>And</option>
                        <option>Or</option>
                        <option>Not</option>
                    </select>
                    <select class="form-control">
                       <option>----------</option>
                        <option>Lines</option>
                        <option>Columns</option>
                        <option>Dates</option>
                        <option>Miniatures</option>
                        <option>Folios</option>
                        <option>Height</option>
                        <option>Width</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMin4">Codicological String Four Min Value</label>
                        <input type="text" class="form-control" id="codicologicalMin4" placeholder="min">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMax4">Codicological String Four Max Value</label>
                        <input type="text" class="form-control" id="codicologicalMin4" placeholder="max">
                    </div>
                </div>
                <div>
                    <select class="form-control">
                        <option>And</option>
                        <option>Or</option>
                        <option>Not</option>
                    </select>
                    <select class="form-control">
                        <option>----------</option>
                        <option>Lines</option>
                        <option>Columns</option>
                        <option>Dates</option>
                        <option>Miniatures</option>
                        <option>Folios</option>
                        <option>Height</option>
                        <option>Width</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMin5">Codicological String Five Min Value</label>
                        <input type="text" class="form-control" id="codicologicalMin5" placeholder="min">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMax5">Codicological String Five Max Value</label>
                        <input type="text" class="form-control" id="codicologicalMin5" placeholder="max">
                    </div>
                </div>
                <div>
                    <select class="form-control">
                        <option>And</option>
                        <option>Or</option>
                        <option>Not</option>
                    </select>
                    <select class="form-control">
                        <option>----------</option>
                        <option>Lines</option>
                        <option>Columns</option>
                        <option>Dates</option>
                        <option>Miniatures</option>
                        <option>Folios</option>
                        <option>Height</option>
                        <option>Width</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMin6">Codicological String Six Min Value</label>
                        <input type="text" class="form-control" id="codicologicalMin6" placeholder="min">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMax6">Codicological String Six Max Value</label>
                        <input type="text" class="form-control" id="codicologicalMin6" placeholder="max">
                    </div>
                </div>
                <div>
                    <select class="form-control">
                        <option>And</option>
                        <option>Or</option>
                        <option>Not</option>
                    </select>
                    <select class="form-control">
                        <option>----------</option>
                        <option>Lines</option>
                        <option>Columns</option>
                        <option>Dates</option>
                        <option>Miniatures</option>
                        <option>Folios</option>
                        <option>Height</option>
                        <option>Width</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMin7">Codicological String Seven Min Value</label>
                        <input type="text" class="form-control" id="codicologicalMin7" placeholder="min">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMax7">Codicological String Seven Max Value</label>
                        <input type="text" class="form-control" id="codicologicalMin7" placeholder="max">
                    </div>
                </div>
                <div>
                    <select class="form-control">
                        <option>And</option>
                        <option>Or</option>
                        <option>Not</option>
                    </select>
                    <select class="form-control">
                        <option>----------</option>
                        <option>Lines</option>
                        <option>Columns</option>
                        <option>Dates</option>
                        <option>Miniatures</option>
                        <option>Folios</option>
                        <option>Height</option>
                        <option>Width</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMin8">Codicological String Eight Min Value</label>
                        <input type="text" class="form-control" id="codicologicalMin1" placeholder="min">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMax8">Codicological String Eight Max Value</label>
                        <input type="text" class="form-control" id="codicologicalMin1" placeholder="max">
                    </div>
                </div>
                <br />
                <a href="searchresults.php"><button type="submit" class="btn btn-default pull-left">Search</button></a>
              </div>
            </div>

            </form>



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

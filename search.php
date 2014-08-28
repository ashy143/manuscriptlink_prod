<?php
    include_once './includes/dbconnect.php';
    include_once './includes/functions.php';
    
    session_start();

    if(login_check() == false){
        header("location: ./index.php");
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
            <div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" alt=""/></a></div>
          	<div class="col-md-9" style=" height: 55px;">
            		<ul class="link-nav pull-right">
              		<li class="active"><a href="#">search</a></li>
  		            <li><a href="about.php">about</a></li>
  		            <li><a href="browse.php">browse</a></li>
  		            <li><a href="resources.php">resources</a></li>
  		            <li><a href="#">citation shelfmarks</a></li>
                    <?php if(login_check()) { ?>
  		            <li><a href="#"><?php echo $_SESSION['name'];?></a></li>
                    <?php }else{ ?>
                    <li><a href="login.php">login</a></li>
                    <?php } ?>
            		</ul>
          	</div>
      	</div>

        <?php if(login_check()) {?>
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb pull-right">
                    <li class="active"><a href="#">search</a></li>
                    <li><a href="#">results</a></li>
                    <li><a href="#">record</a></li>
                    <li><a href="#">codex</a></li>
                    <li><a href="#">pan&zoom</a></li>
                    <li><a href="#">juxtapose&compare</a></li>
                    <li ><a href="myarchive.php">my archive</a></li>
                    <li><a href="utils/process_logout.php">logout</a></li>
                </ol>
            </div>
        </div>
        <?php } ?>

    </div>

    	<div class="container">
    		<div class="row">
				<div class="col-md-12">
          <div id="register-box">
            <h3>Search</h3>
            <form class="form-inline" name= "search_form" action="searchresults.php" method="GET">
            <div class="row">
              <div class="col-md-4">
                <h4>Bibliographical</h4>
                <div>
                    <select class="form-control" name="bibliographicalLog1">
                        <option></option>
                        <option>Not</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="bibliographical1">Bibliographial Search String One</label>
                        <input type="text" class="form-control" name='bibliographical1' id="bibliographical1" placeholder="search term">
                    </div>
                </div>
                <div>
                    <select class="form-control" name="bibliographicalLog2">
                        <option>And</option>
                        <option>Or</option>
                        <option>Not</option>
                    </select>
                    <div class="form-group" >
                        <label class="sr-only" for="bibliographical2">Bibliographial Search String Two</label>
                        <input type="text" class="form-control" name='bibliographical2' id="bibliographical2" placeholder="search term">
                    </div>
                </div>
                <div>
                    <select class="form-control" name="bibliographicalLog3">
                        <option>And</option>
                        <option>Or</option>
                        <option>Not</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="bibliographical3">Bibliographial Search String Three</label>
                        <input type="text" class="form-control" name='bibliographical3' id="bibliographical3" placeholder="search term">
                    </div>
                </div>
                <div>
                    <select class="form-control" name="bibliographicalLog4">
                        <option>And</option>
                        <option>Or</option>
                        <option>Not</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="bibliographical4">Bibliographial Search String Four</label>
                        <input type="text" class="form-control" name='bibliographical4' id="bibliographical4" placeholder="search term">
                    </div>
                </div>

              </div>
                <div class="col-md-1">
                    <h4>And</h4>
                </div>
              <div class="col-md-7">
                <h4>Codicological</h4>
                <div>
                    <select class="form-control" name="codicologicalLogic1">
                        <option ></option>
                        <option value = 'NOT'>Not</option>
                    </select>
                    <select class="form-control" name="codicologicalTerm1">
                        <option value = 'NA' >--</option>
                        <option value = 'fol.no_of_lines'>Lines</option>
                        <option value = 'fol.no_of_col'>Columns</option>
                        <option value = 'ms.date_manuscript'>Dates</option>
                        <option value = 'ms.miniatures'>Miniatures</option>
                        <option value = 'ms.numof_avail_folios'>Folios</option>
                        <option value = 'fol.height'>Height</option>
                        <option value = 'fol.width'>Width</option>
                    </select>
                    <div class="form-group" >
                        <label class="sr-only" for="codicologicalMin1">Codicological String One Min Value</label>
                        <input type="text" class="form-control" id="codicologicalMin1" name="codicologicalMin1" placeholder="min">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMax1">Codicological String One Max Value</label>
                        <input type="text" class="form-control" id="codicologicalMax1" name="codicologicalMax1" placeholder="max">
                    </div>
                </div>
                <div>
                    <select class="form-control" name="codicologicalLogic2">
                        <option value = 'AND'>And</option>
                        <option value = 'OR'>Or</option>
                        <option value = 'NOT'>Not</option>
                    </select>
                    <select class="form-control" name="codicologicalTerm2">
                        <option value = 'NA' >--</option>
                        <option value = 'fol.no_of_lines'>Lines</option>
                        <option value = 'fol.no_of_col'>Columns</option>
                        <option value = 'ms.date_manuscript'>Dates</option>
                        <option value = 'ms.miniatures'>Miniatures</option>
                        <option value = 'ms.numof_avail_folios'>Folios</option>
                        <option value = 'fol.height'>Height</option>
                        <option value = 'fol.width'>Width</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMin2">Codicological String Two Min Value</label>
                        <input type="text" class="form-control" id="codicologicalMin2" name="codicologicalMin2" placeholder="min">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMax2">Codicological String Two Max Value</label>
                        <input type="text" class="form-control" id="codicologicalMax2" name="codicologicalMax2" placeholder="max">
                    </div>
                </div>
                <div>
                    <select class="form-control" name="codicologicalLogic3">
                        <option value = 'AND'>And</option>
                        <option value = 'OR'>Or</option>
                        <option value = 'NOT'>Not</option>
                    </select>
                    <select class="form-control" name="codicologicalTerm3">
                        <option value = 'NA' >--</option>
                        <option value = 'fol.no_of_lines'>Lines</option>
                        <option value = 'fol.no_of_col'>Columns</option>
                        <option value = 'ms.date_manuscript'>Dates</option>
                        <option value = 'ms.miniatures'>Miniatures</option>
                        <option value = 'ms.numof_avail_folios'>Folios</option>
                        <option value = 'fol.height'>Height</option>
                        <option value = 'fol.width'>Width</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMin3">Codicological String Three Min Value</label>
                        <input type="text" class="form-control" id="codicologicalMin3" name="codicologicalMin3" placeholder="min">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMax3">Codicological String Three Max Value</label>
                        <input type="text" class="form-control" id="codicologicalMax3" name="codicologicalMax3" placeholder="max">
                    </div>
                </div>
                <div>
                    <select class="form-control"  name="codicologicalLogic4">
                        <option>And</option>
                        <option>Or</option>
                        <option>Not</option>
                    </select>
                    <select class="form-control" name="codicologicalTerm4">
                        <option value = 'NA' >--</option>
                        <option value = 'fol.no_of_lines'>Lines</option>
                        <option value = 'fol.no_of_col'>Columns</option>
                        <option value = 'ms.date_manuscript'>Dates</option>
                        <option value = 'ms.miniatures'>Miniatures</option>
                        <option value = 'ms.numof_avail_folios'>Folios</option>
                        <option value = 'fol.height'>Height</option>
                        <option value = 'fol.width'>Width</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMin4">Codicological String Four Min Value</label>
                        <input type="text" class="form-control" id="codicologicalMin4" name="codicologicalMin4" placeholder="min">
                    </div>
                    <div class="form-group" >
                        <label class="sr-only" for="codicologicalMax4">Codicological String Four Max Value</label>
                        <input type="text" class="form-control" id="codicologicalMax4" name="codicologicalMax4" placeholder="max">
                    </div>
                </div>
                <div>
                    <select class="form-control" name="codicologicalLogic5">
                        <option value = 'AND'>And</option>
                        <option value = 'OR'>Or</option>
                        <option value = 'NOT'>Not</option>
                    </select>
                    <select class="form-control" name="codicologicalTerm5">
                        <option value = 'NA' >--</option>
                        <option value = 'fol.no_of_lines'>Lines</option>
                        <option value = 'fol.no_of_col'>Columns</option>
                        <option value = 'ms.date_manuscript'>Dates</option>
                        <option value = 'ms.miniatures'>Miniatures</option>
                        <option value = 'ms.numof_avail_folios'>Folios</option>
                        <option value = 'fol.height'>Height</option>
                        <option value = 'fol.width'>Width</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMin5">Codicological String Five Min Value</label>
                        <input type="text" class="form-control" id="codicologicalMin5" name="codicologicalMin5" placeholder="min">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMax5">Codicological String Five Max Value</label>
                        <input type="text" class="form-control" id="codicologicalMax5" name="codicologicalMax5" placeholder="max">
                    </div>
                </div>
                <div>
                    <select class="form-control" name="codicologicalLogic6">
                        <option value = 'AND'>And</option>
                        <option value = 'OR'>Or</option>
                        <option value = 'NOT'>Not</option>
                    </select>
                    <select class="form-control" name="codicologicalTerm6">
                        <option value = 'NA' >--</option>
                        <option value = 'fol.no_of_lines'>Lines</option>
                        <option value = 'fol.no_of_col'>Columns</option>
                        <option value = 'ms.date_manuscript'>Dates</option>
                        <option value = 'ms.miniatures'>Miniatures</option>
                        <option value = 'ms.numof_avail_folios'>Folios</option>
                        <option value = 'fol.height'>Height</option>
                        <option value = 'fol.width'>Width</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMin6">Codicological String Six Min Value</label>
                        <input type="text" class="form-control" id="codicologicalMin6" id="codicologicalMax6" placeholder="min">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMax6">Codicological String Six Max Value</label>
                        <input type="text" class="form-control" id="codicologicalMax6" name="codicologicalMax6" placeholder="max">
                    </div>
                </div>
                <div>
                    <select class="form-control" name="codicologicalLogic7">
                        <option value = 'AND'>And</option>
                        <option value = 'OR'>Or</option>
                        <option value = 'NOT'>Not</option>
                    </select>
                    <select class="form-control" name="codicologicalTerm7">
                        <option value = 'NA' >--</option>
                        <option value = 'fol.no_of_lines'>Lines</option>
                        <option value = 'fol.no_of_col'>Columns</option>
                        <option value = 'ms.date_manuscript'>Dates</option>
                        <option value = 'ms.miniatures'>Miniatures</option>
                        <option value = 'ms.numof_avail_folios'>Folios</option>
                        <option value = 'fol.height'>Height</option>
                        <option value = 'fol.width'>Width</option>
                    </select>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMin7">Codicological String Seven Min Value</label>
                        <input type="text" class="form-control" id="codicologicalMin7" name="codicologicalMin7" placeholder="min">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="codicologicalMax7">Codicological String Seven Max Value</label>
                        <input type="text" class="form-control" id="codicologicalMax7" name="codicologicalMax7" placeholder="max">
                    </div>
                </div>
               
                <br />
<!--                <a href="#"><button type="submit" class="btn btn-default pull-left" onclick="search_form_submit(document.getElementsByName('login_form'))">Search</button></a>-->
              </div>
            </div>

            </form>
            <a ><button type="submit" class="btn btn-default pull-left" onclick="search_form_submit(document.getElementsByName('search_form'))">Search</button></a>


          </div>
        </div>

    		</div>
    	</div>






    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/models/BibliolographicalQuery.js"></script>
    <script src="js/models/CodologicalQuery.js"></script>
    <script src="js/models/SearchQuery.js"></script>
    <script type="text/javascript">
    function search_form_submit(form) {
        var searchQueryParams = new SearchQuery();

        for ( var i = 1; i < 5; i++ ) {
            var biblioQuery = new BibliographicalQuery();
            biblioQuery.logic = $("select[name=bibliographicalLog" + i + "]").val();
            biblioQuery.term = $("input[id=bibliographical" + i + "]").val();
            searchQueryParams.bibliological.push(biblioQuery);

         }

         for ( var i = 1; i < 8; i++ ) {
            var codologQuery = new CodologicalQuery();
            codologQuery.logic = $("select[name=codicologicalLogic" + i + "]").val(); 
            codologQuery.min = $("input[name=codicologicalMin" + i + "]").val(); 
            codologQuery.max = $("input[name=codicologicalMax" + i + "]").val(); 
            codologQuery.term = $("select[name=codicologicalTerm" + i + "]").val();
            searchQueryParams.codological.push(codologQuery);

         }

         console.log(searchQueryParams);

//         $.post("searchresults.php", {data : searchQueryParams }); 
            
            $(form).submit(); 
        }
    </script>
  </body>
</html>

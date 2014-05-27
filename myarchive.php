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
              <a href="user.php"><button type="button" class="btn btn-danger">Clear Archive</button></a>
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
  		            <li class="active"><a href="user.php">user</a></li>
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
            <div id="archive" class="col-md-8">
                  <div class="holding">
                      <h4>Amherst, MA, UMassA MS Schoyen 13 (fol. 43)</h4>
                      <div class="delButton">Delete</div>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse1" data-toggle="collapse" data-parent="#archive"><div class="imgButton">Images</div></a>
                      <div id="collapse1" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>
                  </div>
                  <div class="holding">
                      <h4>Athens, GA, UGeorge MS 122 (fol. 55)</h4>
                      <div class="delButton">Delete</div>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse2" data-toggle="collapse" data-parent="#archive"><div class="imgButton">Images</div></a>
                      <div id="collapse2" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>

                  </div>
                  <div class="holding">
                      <h4>Columbia, SC, USCaro Early MS 122 (fol. 24)</h4>
                      <div class="delButton">Delete</div>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse3" data-toggle="collapse" data-parent="#archive"><div class="imgButton">Images</div></a>
                      <div id="collapse3" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>

                  </div>
                  <div class="holding">
                      <h4>Columbus, OH, OSUniv MS XII. 13a (fol. 13)</h4>
                      <div class="delButton">Delete</div>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse4" data-toggle="collapse" data-parent="#archive"><div class="imgButton">Images</div></a>
                      <div id="collapse4" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>

                  </div>
                  <div class="holding">
                      <h4>Northampton, MA, SmithC MS 10 (fol. 3)</h4>
                      <div class="delButton">Delete</div>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse5" data-toggle="collapse" data-parent="#archive"><div class="imgButton">Images</div></a>
                      <div id="collapse5" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>

                  </div>                                                      
                  <div class="holding">
                      <h4>Amherst, MA, UMassA MS Schoyen 13 (fol. 43)</h4>
                      <div class="delButton">Delete</div>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse6" data-toggle="collapse" data-parent="#archive"><div class="imgButton">Images</div></a>
                      <div id="collapse6" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>
                  </div>
                  <div class="holding">
                      <h4>Athens, GA, UGeorge MS 122 (fol. 55)</h4>
                      <div class="delButton">Delete</div>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse7" data-toggle="collapse" data-parent="#archive"><div class="imgButton">Images</div></a>
                      <div id="collapse7" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>

                  </div>
                  <div class="holding">
                      <h4>Columbia, SC, USCaro Early MS 122 (fol. 24)</h4>
                      <div class="delButton">Delete</div>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse8" data-toggle="collapse" data-parent="#archive"><div class="imgButton">Images</div></a>
                      <div id="collapse8" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>

                  </div>
                  <div class="holding">
                      <h4>Columbus, OH, OSUniv MS XII. 13a (fol. 13)</h4>
                      <div class="delButton">Delete</div>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse9" data-toggle="collapse" data-parent="#archive"><div class="imgButton">Images</div></a>
                      <div id="collapse9" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>

                  </div>
                  <div class="holding">
                      <h4>Northampton, MA, SmithC MS 10 (fol. 3)</h4>
                      <div class="delButton">Delete</div>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse10" data-toggle="collapse" data-parent="#archive"><div class="imgButton">Images</div></a>
                      <div id="collapse10" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>

                  </div>     

            </div>
        </div>
    </div>





    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script launguage="JavaScript">
        $('.holding').click(function() { 
          $(this).toggleClass('clickedArc', 1000, "easeOutSine");
        });
        $('.imgButton').click(function() {
          $(this).toggleClass('clickedImgButton', 1000, "easeOutSine");
          $(this).parents('.holding').toggleClass('clickedArc', 1000, "easeOutSine");
        });
    </script> 
    <script type="text/javascript">
      $(".delButton").click(function(event) {
        event.preventDefault();
        $(this).parents('.holding').fadeOut();
      });
    </script>   
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

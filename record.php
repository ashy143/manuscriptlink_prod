<?php 
    require_once './includes/functions.php';
    session_start();
//    var_dump($_POST['data']);
    $manuscript_id = $_POST['id'];
    $json_decoded_data = json_decode($_POST['data']);
    
    $query = "SELECT * "
            . "FROM manuscript LEFT JOIN origin ON manuscript.mscript_id = origin.mscript_id " 
            . "WHERE manuscript.mscript_id = ". $manuscript_id ;
//    echo $query;
    $manuscript_obj = getManuscriptById($manuscript_id);
    //echo var_dump($manuscript_obj);
    $folio_objs = getFoliosByManuscriptId($manuscript_id);
    
    
    
    
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
              <div class="col-md-6">
                  <h2 class="record">manuscriptlink #<?php echo $manuscript_obj->mlinknum ; ?></h2>
                  <div class="metadata">
                      <dl class="dl-horizontal"> 
                          <dt>Author</dt>
                            <dd><?php echo $manuscript_obj->artist ; ?></dd>
                          <dt>Text</dt>
                            <dd><?php echo $manuscript_obj->text_type ; ?></dd>
                          <dt>Date</dt>
                            <dd><?php echo $manuscript_obj->date_manu ; ?></dd>
                          <dt>Origin</dt>
                            <dd><?php echo $manuscript_obj->origin->country . " (" . $manuscript_obj->origin->municipality . ")" ; ?></dd>
                          <dt>Scribe</dt>
                            <dd><?php echo $manuscript_obj->scribe ; ?></dd>
                          <dt>Artist</dt>
                            <dd><?php echo $manuscript_obj->artist ; ?></dd>
                          <dt>Bibliography</dt>
                            <dd><?php echo $manuscript_obj->biblio ; ?></dd>
                          <dt>Dimmensions</dt>
                            <dd><?php echo $json_decoded_data->width;?> x <?php echo $json_decoded_data->height; ?> mm</dd>
                          <dt>Justification</dt>
                            <dd><?php echo $json_decoded_data->width_written;?> x <?php echo $json_decoded_data->height_written; ?> mm</dd>
                          <dt>Lines</dt>
                            <dd><?php $json_decoded_data->no_of_lines; ?></dd>
                          <dt>Decoration</dt>
                            <dd><?php echo $manuscript_obj->decoration ; ?></dd>
                          <dt>Script</dt>
                            <dd><?php echo $manuscript_obj->script ; ?></dd>
                          <dt>Collation</dt>
                            <dd><?php echo $manuscript_obj->collation ; ?></dd>
                          <dt>Dimmensions of Staff</dt>
                            <dd><?php $json_decoded_data->dim_staff; ?></dd>
                      </dl>
                  </div>
                          <a href="codex.php"><div class="arc-button rec-button puff">Codex</div></a>
                          <a href="panzoom.php"><div class="arc-button rec-button puff">Pan &amp; Zoom</div></a><br />
                  <a href="searchresults.php"><div class="escape arc-search puff">Back to Search</div></a>
              </div>

              <div id="listings" class="col-md-6">                  
                  <h3>shelfmarks <small class="pull-right">avaliable folios: <?php echo $manuscript_obj->no_of_avail_fol ; ?></small></h3>
                  
                  
                  <?php $count=1; foreach($folio_objs as $folio_obj){ ?>
                  <div class="holding">
                      
                      <h4><?php echo $folio_obj->folio_location->municipality . " " . $folio_obj->folio_location->state. " " . $folio_obj->abbreviated_shelf . " fol. " . $folio_obj->folio_num . $folio_obj->folio_side ;?></h4>
                      <a href="codex.php?mscript_id=<?php echo $folio_obj->mscript_id; ?>"><div class="codexButton">Codex</div></a>
                      <a href="#collapse<?php echo $count ?>" data-toggle="collapse" data-parent="#listings"><div class="imgButton">Images</div></a>
                      <div id="collapse<?php echo $count ?>" class="panel-collapse collapse">
                          <div class="rThumb"><a href="panzoom.php"><img style =" height:200px; width: 144px; "  src="<?php echo "./images/".$folio_obj->res_ident ;?>" /><br /><?php echo " fol. " . $folio_obj->folio_num . $folio_obj->folio_side ; ?></a></div>
                        
                      </div>
                  </div>
                  <?php $count = $count +1 ; } ?>
                  
                 
                  <!--
                  <div class="holding">
                      <h4>Columbia, SC, USCaro Early MS 122 (fol. 24)</h4>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse3" data-toggle="collapse" data-parent="#listings"><div class="imgButton">Images</div></a>
                      <div id="collapse3" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>

                  </div>
                  <div class="holding">
                      <h4>Columbus, OH, OSUniv MS XII. 13a (fol. 13)</h4>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse4" data-toggle="collapse" data-parent="#listings"><div class="imgButton">Images</div></a>
                      <div id="collapse4" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>

                  </div>
                  <div class="holding">
                      <h4>Northampton, MA, SmithC MS 10 (fol. 3)</h4>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse5" data-toggle="collapse" data-parent="#listings"><div class="imgButton">Images</div></a>
                      <div id="collapse5" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>

                  </div>                                                      
                  <div class="holding">
                      <h4>Amherst, MA, UMassA MS Schoyen 13 (fol. 43)</h4>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse6" data-toggle="collapse" data-parent="#listings"><div class="imgButton">Images</div></a>
                      <div id="collapse6" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>
                  </div>
                  <div class="holding">
                      <h4>Athens, GA, UGeorge MS 122 (fol. 55)</h4>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse7" data-toggle="collapse" data-parent="#listings"><div class="imgButton">Images</div></a>
                      <div id="collapse7" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>

                  </div>
                  <div class="holding">
                      <h4>Columbia, SC, USCaro Early MS 122 (fol. 24)</h4>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse8" data-toggle="collapse" data-parent="#listings"><div class="imgButton">Images</div></a>
                      <div id="collapse8" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>

                  </div>
                  <div class="holding">
                      <h4>Columbus, OH, OSUniv MS XII. 13a (fol. 13)</h4>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse9" data-toggle="collapse" data-parent="#listings"><div class="imgButton">Images</div></a>
                      <div id="collapse9" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>

                  </div>
                  <div class="holding">
                      <h4>Northampton, MA, SmithC MS 10 (fol. 3)</h4>
                      <a href="codex.php"><div class="codexButton">Codex</div></a>
                      <a href="#collapse10" data-toggle="collapse" data-parent="#listings"><div class="imgButton">Images</div></a>
                      <div id="collapse10" class="panel-collapse collapse">
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_r.png" /><br />fol. 43r</a></div>
                        <div class="rThumb"><a href="panzoom.php"><img src="img/thumb_v.png" /><br />fol. 43r</a></div>
                      </div>

                  </div>     
                  -->

            </div>
                                                 
      		</div>
    	</div>






    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script language="javascript">
        $('.imgButton').click(function() {
          $(this).toggleClass('clickedImgButton', 1000, "easeOutSine");
          $(this).parents('.holding').toggleClass('clickedArc', 1000, "easeOutSine");
        });
    </script> 
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

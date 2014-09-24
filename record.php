<?php 
    include_once './includes/functions.php';
    include_once './includes/config.php';
    session_start();

    if(login_check() == false){
        header("location: ./index.php");
    }
    
    $manuscript_id = $_GET['id'];
    // $json_decoded_data = json_decode($_GET['data']);
    $mlinknumber = $_GET['mlinknum'];

    //check if parts of manuscript are available
    $con = mysql_connect(HOST.':'.PORT, USER, PASSWORD) or die("Unable to connect to MySQL");
    mysql_select_db(DATABASE, $con) or die("Could not select" .mysql_error());

    class MSEXT_OBJ{
        public $title  = "--";
        public $height;
        public $width;
        public $height_written;
        public $width_written;
        public $no_of_lines;
        public $dim_staff;
        public $mscript_obj;

    }
    //$manuscriptByPartQuery = mysql_query("Select mscript_id from manuscript where mlinknumber = $mlinknumber ") or die(mysql_error());

    $manuscriptByPartQuery = "SELECT ms.mscript_id,  fol.title, fol.height, fol.width, fol.height_written, fol.width_written, fol.no_of_lines, fol.dim_staff "
                    ." FROM "
                ." (manuscript AS ms INNER JOIN origin AS ori ON ms.mscript_id = ori.mscript_id) "
                    ." INNER JOIN "
                ." (folios AS fol INNER JOIN location AS loc ON fol.folio_id = loc.folio_id )"
                    . " ON ms.mscript_id = fol.mscript_id WHERE ms.mlinknumber = $mlinknumber GROUP BY ms.mscript_id ";


    $manuscriptsWithParts = array();
    $manuscriptByPartResults = mysql_query($manuscriptByPartQuery) or die(mysql_error());
    while($row = mysql_fetch_row($manuscriptByPartResults)){
            $manuscript_obj = getManuscriptById($row[0]);
            $mext_obj = new MSEXT_OBJ();
            $mext_obj->mscript_obj = $manuscript_obj;
            $mext_obj->mscript_id = $row[0];
            $mext_obj->title = $row[1];
            $mext_obj->height = $row[2];
            $mext_obj->width = $row[3];
            $mext_obj->height_written = $row[4];
            $mext_obj->width_written = $row[5];
            $mext_obj->no_of_lines = $row[6];
            $mext_obj->dim_staff = $row[7];
            
            // $manuscript_ext_objs[] = $mext_obj;
            $manuscriptsWithParts[] = $mext_obj;
        } 

       
    $manuscript_obj = getManuscriptById($manuscript_id);
    
    $folio_objs = array();
    foreach($manuscriptsWithParts as $part){
      //$folio_objs[] = getFoliosByManuscriptId($part->mscript_obj->mscript_id);
      foreach (getFoliosByManuscriptId($part->mscript_obj->mscript_id) as $fob_obj) {
        $folio_objs[] = $fob_obj;
      }
    }
    error_log('fol count: '.count($folio_objs));

    //getFoliosByManuscriptId($manuscript_id);
    $combined_folio_objs = array(); //to hold array of folios with same folio number(will add value from A in this array)
    $prev_page = -1;
    if(count($folio_objs)>0){
        //$prev_page = $folio_objs[0]->folio_num;
        $prev_abbreviated_shelf = $folio_objs[0]->abbreviated_shelf;
    }
    $fobs = array();    //each array represent folios belonging to same folio_number LABEL: A 
    foreach($folio_objs as $fob){
        
        //if($prev_page == $fob->folio_num ){
        if($prev_abbreviated_shelf == $fob->abbreviated_shelf ){
            $fobs[] = $fob;            
        }else{
            $combined_folio_objs[] = $fobs;
            //$prev_page = $fob->folio_num; 
            $prev_abbreviated_shelf = $fob->abbreviated_shelf;         
            $fobs = array();
            $fobs[] = $fob;
        }        
    }
    $combined_folio_objs[] = $fobs;
    
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
    
    <script type="text/javascript">
        function view_record(form) {
            $(form).submit(); 
        }
    </script>
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
  		            <li><a href="#"><?php echo $_SESSION['name'];?></a></li>
            		</ul>
          	</div>
      	</div>

        <?php if(login_check()) {?>
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb pull-right">
                    <li><a href="#">search</a></li>
                    <li><a href="#">results</a></li>
                    <li class="active"><a href="#">record</a></li>
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
              <div class="col-md-6">

                  <!-- Loop for this block for each part -->
                  <?php foreach($manuscriptsWithParts as $mobj) { 
                    $manuscript_obj = $mobj->mscript_obj;
                  ?>
                  <h2 class="record">manuscriptlink #<?php echo $manuscript_obj->mlinknum . "." . $manuscript_obj->part; ?></h2>
                  <div class="metadata">
                      <dl class="dl-horizontal"> 
                          <dt>Author</dt>
                            <dd><?php echo $manuscript_obj->artist ; ?></dd>
                          <dt>Text</dt>
                            <dd><?php echo $mobj->title ; ?></dd>
                          <dt>Date</dt>
                            <dd><?php echo $manuscript_obj->date_manu ; ?></dd>
                          <dt>Origin</dt>
                            <dd><?php echo $manuscript_obj->origin->country ;//. " (" . $manuscript_obj->origin->municipality . ")" ; ?></dd>
                          <dt>Scribe</dt>
                            <dd><?php echo $manuscript_obj->scribe ; ?></dd>
                          <dt>Artist</dt>
                            <dd><?php echo $manuscript_obj->artist ; ?></dd>
                          <dt>Bibliography</dt>
                            <dd><?php echo $manuscript_obj->biblio ; ?></dd>
                          <dt>Dimensions</dt>
                            <dd><?php echo $mobj->width;?> x <?php echo $mobj->height; ?> mm</dd>
                          <dt>Justification</dt>
                            <dd><?php echo $mobj->width_written;?> x <?php echo $mobj->height_written; ?> mm</dd>
                          <dt>Lines</dt>
                            <dd><?php echo $manuscript_obj->min_lines . ' to ' . $manuscript_obj->max_lines; ?></dd>
                          <dt>Decoration</dt>
                            <dd><?php echo $manuscript_obj->decoration ; ?></dd>
                          <dt>Script</dt>
                            <dd><?php echo $manuscript_obj->script ; ?></dd>
                          <dt>Collation</dt>
                            <dd><?php echo $manuscript_obj->collation ; ?></dd>
                          <dt>Dimensions of Staff</dt>
                            <dd><?php $mobj->dim_staff; ?></dd>
                      </dl>
                  </div>
                          <a href="codex.php"><div class="arc-button rec-button puff">Codex</div></a>
                          <!-- <a href="panzoom.php"><div class="arc-button rec-button puff">Pan &amp; Zoom</div></a><br /> -->
                          <a href="search.php"><div class="arc-button rec-button puff">Back to Search</div></a><br />
                  <!-- <a href="search.php"><div class="escape arc-search puff">Back to Search</div></a> -->

                  <BR><BR>

                  <?php } ?>
                  <!-- End loop here for each part -->

              </div>

              <div id="listings" class="col-md-6">                  
                  <h3>shelfmarks <small class="pull-right">avaliable folios: <?php echo $manuscript_obj->no_of_avail_fol ; ?></small></h3>
                  
                  
                  <?php $count=1; foreach($combined_folio_objs as $folio_obj_array){ ?>
                  <form name='<?php echo $count; ?>' method="GET" action='codex.php'>
                        <input type="hidden" name='id' value ='<?php echo $folio_obj_array[0]->mscript_id; ?>'/>
                        <input type="hidden" name='data' value ='<?php //echo $_GET['data']; ?>'/>
                  </form>
                  
                  <div class="holding">                      
                      <h4><?php echo $folio_obj_array[0]->abbreviated_shelf ;?></h4>
                      <a onclick="view_record(document.getElementsByName('<?php echo $count;?>'));"><div class="codexButton">Codex</div></a>
                      <a href="#collapse<?php echo $count ?>" data-toggle="collapse" data-parent="#listings"><div class="imgButton">Images</div></a>
                      <div id="collapse<?php echo $count ?>" class="panel-collapse collapse">
                          <?php foreach($folio_obj_array as $folio_obj){?>
                          <div class="rThumb"><a href="panzoom.php?imagepath=<?php echo $folio_obj->res_ident; ?>&mscript_id=<?php echo $_GET['id'] ;?>&folio_id=<?php echo $folio_obj->folio_id; ?>"><img style =" height:200px; width: 144px; "  src = '<?php echo "image.php?img_path=".$folio_obj->res_ident ;?>' /><br /><?php echo " fol. " . $folio_obj->folio_num . $folio_obj->folio_side ; ?></a></div>
                          <?php } ?>  
                      </div>
                  </div>
                  <?php $count = $count +1 ; } ?>
                  
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

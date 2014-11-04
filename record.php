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

    $manuscriptByPartQuery = "SELECT ms.mscript_id,  fol.title, fol.height, fol.width, fol.height_written, fol.width_written, fol.no_of_lines, fol.dim_staff, fol.alt_title, "
                    ." min(fol.min_ht) as min_ht, max(fol.max_ht) as max_ht, min(fol.min_width) as min_wt, max(fol.max_width) as max_wt, min(no_of_col) as min_col, max(no_of_col) as max_col, "
                    ." min(no_of_lines) as min_lines, max(no_of_lines) as max_lines "
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
            $mext_obj->alt_title = $row[8];
            $mext_obj->min_ht = $row[9];
            $mext_obj->max_ht = $row[10];
            $mext_obj->min_wt = $row[11];
            $mext_obj->max_wt = $row[12];
            $mext_obj->min_col = $row[13];
            $mext_obj->max_col = $row[14];
            $mext_obj->min_lines = $row[15];
            $mext_obj->max_lines = $row[16];
            
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
    <link href="css/menubarStyles.css" rel="stylesheet">
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

    <!-- copy this block where ever you require citation shelfmark -->
    <div class="modal fade" id="shelfmarks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        
    </div>

    <div class="container">
      	<div class="row">
            <div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" /></div>
          	<div class="col-md-9" style=" height: 55px;">
            		<ul class="link-nav pull-right">
              		<li class="active"><a href="search.php">search</a></li>
  		            <li><a href="about.php">about</a></li>
  		            <li><a href="browse.php">browse</a></li>
  		            <li><a href="resources.php">resources</a></li>
  		            <li><a href="#" data-toggle="modal" data-target="#shelfmarks">citation shelfmarks</a></li>
  		            <li><a href="#"><?php echo $_SESSION['name'];?></a></li>
            		</ul>
          	</div>
      	</div>

        <?php if(login_check()) {?>
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb pull-right">
                    <li ><a href="myarchive.php">my archive</a></li>
                    <li><a href="utils/process_logout.php">logout</a></li>
                </ol>
                <ol class="breadcrumb pull-right">
                    <li>results</a></li>
                    <li class="active">record</li>
                    <li>codex</li>
                    <li>pan&zoom</li>
                    <li>juxtapose&compare</li>
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

                    $line1 = '';
                    if(!strcasecmp($manuscript_obj->artist, '') == 0){
                      $line1 .= $manuscript_obj->artist . ', ' ;   
                    }
                    if(!strcasecmp($mobj->title, '') == 0){
                      $line1 .= $mobj->title . ', ' ;
                    }
                    if(!strcasecmp($mobj->alt_title, '') == 0){
                      $line1 .= $mobj->alt_title . '. ' ;
                    }
                    if(strcasecmp($manuscript_obj->text_type, 'Liturgical') == 0){
                      $line1 .= '(Use of ' . $manuscript_obj->liturgical_use . '). ' ;
                    }
                    if(!strcasecmp($manuscript_obj->language, '') == 0){
                      $line1 .= $manuscript_obj->language . '. ' ;   
                    }

                    $line2 = '';
                    if(!strcasecmp($manuscript_obj->origin->country, '') == 0){
                      $line2 .= $manuscript_obj->origin->country . '. ' ;   
                    }
                    if(!strcasecmp($manuscript_obj->origin->region, '') == 0){
                      $line2 .= '('.$manuscript_obj->origin->region . '). ' ;   
                    }
                    if(!strcasecmp($manuscript_obj->origin->municipality, '') == 0){
                      $line2 .= $manuscript_obj->origin->municipality . '. ' ;   
                    }
                    if(!strcasecmp($manuscript_obj->origin->institution, '') == 0){
                      $line2 .= $manuscript_obj->origin->institution . '. ' ;   
                    }
                    if(!strcasecmp($manuscript_obj->origin->commagent, '') == 0){
                      $line2 .= 'Commissioned by ' .$manuscript_obj->origin->commagent . '. ' ;   
                    }

                    $line3 = $manuscript_obj->date_manu ;

                    $line4 = '';
                    if(!strcasecmp($manuscript_obj->writing_sup, '') == 0){
                      $line4 .= $manuscript_obj->writing_sup . ', ' ;   
                    }

                    $ht_range = $mobj->min_ht;
                    if($mobj->max_ht > $mobj->min_ht){
                      $ht_range .= '-' . $mobj->max_ht; 
                    }

                    $width_range = $mobj->min_wt;
                    if($mobj->max_wt > $mobj->min_wt){
                      $width_range .= '-' . $mobj->max_wt; 
                    }

                    $lines_range = $mobj->min_lines;
                    if($mobj->max_lines > $mobj->min_lines){
                      $lines_range .= '-' . $mobj->max_lines; 
                    }

                    $col_range = $mobj->min_col;
                    if($mobj->max_col > $mobj->min_col){
                      $col_range .= '-' . $mobj->max_col; 
                    }

                    $line4 .= $ht_range . 'mm x ' . $width_range . 'mm ';
                    $line4 .= '(Justification ' . $mobj->height_written  . 'mm x ' . $mobj->width_written .  'mm). ';
                    $line4 .= $col_range . ' columns, '. $lines_range . ' lines. ';
                    if(!strcasecmp($manuscript_obj->ruling_med, '') == 0){
                      $line4 .= 'Ruled in ' . $manuscript_obj->ruling_med . '. ' ;   
                    }
                    if(!strcasecmp($manuscript_obj->script, '') == 0){
                      $line4 .= 'Written in ' . $manuscript_obj->script . '. ' ;
                    }

                    $line5 = $manuscript_obj->scribe;
                    $line6 = $manuscript_obj->artist;

                    $line7 = '';
                    $line8 = '';
                    if(!strcasecmp($manuscript_obj->miniatures, '') == 0){
                      $line8 .= 'Miniatures: ' . $manuscript_obj->miniatures . '. ' ;
                    }
                    $line8 .= $manuscript_obj->decoration . '.';
                    $line9 = '';
                    if(!strcasecmp($manuscript_obj->schoen_num, '') == 0){
                      $line9 .= 'Schoenberg # ' . $manuscript_obj->schoen_num . '. ' ;
                    }
                    if(!strcasecmp($manuscript_obj->history, '') == 0){
                      $line9 .= $manuscript_obj->history ;
                    }
                    $line10 = '';
                    if(!strcasecmp($manuscript_obj->edition_cited, '') == 0){
                      $line10 .= 'Edition Cited: ' . $manuscript_obj->edition_cited . '. ' ;
                    }
                    if(!strcasecmp($manuscript_obj->biblio, '') == 0){
                      $line10 .= 'Secondary Sources: ' . $manuscript_obj->biblio . '. ' ;
                    }
 
                  ?>
                  <h2 class="record">manuscriptlink #<?php echo $manuscript_obj->mlinknum . "." . $manuscript_obj->part; ?></h2>
                  <div class="metadata">
                      <dl class="dl-horizontal">
                          
                          <dt>Contents</dt>
                            <dd><?php echo $line1; ?></dd>
                          <dt>Origin</dt>
                            <dd><?php echo $line2; ?></dd>
                          <dt>Date</dt>
                            <dd><?php echo $line3; ?></dd>
                          <dt>Layout</dt>
                            <dd><?php echo $line4; ?></dd>  
                          <dt>Scribe</dt>
                            <dd><?php echo $line5; ?></dd>
                          <dt>Artist</dt>
                            <dd><?php echo $line6; ?></dd>
                          <dt>Music</dt>
                            <dd><?php echo $line7; ?></dd>
                          <dt>Decoration</dt>
                            <dd><?php echo $line8; ?></dd>
                          <dt>Provenance</dt>
                            <dd><?php echo $line9; ?></dd>
                          <dt>Bibliography</dt>
                            <dd><?php echo $line10; ?></dd>
                          
                      </dl>
                  </div>
                          <a href="codex.php?id=<?php echo $mobj->mscript_id; ?>&folio_id=-1"><div class="arc-button rec-button puff">Codex</div></a>
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
                        <input type="hidden" name='folio_id' value ='<?php echo -1 ; ?>'/>
                  </form>
                  
                  <div class="holding">                      
                      <h4><?php echo $folio_obj_array[0]->abbreviated_shelf ;?></h4>
                      <a href="#" onclick="view_record(document.getElementsByName('<?php echo $count;?>'));"><div class="codexButton">Codex</div></a>
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

        $(document).ready(function(){
            $("#shelfmarks").load('citationShelfmark.php');
        });
    </script> 
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

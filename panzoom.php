<?php 
    include_once './includes/functions.php';
    session_start();   
    $folio_objs = getFoliosByManuscriptId($_GET['mscript_id']);
    $folio_obj = getFolioById($_GET['folio_id']);
    $mlinknum = getMlinkNumberOfManuscript($_GET['mscript_id']);

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
    
    
    <link rel='stylesheet' type="text/css" href='css/bootstrap-responsive.css'>        
    <link rel="stylesheet" type="text/css" href="css/thumbelina.css">
    <link rel="stylesheet" type="text/css" href="css/panzoom.css">
    <script>
        function view_record(form) {
            $(form).submit(); 
        }
    </script>   
  </head>
  <body data-spy="scroll" data-target="#master" data-offset="100">

    <!-- copy this block where ever you require citation shelfmark -->
    <div class="modal fade" id="shelfmarks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        
    </div>

    <form name='recordForm' method="GET" action='record.php'>
        <input type="hidden" name='id' value ='<?php echo $_GET['mscript_id']; ?>'/>
        <input type="hidden" name='mlinknum' value ='<?php echo $mlinknum ; ?>'/>
    </form>

    <div class="container">
      	<div class="row">
            <div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" alt=''/></a></div>
            <div class="col-md-9" style=" height: 55px;">
                <ul class="link-nav pull-right" >
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
                    <li>record</li>
                    <li>codex</li>
                    <li class="active">pan&zoom</li>
                    <li>juxtapose&compare</li>
                </ol>
            </div>
        </div>
        <?php } ?>

    </div>
    
      <div class="container">
          <div class="row-fluid">
            <div class="span4" style=' height:100%; margin:0px;'>
                <!-- THIS IS THE BOOKSHELF :: COPY THIS OVER TO OTHER PAGES  & ADD THE COLLAPSE FUNCTION -->
                <div id="bookshelfOverrided" >
        
                </div> 
            </div>  
            <div class="span6" style='margin:0px; height: 95%'>                 
                <div id="content">
                  <div id="pageContent">				
                      <div id="imgContainer">
                          <img id="imageFullScreen" data-folioid='<?php echo $_GET['folio_id'];?>' src = '<?php echo "image.php?img_path=".$_GET['imagepath'] ;?>' alt=''/>
                      </div>
                      <div align='middle'>
                        <span>
                            <img id='zoomInButton' src='img/zoom-in-outline.png' alt='' />
                            <img id='zoomOutButton' src='img/zoom-out-outline.png' alt='' />
                            <img id='leftPositionMap' src='img/arrow-left-thick.png' alt='' />
                            <img id='topPositionMap' src='img/arrow-up-thick.png' alt='' />
                            <img id='bottomPositionMap' src='img/arrow-down-thick.png' alt='' />
                            <img id='rightPositionMap' src='img/arrow-right-thick.png' alt='' />
                            
                        </span>
                      </div>
                      <div align='middle'>
                        <span>
                            <p align="center">
                                <a onclick="view_record(document.getElementsByName('recordForm'));"><span id="shelf" class="shelfmark_span"><?php echo $folio_obj->abbreviated_shelf; ?></span></a>
                            </p>
                            
                        </span>
                      </div>
                  </div>
                </div>            
            </div>
            <div class="span2" style='margin-left:0px; '>                
                <div id="gallery-slider">
                    <div class="thumbelina-but vert top">Backward</div>
                    <ul>
                         <?php foreach ($folio_objs as $fob_obj) {                                
//                                page=0,side=1,path=2,id=3
                            $imagePath = $fob_obj->res_ident;
                         ?>
                        <li><img class='galleryItem <?php echo ($_GET['folio_id'] == $fob_obj->folio_id)?' imageSelectBorder':'' ; ?>' data-path='<?php echo $imagePath ; ?>' data-folioid='<?php echo $fob_obj->folio_id; ?>' data-abbrshelf='<?php echo $fob_obj->abbreviated_shelf; ?>' src = '<?php echo "image.php?img_path=".$imagePath ;?>' alt=''/></li>

                        <?php } ?>
                    </ul>
                    <div class="thumbelina-but vert bottom">Forward</div>
                </div>
            </div>

          </div>
    </div>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>        
    <script src="js/thumbelina.js"></script>
    <script src='js/jquery.contextMenu.js'></script>
    <script src='js/e-smart-zoom-jquery.min.js'></script>
    <script src='js/panzoom.js'></script>
    <script src='js/panzoomBookshelf.js'></script>
        
  </body>
</html>

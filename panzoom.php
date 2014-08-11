<?php 
    include_once './includes/functions.php';
    session_start();   
    $folio_objs = getFoliosByManuscriptId($_GET['id']);

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
    
    
        <link rel='stylesheet' type="text/css" href='css/bootstrap-responsive.css'>        
        <link rel="stylesheet" type="text/css" href="css/thumbelina.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.contextMenu.css">
        <link rel="stylesheet" type="text/css" href="css/panzoom.css">
        <style> 
            #slider {
                position:relative;
                margin-top:40px;
                width:98%;
                height: 50%;
                border-left:1px solid #aaa;
                border-right:1px solid #aaa;
                margin-bottom:10px;
            }            
        </style>
        
  </head>
  <body data-spy="scroll" data-target="#master" data-offset="100">

    <div class="container">
      	<div class="row">
            <div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" alt=''/></a></div>
          	<div class="col-md-9" style=" height: 55px;">
                    <ul class="link-nav pull-right">
              		<li><a href="search.php">search</a></li>
                        <li><a href="about.php">about</a></li>
                        <li><a href="browse.php">browse</a></li>
                        <li class="active"><a href="resources.php">resources</a></li>
                        <li><a href="#">citation shelfmarks</a></li>
                        <li><a href="#"><?php echo $_SESSION['name'];?></a></li>
                    </ul>
          	</div>
      	</div>
    </div>
    
      <div class="container">
          <div class="row-fluid">
              <div class="span2" >                
                <div id="slider" style="height:50%">
                    <div class="thumbelina-but vert top">&#708;</div>
                    <ul id="gallery-slider">
                         <?php foreach ($folio_objs as $fob_obj) {                                
//                                page=0,side=1,path=2,id=3
                            $imagePath = $fob_obj->res_ident;
                        ?>
                            <li><img id='galleryItem' src = 'data:/image/jpg;base64,<?php echo base64_encode(file_get_contents($imagePath));?>' alt=''/></li>
                        <?php } ?>
                    </ul>
                    <div class="thumbelina-but vert bottom">&#709;</div>
                </div>
            </div>
            <div class="span9" >                
                <div id="content">
                  <div id="pageContent">				
                      <div id="imgContainer">
                              <img id="imageFullScreen" src='./content/manuscriptlink/2007-2011/Jpegs final pfp/Bob Jones MS 2/images/bm2_recto.jpg' alt=''/>
                      </div>
                      <div>
                        <span>
                            <button id='zoomInButton'> + </button>
                            <button id='zoomOutButton'> - </button>
                            <button id='topPositionMap'> U </button>
                            <button id='leftPositionMap'> L </button>
                            <button id='rightPositionMap'> R </button>
                            <button id='bottomPositionMap'> D </button>
                        </span>
                      </div>
                  </div>
                </div>            
            </div>
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

   
    </script>    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
    <script src="js/bootstrap.min.js"></script>        
    <script src="js/thumbelina.js"></script>
    <script src='js/jquery.contextMenu.js'></script>
    <script src='js/e-smart-zoom-jquery.min.js'></script>
    <script type="text/javascript">        
            
            $(document).ready(function(){    
                
                $('#imageFullScreen').smartZoom({'containerClass':'zoomableContainer'});				
                $('#topPositionMap,#leftPositionMap,#rightPositionMap,#bottomPositionMap').bind("click", moveButtonClickHandler);
                $('#zoomInButton,#zoomOutButton').bind("click", zoomButtonClickHandler);

                function zoomButtonClickHandler(e){
                var scaleToAdd = 0.8;
                    if(e.target.id === 'zoomOutButton')
                            scaleToAdd = -scaleToAdd;
                    $('#imageFullScreen').smartZoom('zoom', scaleToAdd);
                }

                function moveButtonClickHandler(e){
                    var pixelsToMoveOnX = 0;
                    var pixelsToMoveOnY = 0;

                    switch(e.target.id){
                            case "leftPositionMap":
                                    pixelsToMoveOnX = 50;	
                            break;
                            case "rightPositionMap":
                                    pixelsToMoveOnX = -50;
                            break;
                            case "topPositionMap":
                                    pixelsToMoveOnY = 50;	
                            break;
                            case "bottomPositionMap":
                                    pixelsToMoveOnY = -50;	
                            break;
                    }
                    $('#imageFullScreen').smartZoom('pan', pixelsToMoveOnX, pixelsToMoveOnY);
                };
                
                $('#galleryItem').click(function() {
                    $("#imageFullScreen").attr('src', $(this).attr('src'));
                });
                
            });
            
        </script> 
        
                 
        
  </body>
</html>

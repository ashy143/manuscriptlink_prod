<?php 
    include_once './includes/functions.php';
    session_start();   
    $folio_objs = getFoliosByManuscriptId($_GET['mscript_id']);

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
        <!-- <link rel="stylesheet" type="text/css" href="css/jquery.contextMenu.css"> -->
        <link rel="stylesheet" type="text/css" href="css/panzoom.css">
              
  </head>
  <body data-spy="scroll" data-target="#master" data-offset="100">

    <div class="container">
      	<div class="row">
            <div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" alt=''/></a></div>
            <div class="col-md-9" style=" height: 55px;">
                <ul class="link-nav pull-right" >
                    <li><a href="search.php">search</a></li>
                    <li><a href="about.php">about</a></li>
                    <li><a href="browse.php">browse</a></li>
                    <li class="active"><a href="resources.php">resources</a></li>
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
                    <li><a href="#">record</a></li>
                    <li><a href="#">codex</a></li>
                    <li class="active"><a href="#">pan&zoom</a></li>
                    <li><a href="#">juxtapose&compare</a></li>
                    <li ><a href="myarchive.php">my archive</a></li>
                    <li><a href="utils/process_logout.php">logout</a></li>
                </ol>
            </div>
        </div>
        <?php } ?>

    </div>
    
      <div class="container">
          <div class="row-fluid">
              <div class="span2" >                
                <div id="gallery-slider">
                    <div class="thumbelina-but vert top">&#708;</div>
                    <ul>
                         <?php foreach ($folio_objs as $fob_obj) {                                
//                                page=0,side=1,path=2,id=3
                            $imagePath = $fob_obj->res_ident;
                         ?>
                        <li><img class='galleryItem <?php echo ($_GET['folio_id'] == $fob_obj->folio_id)?' imageSelectBorder':'' ; ?>' data-path='<?php echo $imagePath ; ?>' data-folioid='<?php echo $fob_obj->folio_id; ?>' src = '<?php echo "image.php?img_path=".$imagePath ;?>' alt=''/></li>
                        <?php } ?>
                    </ul>
                    <div class="thumbelina-but vert bottom">&#709;</div>
                </div>
            </div>
            <div class="span9" >                
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
                  </div>
                </div>            
            </div>
          </div>
    </div>
        
                
    <!-- THIS IS THE BOOKSHELF :: COPY THIS OVER TO OTHER PAGES  & ADD THE COLLAPSE FUNCTION -->
    <div id="bookshelf">
        
    </div>    
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script language="javascript">
        

   
    </script>    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
    <script src="js/bootstrap.min.js"></script>        
    <script src="js/thumbelina.js"></script>
    <script src='js/jquery.contextMenu.js'></script>
    <script src='js/e-smart-zoom-jquery.min.js'></script>
    <script type="text/javascript">        
            
            $(document).ready(function(){

                $('#bookshelf').delegate('.fa', 'click', function () {
                    $('#bookBody').slideToggle('2000',"swing", function () {
                    //Animation complete
                    });
                    $(".fa").toggleClass("fa-caret-square-o-down fa-caret-square-o-up");
                });
              
                $('#bookshelf').bind('click', '.delButton', function(event) {
                    event.stopPropagation();
                    var delBtn = $(event.target);
                    var folioToBeDeleted = delBtn.parent().attr('data-folioid');
                    $.ajax({
                        url: 'deleteBookshelfFolio.php',
                        type: 'GET',
                        data: {folio_id : folioToBeDeleted },
                        dataType: 'json',
                        contentType: 'application/json',    
                        success: function(msg){
                            //$('#bookshelf').html(data);
                            if(msg.statusNum == 201){
                                alert(msg.statusMsg);
                            }else{
                                delBtn.parents('.myBook').fadeOut();
                            }
                        }
                    });
                    
                });
                
                $('#gallery-slider').Thumbelina({
                    orientation:'vertical',         // Use vertical mode (default horizontal).
                    $bwdBut:$('#gallery-slider .top'),     // Selector to top button.
                    $fwdBut:$('#gallery-slider .bottom')   // Selector to bottom button.
                });
                
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
                
                $('.galleryItem').click(function() {
                    $(this).toggleClass('imageSelectBorder');
                    $("#imageFullScreen").attr('src', 'image.php?img_path=' + $(this).data('path'));
                    $("#imageFullScreen").attr('data-folioid', $(this).data('folioid'));
                    $('#imageFullScreen').smartZoom('destroy');
                    $('#imageFullScreen').smartZoom({'containerClass':'zoomableContainer'});				
                    $('#topPositionMap,#leftPositionMap,#rightPositionMap,#bottomPositionMap').bind("click", moveButtonClickHandler);
                        $('#zoomInButton,#zoomOutButton').bind("click", zoomButtonClickHandler);
                });
                
                $('#bookshelf').delegate('#juxtaBtn', 'click', function(){
                    var folioIdToBeAdded = $('#imageFullScreen').data('folioid');
                    $.ajax({    
                        url: 'saveArchives.php', //current page
                        type: 'GET',
                        data: {folio_id: folioIdToBeAdded, is_juxta: 'true' },
                        dataType: "json",
                        contentType: "application/json",                    
                        success: function (msg) {
                            //Add this folio to bookshelf                                 
                            alert(msg.statusMsg);
                            $.get('bookshelf.php', function(data){
                                $('#bookshelf').html(data);
                            });
                        }
                    });
                });
                
                $('#bookshelf').delegate('#archiveBtn', 'click', function(){
                    var folioIdToBeAdded = $('#imageFullScreen').data('folioid');
                    $.ajax({    
                        url: 'saveArchives.php', //current page
                        type: 'GET',
                        data: {folio_id: folioIdToBeAdded, is_juxta: 'false' }, //false says its for juxtaposing
                        dataType: "json",
                        contentType: "application/json",                    
                        success: function (msg) {
                            alert(msg.statusMsg);
                        }
                    });
                });

                $.ajax({
                    url: 'bookshelf.php',
                    type: 'GET',
                    dataType: 'html',
                    success: function(data){
                        $('#bookshelf').html(data);
                    }

                });
            });
            
        </script>
        
  </body>
</html>

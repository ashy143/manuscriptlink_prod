<?php 
    include_once './includes/functions.php';
    session_start();
    $juxt_folio_objs = ($_GET['folio_ids'] != '') ? getJuxtaImagesForFolios($_GET['folio_ids']) : getJuxtaImagesForLoggedInUser();
    $colSizeClass = 'span12';
    if($juxt_folio_objs > 0){
      $colSizeClass = 'span' . 12/count($juxt_folio_objs);
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>manuscriptlink</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-responsive.css">
    <link href="css/mslink.css" rel="stylesheet">
    <link href="css/menubarStyles.css" rel="stylesheet">
    <link href="css/panzoom.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      .dragPoint {
        background:transparent;
        color: #ffffff;
        text-align: center;
        padding: 1em;
      }
      .dragPoint > span{
        cursor: pointer; cursor: hand;
      }
      .closeText {
        background:transparent;
        color: #ffffff;
      }
    
      .zoomer_wrapper {  height:80%; overflow: hidden; width: 100%; }

      /*.zoomer.dark_zoomer { background: #333 url(http://formstone.it/files/demo/zoomer-bg-dark.png) repeat center; }*/
      .zoomer.dark_zoomer img { box-shadow: 0 0 5px rgba(0, 0, 0, 0.5); }

      .drag{
        position: relative;
        height: 90%;
      }

      /* zindex index so large here because we always want bookshelf at top while dragging images so that bookshelf view is not blocked */
      #bookshelf{
        z-index: 100000;
      }

    </style>

    
  </head>
  <body data-spy="scroll" data-target="#master" data-offset="100">

    <!-- copy this block where ever you require citation shelfmark -->
    <div class="modal fade" id="shelfmarks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        
    </div>

    <div class="container">
      	<div class="row">
            <div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" />
            </div>
          	<div class="col-md-9" style=" height: 55px;">
            		<ul class="link-nav pull-right">
              		<li class="active"><a href="search.php">search</a></li>
  		            <li><a href="about.php">about</a></li>
  		            <li><a href="browse.php">browse</a></li>
  		            <li><a href="resources.php">resources</a></li>
  		            <li><a href="#" data-toggle="modal" data-target="#shelfmarks">citation shelfmarks</a></li>
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
                    <li ><a href="myarchive.php">my archive</a></li>
                    <li><a href="utils/process_logout.php">logout</a></li>
                </ol>
                <ol class="breadcrumb pull-right">
                    <li>results</a></li>
                    <li>record</li>
                    <li>codex</li>
                    <li>pan&zoom</li>
                    <li class="active">juxtapose&compare</li>
                </ol>
            </div>
        </div>
        <?php } ?>

    </div>
    <div class="back">
      <div class="container" style="width: 100%; height:100vh;">
        <div id='imgContainer' class='row-fluid' style='height:100%;'>
          
            <?php $count=1; foreach($juxt_folio_objs as $fol_obj){ ?>
            
            <div  class='drag <?php echo $colSizeClass; ?>' data-folioid = <?php echo $fol_obj->folio_id; ?> > 
              <div class="dragPoint" > <span>Click and hold here to drag&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' class='closeText' >x</a></span></div> 
              <div class="zoomer_wrapper zoomer_basic" style='align:center; max-width:100%; max-height:90%;' >
                <img  src="image.php?img_path=<?php echo $fol_obj->res_ident ; ?>" alt="" style="max-width: 100%; max-height: 100%; "/>
              </div>
              <div class="dragPoint" ><span>Click and hold here to drag&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' class='closeText' >x</a></span></div>
            </div>  
           

            <?php $count++; } ?>
        </div>
      </div>

    </div>
    <!-- THIS IS THE BOOKSHELF :: COPY THIS OVER TO OTHER PAGES  & ADD THE COLLAPSE FUNCTION -->

    <div id="bookshelf">
        
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <link href="css/jquery.fs.zoomer.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/jquery.fs.zoomer.js"></script>
    <script src="js/juxtaposeBookshelf.js"></script>
    <script language="javascript">

      $(document).ready(function(){
        $(".zoomer_basic").zoomer();

        $('.drag').draggable({
          stack: '.drag'
        });

        $(window).on("resize", function(e) {
          $(".zoomer_wrapper").zoomer("resize");
        });

        $(".closeText").bind('click',function(){
          $('.zoomer_basic').zoomer('destroy');
          $(this).parent().parent().parent().remove();
          var children = $('#imgContainer').children().length;
          var colSizeClass = 'span' + 12/children;
          var folIdsToLoadAfterDeleting = [];
          $('#imgContainer').children().each(function(){
              $(this).removeAttr('class').addClass(colSizeClass).addClass('drag '+colSizeClass);
              //save the new list of folios to be loaded
              folIdsToLoadAfterDeleting.push($(this).data('folioid'));
          });
           $(".zoomer_basic").zoomer();
           console.log(folIdsToLoadAfterDeleting.toString());
           //load the new list of folios by calling the same page again. We are doing this because when we drag and then
           //delete the image the newly loaded image doesn't relocate properly so we load the page with new list
           window.location.href = 'juxtapose.php?folio_ids='+folIdsToLoadAfterDeleting.toString();

         });

          $.ajax({
              url: 'bookshelf.php',
              type: 'GET',
              dataType: 'html',
              success: function(data){
                  $('#bookshelf').html(data);
              }
          });

          $("#shelfmarks").load('citationShelfmark.php');
            
      });
    </script>
  </body>
</html>

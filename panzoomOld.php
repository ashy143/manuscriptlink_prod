<?php 
    require_once './includes/functions.php';
       
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
    
    
        <link rel="stylesheet" type="text/css" href="css/cloudzoom.css">
        <link rel='stylesheet' type="text/css" href='css/bootstrap-responsive.css'>        
        <link rel="stylesheet" type="text/css" href="css/thumbelina.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.contextMenu.css">
        
        <style>
            #slider {
                position:relative;
                margin-top:40px;
                width:93px;
                height:256px;
                border-left:1px solid #aaa;
                border-right:1px solid #aaa;
                margin-bottom:40px;
            }
        </style>
        
  </head>
  <body data-spy="scroll" data-target="#master" data-offset="100">

    <div class="container">
      	<div class="row">
            <div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" /></div>
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
    <div class="back">
        <div class="row-fluid">
                <!-- Image gallery -->
            <div class="span2" style="height: 800px;">                
                <div id="slider" style="height:95%">
                    <div class="thumbelina-but vert top">&#708;</div>
                    <ul id="gallery-slider">
                         <?php foreach ($folio_objs as $fob_obj) {                                
//                                page=0,side=1,path=2,id=3
                            $imagePath = $fob_obj->res_ident;
                        ?>
                            <li>
                                <a  style="width:98% " href="#" class="cloudzoom-gallery"
                                data-imageId="<?php echo $folio_obj->folio_id; ?>"  
                                data-imageDesc="To Be Extracted"
                                data-cloudzoom =
                                     "useZoom: '#zoom1', 
                                     image: 'data:/image/jpg;base64,<?php echo base64_encode(file_get_contents($imagePath));?>', 
                                     zoomImage: 'data:/image/jpg;base64,<?php echo base64_encode(file_get_contents($imagePath));?>' ">
                                <img style="width: 98%;" src = 'data:/image/jpg;base64,<?php echo base64_encode(file_get_contents($imagePath));?>' />
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="thumbelina-but vert bottom">&#709;</div>
                </div>
            </div>
            <!--Zoomed Image-->
            <div class="span4">
                <div id="zoom-win" style=" width: 400px; height: 400px;"></div>

            </div>
            <!--Large Image -->
            <div class="span6">
                    <img id = "zoom1" style='width: 95%; height: 95%' class = "cloudzoom"
                         data-cloudzoom = "zoomImage: 'data:/image/jpg;base64,<?php echo base64_encode(file_get_contents($_GET['imagepath']));?>', zoomPosition:'#zoom-win'" src = 'data:/image/jpg;base64,<?php echo base64_encode(file_get_contents($_GET['imagepath']));?>' />
            </div>
        </div>
    </div>

    <!-- THIS IS THE BOOKSHELF :: COPY THIS OVER TO OTHER PAGES  & ADD THE COLLAPSE FUNCTION -->

    <div id="bookshelf">
        <div id="bookHead">
            <h4>Bookshelf</h4>
            <i class="fa fa-caret-square-o-down"></i>
        </div>
        <div id="bookBody">
              <div class="book" id="book1">
                <div class="myBook">
                  <h4>1. USC Early MS 17</h4>
                  <div class="delButton">Delete</div>
                  <div class="codexButton">Codex</div>
                </div>
              </div>
              <div class="book" id="book2">
                <div class="myBook">
                  <h4>2. USC Early MS 22a</h4>
                  <div class="delButton">Delete</div>
                  <div class="codexButton">Codex</div>
                </div>
              </div>
              <div class="book" id="book3">
                <div class="myBook">
                  <h4>3. USC Early MS 17</h4>
                  <div class="delButton">Delete</div>
                  <div class="codexButton">Codex</div>
                </div>  
              </div>
              <div class="book" id="book4">
                <div class="myBook">
                  <h4>4. USC Early MS 17</h4>
                  <div class="delButton">Delete</div>
                  <div class="codexButton">Codex</div>
                </div>
              </div>
              <div class="bookBtn">select</div>
              <div class="bookBtn">Add to archive</div>
              <div class="bookBtn"><a href="juxtapose.php">juxtapose &amp; Compare</a></div>
              <div class="bookBtn"><a href="myarchive.php">view archive</a></div>
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
    <script src="js/cloudzoom.js"></script>
    <script src="js/thumbelina.js"></script>
    <script src='js/jquery.contextMenu.js'></script>
    <script type="text/javascript">        
            
            CloudZoom.quickStart();
                
            $(document).ready(function(){    
                
               $.contextMenu({
                    selector: '.cloudzoom', 
                    callback: function(key, options) {                       
                        var imgId = $(this).attr('data-imageId');
                        var desc = $(this).attr('data-attr');
                        
                        //now insert this page id into database and link it with logged in user
                        if(key==='archive'){
                            alert("archive called");
                            $.ajax({    
                                url: 'save_archives.php', //current page
                                type: 'GET',
                                data: {page_id: imgId, is_juxta: 'false' },
                                dataType: "json",
                                contentType: "application/json",                    
                                success: function (msg) {                                 
                                    alert(msg.statusMsg);
                                }
                            });
                        }else if(key==='juxtapose'){
                            alert("juxta called");
                            $.ajax({    
                                url: 'save_archives.php', //current page
                                type: 'GET',
                                data: {page_id: imgId, is_juxta: 'true' }, //false says its for juxtaposing
                                dataType: "json",
                                contentType: "application/json",                    
                                success: function (msg) {                                 
                                    alert(msg.statusMsg);
                                }
                            });
                        }
                    },
                    items: {
                        "archive": {name: "Add to Archives"},
                        "juxtapose": {name: "Add to Juxtapose"}                        
                    }
                });

               
                 $('#slider').Thumbelina({
                        orientation:'vertical',         // Use vertical mode (default horizontal).
                        $bwdBut:$('#slider .top'),     // Selector to top button.
                        $fwdBut:$('#slider .bottom')   // Selector to bottom button.
                });
                
              
            });
            
        </script> 
        
                 
        
  </body>
</html>

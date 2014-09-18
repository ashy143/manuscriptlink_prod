
<?php
    include_once './includes/functions.php';
    session_start();  
    $archived_folios = getArchivedImagesForLoggedInUser();
  
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
              <a href="#"><button id='delArchConfirm' type="button" class="btn btn-danger">Clear Archive</button></a>
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
  		            <li><a href="#"><?php echo $_SESSION['name'];?></a></li>
            		</ul>
          	</div>
      	</div>
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb pull-right">
                    <li class="active"><a href="myarchive.php">my archive</a></li>
                    <li><a href="utils/process_logout.php">logout</a></li>
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
                <a href="#"><div id='juxtaposeBtn' class="arc-button">Juxtapose &amp; Compare</div></a>
                <a href="searchresults.php"><div class="arc-search">Back to Search</div></a>
                <div class="arc-clear"><a href="#" data-toggle="modal" data-target="#clearArchive">Clear Archive</a></div>
            </div>

            <?php if(count($archived_folios) > 0) { ?>
              <div id="archive" class="col-md-8">

                    <?php $count = 1; foreach($archived_folios as $fol_obj){ ?>
                      <div class="holding" data-folioid = "<?php echo $fol_obj->folio_id; ?>" >
                        <h4>
                          <?php
                            echo $fol_obj->folio_location->municipality.', '.$fol_obj->folio_location->state.', '.$fol_obj->abbreviated_shelf.'('.$fol_obj->folio_num . $fol_obj->folio_side.')';
                          ?>
                        </h4>
                        <div class="delButton">Delete</div>
                        <a href="codex.php?id=<?php echo $fol_obj->mscript_id; ?>"><div class="codexButton">Codex</div></a>
                        <a href="#collapse<?php echo $count; ?>" data-toggle="collapse" data-parent="#archive"><div class="imgButton">Images</div></a>
                        <div id="collapse<?php echo $count; ?>" class="panel-collapse collapse">
                          <div class="rThumb"><a href="panzoom.php?imagepath=<?php echo $fol_obj->res_ident; ?>&mscript_id=<?php echo $fol_obj->mscript_id ;?>"><img style =" height:200px; width: 144px; " src = '<?php echo "image.php?img_path=".$fol_obj->res_ident ;?>' alt = '' /><br /><?php echo $fol_obj->folio_num . $fol_obj->folio_side ; ?></a></div>
                        </div>
                      </div>
                    <?php $count++; } ?>
                   
              </div>
            <?php }else { ?>
              <div class="col-md-8 pull-right">
                <div class="no-entries">
                    <p>You don't currently have any items selected for your archive. <a href="search.php">Click Here</a> to search through our database and begin building your collection</p>
                </div>
              </div>
            <?php } ?>
        </div>
    </div>

    <!-- THIS IS THE BOOKSHELF :: COPY THIS OVER TO OTHER PAGES  & ADD THE COLLAPSE FUNCTION -->

<!--     <div id="bookshelf">
        
    </div>
 -->

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

      // $(document).ready(function(){
      //     $.ajax({
      //         url: 'bookshelf.php',
      //         type: 'GET',
      //         dataType: 'html',
      //         success: function(data){
      //             $('#bookshelf').html(data);
      //         }
      //     });
      // });

      $(".delButton").click(function(event) {
        event.preventDefault();
        $(this).parents('.holding').fadeOut();
      });

      $('#delArchConfirm').click(function(){
        $.ajax({
            url: 'clearArchive.php',
            type: 'POST',
            success: function(msg){
              var msgArray = JSON.parse(msg);
              if(msgArray.statusNum == 200){
                window.location.href = 'myarchive.php';
              }else{
                alert(msgArray.statusMsg);
              }
            }
        });
          
      });

      $('#juxtaposeBtn').click(function(){
        var folioIdsSelected = [];
        $("#archive .holding").each(function(){
            if($(this).hasClass('clickedArc')){
              folioIdsSelected.push($(this).data('folioid'));
            }
        });

        alert(folioIdsSelected);

        $.ajax({    
            url: 'saveArchivesMultiple.php', //current page
            type: 'GET',
            data: {folio_id: folioIdsSelected.toString(), is_juxta: 'true' },
                              
            success: function (msg) {
                //Add this folio to books
                console.log(msg);
                var decodedMsg = JSON && JSON.parse(msg) || $.parseJSON(msg);
                if(decodedMsg.statusNum == 200){
                  window.location.href = 'juxtapose.php';
                }else{
                  alert('Unable to display juxta and compare. Please try again.');
                }
            }
        });
          
      });

    </script>   
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

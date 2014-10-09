<?php 
    require_once './includes/functions.php';
   session_start();

    if(login_check() == false){
        header("location: ./index.php");
    }

   $mlinknum = getMlinkNumberOfManuscript($_GET['id']);
   $folioIdToBeOpened = $_GET['folio_id'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>manuscriptlink</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-responsive.css">
    <link href="css/mslink.css" rel="stylesheet">
    <link href="css/menubarStyles.css" rel="stylesheet">
    <link href="css/codex.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery.qtip.css" />
    
    <script type="text/javascript">
        function view_record(form) {
            $(form).submit(); 
        }
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body data-spy="scroll" data-target="#master" data-offset="100">

    <!-- copy this block where ever you require citation shelfmark -->
    <div class="modal fade" id="shelfmarks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        
    </div>

    <div class="container">
      	<div class="row">
            <div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" alt=""/></a>
            </div>
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
                    <li>record</li>
                    <li class="active">codex</li>
                    <li>pan&zoom</li>
                    <li>juxtapose&compare</li>
                </ol>
            </div>
        </div>
        <?php } ?>

    </div>

    

      <div class="tooltiptext" id='lefttooltip' ></div>
      <div class="tooltiptext" id='righttooltip' ></div>
      <!-- Hidden form to navigate to record page -->
      <form name='recordForm' method="GET" action='record.php'>
        <input type="hidden" name='id' value ='<?php echo $_GET['id']; ?>'/>
        <input type="hidden" name='mlinknum' value ='<?php echo $mlinknum ; ?>'/>
      </form>
      
    <!--<div class="back">-->
        <div class="container" style="width: 100%; height:88vh;">
            <div class="row-fluid">
                <div class="span1" style="height: 80vh; position: relative;  top: 40vh;">
                    <img id="left" src="./images/arrow-left-double.png" style="width: 30px; height: 30px;" alt=""/>
                    <!-- <img id="prev" src="./images/prev.png" style="width: 30px; height: 30px;" alt="" /> -->
                </div>
                <div class="span5">
                    <img id="lpage" class="page" title="test"  src=""/>
                    <div class="left_shelfmark_div" >
                        <p align="center">
                            <a onclick="view_record(document.getElementsByName('recordForm'));"><span id="leftShelf" class="shelfmark_span"></span></a>
                        </p>
                    </div>
                </div>
                <div  class="span5">                    
                    <img id="rpage"  class="page" title="test" src=""/>
                    <div class="right_shelfmark_div" >
                        <p align="center">
                            <a onclick="view_record(document.getElementsByName('recordForm'));"><span id="rightShelf" class="shelfmark_span" ></span></a>   
                        </p>
                    </div>               
                </div>
                <div class="span1" style="height: 80vh; position: relative;  top: 40vh; " >
                    <!-- <img id="next" src="./images/next.png" style="width: 30px; height: 30px;" alt=''/> -->
                    <img id="right" src="./images/arrow-right-double.png" style="width: 30px; height: 30px;" alt=''/>                    
                </div>
            </div>
        </div>
  
     

    <!-- THIS IS THE BOOKSHELF :: COPY THIS OVER TO OTHER PAGES  & ADD THE COLLAPSE FUNCTION -->

    <div id="bookshelf">
        
    </div>
    
        
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>    
    <script type="text/javascript" src="js/models/Page.js"></script>
    <script type="text/javascript" src="js/jquery.qtip.js"></script>
    <script type="text/javascript" src="js/codexBookshelf.js"></script>
    <script>         

            /*
                Function to get the metadata of the folio which is displayed as tooltip when hovered on image
            */
            function getMetadataDiv(page_obj){
                return "<span> <strong>"+ page_obj.author + ', ' + page_obj.text + ', ' + page_obj.date+" <BR>"+
                        page_obj.writing_sup + ', ' + page_obj.width + ' x ' + page_obj.height + ', ' + page_obj.no_of_col + ' col. ' + page_obj.no_of_lines + ' lines '+ "<BR>" +
                            page_obj.contents +
                        "</strong><span>";
            };

            /*
                Function to set the width of div so that it makes look shelfmark aligned center
            */
            function setWidthOfShelfmark(){
                $('.left_shelfmark_div').css('width', $('#lpage').width());
                $('.right_shelfmark_div').css('width', $('#rpage').width());
                    
            }

            /*
                Function to calculate number of missing pages to the left and right side of current page view
            */

            function getRemainingBlackPagesForPrevNext(ptr, pages){

                /* Caluclation for prev and next page navigation */
                var currentPageNumForBack = 0;
                var currentPageNumForForw = 0;

                if(pages[ptr].pageNum !== 'x'){
                    currentPageNumForBack = pages[ptr].pageNum ;
                }else if(pages[ptr+1].pageNum !== 'x'){
                    currentPageNumForBack = pages[ptr+1].pageNum ;
                }

                if(pages[ptr+1].pageNum !== 'x'){
                    currentPageNumForForw = pages[ptr+1].pageNum ;
                }else if(pages[ptr].pageNum !== 'x'){
                    currentPageNumForForw = pages[ptr].pageNum ;
                }

                /* calculate black pages backward and forward to current page*/
                var index = ptr; 
                while(pages[index].pageNum === 'x' && index > 0){
                    index-- ;
                }
                remaining_blank_back = parseInt(currentPageNumForBack) - parseInt((pages[index].pageNum === 'x')? 0 : parseInt(pages[index].pageNum));
                var index = ptr+1;  //check from right page 
                while(pages[index].pageNum === 'x' && index < pages.length - 1){    //-1 because for last page we don't want to increment
                    index++ ;
                }
                if(pages[index].pageNum === 'x'){
                    remaining_blank_forward = 0 ;
                }else{
                    remaining_blank_forward = parseInt(pages[index].pageNum) - parseInt(currentPageNumForForw);
                }
                /* Caluclation for prev and next page navigation ends here */

                var values = [];
                values.push(remaining_blank_back);
                values.push(remaining_blank_forward);

                return values;
            };
            
            $(document).ready(function(){

                
                //This particular folio will be opened and highlighted
                var folioIdToBeOpened = parseInt(<?php echo $folioIdToBeOpened; ?>);
                var remaining_blank_back = 0;
                var remaining_blank_forward = 0;

                $.ajax({
                    url: 'bookshelf.php',
                    type: 'GET',
                    dataType: 'html',
                    success: function(data){
                        $('#bookshelf').html(data);
                    }
                });

                $('#lpage').qtip({
                    content: {
                        text: $('#lefttooltip')
                    },
                    position: {
                        target: 'mouse', // Track the mouse as the positioning target
                        adjust: { x: 5, y: 5 } // Offset it slightly from under the mouse
                    }
                    
                }); 
                
                $('#rpage').qtip({
                    content: {
                        text: $('#righttooltip')
                    },
                    position: {
                        target: 'mouse', // Track the mouse as the positioning target
                        adjust: { x: 5, y: 5 } // Offset it slightly from under the mouse
                    }
                }); 
                
                var ptr = 0;
                var pages = [];
                var archivePages = [];
                $.ajax({
                    
                    url: 'getpages.php', //current page
                    type: 'GET',
                    data: {mscript_id: <?php echo $_GET['id']?> },
                    dataType: "json",
                    contentType: "application/json",                    
                    success: function (d) {
                        $.each(d, function(index, element){
                            var page = new Page();
                            page.pageNum = element.num;
                            page.image = element.path;
                            page.pageSide = element.side;
                            page.pageId = element.id;
                            page.abbrShelf = element.abbrshelf;
                            page.author = element.author;
                            page.height = element.height;
                            page.width = element.width;
                            page.no_of_col = element.no_of_cols;
                            page.no_of_lines = element.no_of_lines;
                            page.contents=element.contents;
                            page.text = element.text;
                            page.date = element.date;
                            page.writing_sup = element.writing_sup;
                            
                            pages.push(page) ;
                            
                        });
                        
                        /* Single page navigation logic */

                        //take the pointer to point to first available valid folio (usually ptr = 1, ptr = 0 is missing leaf)
                        remaining_blank_back = parseInt(pages[ptr + 1].pageNum) - 1 ;
                        ptr = 3 ;
                        while(pages[ptr].pageNum === 'x' ){
                            ptr++ ;
                        }
                        remaining_blank_forward = parseInt(pages[ptr + 1].pageNum) - parseInt(pages[1].pageNum);
                        
                        /* single page navigation logic end */

                        //reset the ptr to point to first folio
                        ptr = 0;
                        //Logic to open the selected folio directly of manuscript and highlight it
                        if(folioIdToBeOpened !== -1){
                            while(ptr < pages.length - 1 ){
                                if(parseInt(pages[ptr].pageId) === folioIdToBeOpened || parseInt(pages[ptr+1].pageId) === folioIdToBeOpened){
                                    if(parseInt(pages[ptr].pageId) === folioIdToBeOpened){
                                        $("#lpage").addClass('imageSelectBorder');
                                    }else if(parseInt(pages[ptr+1].pageId) === folioIdToBeOpened){
                                        $("#rpage").addClass('imageSelectBorder');
                                    }
                                    break;
                                }
                                ptr = ptr + 2;
                            }
                        }

                        //disable single back button if remaining blank pages behind are 0
                        if(remaining_blank_back > 0){
                            $('#prev').attr('disabled', true);
                        }

                        $("#lpage").attr('src', 'image.php?img_path='+pages[ptr].image); 
                        $("#lpage").data('obj',pages[ptr]);
                        $("#leftShelf").text(pages[ptr].getAbbrShelf());                        
                        if(pages[ptr].pageNum !== 'x'){
                            $('#lefttooltip').html(getMetadataDiv(pages[ptr]));                            
                        }else{
                           $('#lefttooltip').html('Void Page');
                        }
                        
                        
                        $("#rpage").attr('src', 'image.php?img_path='+pages[ptr+1].image);
                        $("#rpage").data('obj',pages[ptr+1]);
                        $("#rightShelf").text(pages[ptr+1].getAbbrShelf());
                        $('#rpage').qtip('content', getMetadataDiv(pages[ptr+1]));
                        if(pages[ptr+1].pageNum !== 'x'){
                            $('#righttooltip').html(getMetadataDiv(pages[ptr+1]));                         
                        }else{
                            $('#righttooltip').html('Void Page');
                        }
                        
                        if(ptr===0){
                            document.getElementById("left").disabled=true;
                        }
                        if(ptr+4 >= pages.length ){
                            document.getElementById("left").disabled=true;
                        }
                        
                    }
                });
                
                $("#left").click(function(){
                    $(".page").removeClass('imageSelectBorder');
                    ptr = ptr -2;

                    var values = getRemainingBlackPagesForPrevNext(ptr, pages);
                    remaining_blank_back = values[0];
                    remaining_blank_forward = values[1];
                    
                    $("#lpage").attr('src','image.php?img_path='+pages[ptr].getImage());
                    $("#lpage").data('obj',pages[ptr]);
                    $("#leftShelf").text(pages[ptr].getAbbrShelf());
                    if(pages[ptr].pageNum !== 'x'){
                            $('#lefttooltip').html(getMetadataDiv(pages[ptr]));                            
                    }else{
                       $('#lefttooltip').html('Void Page');
                    }
                    
                    $("#rpage").attr('src','image.php?img_path='+pages[ptr+1].getImage());
                    $("#rpage").data('obj',pages[ptr+1]);
                    $("#rightShelf").text(pages[ptr+1].getAbbrShelf());
                    if(pages[ptr+1].pageNum !== 'x'){
                        $('#righttooltip').html(getMetadataDiv(pages[ptr+1]));                         
                    }else{
                        $('#righttooltip').html('Void Page');
                    }
                    if(ptr===0){
                        $("#left").prop('disabled', true);
                    }                    
                    $("#right").prop('disabled', false);
                    setWidthOfShelfmark();
                });
                
                $("#right").click(function(){
                    $(".page").removeClass('imageSelectBorder');
                    ptr = ptr + 2;
                    
                    var values = getRemainingBlackPagesForPrevNext(ptr, pages);
                    remaining_blank_back = values[0];
                    remaining_blank_forward = values[1];

                    $("#lpage").attr('src','image.php?img_path='+pages[ptr].getImage());
                    $("#lpage").data('obj',pages[ptr]);
                    $("#leftShelf").text( pages[ptr].getAbbrShelf());                    
                    if(pages[ptr].pageNum !== 'x'){
                        $('#lefttooltip').html(getMetadataDiv(pages[ptr]));                            
                    }else{
                       $('#lefttooltip').html('Void Page');
                    }
                    
                    $("#rpage").attr('src','image.php?img_path='+pages[ptr+1].getImage());
                    $("#rpage").data('obj',pages[ptr+1]);                    
                    $("#rightShelf").text( pages[ptr+1].getAbbrShelf());
                    if(pages[ptr+1].pageNum !== 'x'){
                        $('#righttooltip').html(getMetadataDiv(pages[ptr+1]));                         
                    }else{
                        $('#righttooltip').html('Void Page');
                    }
                    
                    if(ptr+2 >= pages.length ){
                        $("#right").prop('disabled', true);
                    }                    
                    $("#left").prop('disabled', false);
                    setWidthOfShelfmark();
                });

                $("#prev").click(function(){    //single nav
                    $(".page").removeClass('imageSelectBorder');

                    var values = getRemainingBlackPagesForPrevNext(ptr, pages);
                    remaining_blank_back--;
                    remaining_blank_forward++;
                    
                    $("#lpage").attr('src','image.php?img_path='+pages[ptr].getImage());
                    $("#lpage").data('obj',pages[ptr]);
                    $("#leftShelf").text(pages[ptr].getAbbrShelf());
                    if(pages[ptr].pageNum !== 'x'){
                        $('#lefttooltip').html(getMetadataDiv(pages[ptr]));                            
                    }else{
                       $('#lefttooltip').html('Void Page');
                    }
                    
                    $("#rpage").attr('src','image.php?img_path='+pages[ptr+1].getImage());
                    $("#rpage").data('obj',pages[ptr+1]);
                    $("#rightShelf").text(pages[ptr+1].getAbbrShelf());
                    if(pages[ptr+1].pageNum !== 'x'){
                        $('#righttooltip').html(getMetadataDiv(pages[ptr+1]));                         
                    }else{
                        $('#righttooltip').html('Void Page');
                    }
                    if(ptr===0){
                        $("#left").prop('disabled', true);
                    }                    
                    $("#right").prop('disabled', false);
                    setWidthOfShelfmark();
                });

                $("#next").click(function(){    //single nav
                    $(".page").removeClass('imageSelectBorder');

                    var values = getRemainingBlackPagesForPrevNext(ptr, pages);
                    remaining_blank_back = values[0];
                    remaining_blank_forward = values[1];
                    
                    $("#lpage").attr('src','image.php?img_path='+pages[ptr].getImage());
                    $("#lpage").data('obj',pages[ptr]);
                    $("#leftShelf").text(pages[ptr].getAbbrShelf());
                    if(pages[ptr].pageNum !== 'x'){
                            $('#lefttooltip').html(getMetadataDiv(pages[ptr]));                            
                    }else{
                       $('#lefttooltip').html('Void Page');
                    }
                    
                    $("#rpage").attr('src','image.php?img_path='+pages[ptr+1].getImage());
                    $("#rpage").data('obj',pages[ptr+1]);
                    $("#rightShelf").text(pages[ptr+1].getAbbrShelf());
                    if(pages[ptr+1].pageNum !== 'x'){
                        $('#righttooltip').html(getMetadataDiv(pages[ptr+1]));                         
                    }else{
                        $('#righttooltip').html('Void Page');
                    }
                    if(ptr===0){
                        $("#left").prop('disabled', true);
                    }                    
                    $("#right").prop('disabled', false);
                    setWidthOfShelfmark();
                });
                
                $(".page").dblclick(function(){
                    //Navigate to pan zoom page
                    var page = $(this).data("obj");                   
                    var url = "panzoom.php";
                    var form = $('<form action="' + url + '" method="GET">' +
                    '<input type="hidden" name="mscript_id" value="' + <?php echo $_GET['id']; ?> + '" />' +
                    '<input type="hidden" name="folio_id" value="' + page.pageId + '" />' +
                    '<input type="hidden" name="imagepath" value="' + page.image + '" />' +
                    '</form>');
                    $('body').append(form);
                    $(form).submit();
                });

                $(".page").click(function(){
                    
                    $(this).toggleClass('imageSelectBorder');
                    if($(this).hasClass('imageSelectBorder')){
                        if($(this).attr('id') == 'lpage'){
                            $('#rpage').removeClass('imageSelectBorder');
                        }else{
                            $('#lpage').removeClass('imageSelectBorder');
                        }                        
                    }
                });

                $("#shelfmarks").load('citationShelfmark.php');
            });
            
            
            
        </script>
  </body>
</html>

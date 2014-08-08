<?php 
    require_once './includes/functions.php';
   session_start();

    if(login_check() == false){
        header("location: ./index.php");
    }
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
    <link href='http://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery.qtip.css" />
    <style>
        .tooltiptext{
            display: none;
        }
    </style>
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

    <div class="container">
      	<div class="row">
            <div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" alt=""/></a></div>
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
      <div class="tooltiptext" id='lefttooltip' ></div>
      <div class="tooltiptext" id='righttooltip' ></div>
      
    <!--<div class="back">-->
        <div class="container" style="width: 100%; height:80vh;">
            <div class="row-fluid">
                <div class="span1" style="height: 80vh; position: relative;  top: 40vh;">
                    <img id="left" src="./images/arrow-left-double.png" style="width: 30px; height: 30px;" alt=""/>
                    <img id="prev" src="./images/prev.png" style="width: 30px; height: 30px;" alt="" />
                </div>
                <div class="span5">
                    <img id="lpage" class="page" title="test" style="max-width: 100%; max-height: 100%; float: right;" src=""/>
                    
                </div>
                <div  class="span5" >                    
                    <img id="rpage"  class="page" title="test" style="max-width: 100%; max-height: 100%; float:left; " src=""/>                    
                </div>
                <div class="span1" style="height: 80vh; position: relative;  top: 40vh; " >
                    <img id="next" src="./images/next.png" style="width: 30px; height: 30px;" alt=''/>
                    <img id="right" src="./images/arrow-right-double.png" style="width: 30px; height: 30px;" alt=''/>                    
                </div>
            </div>
           <div class='row-fluid'>
               <form name='recordForm' method="GET" action='record.php'>
                    <input type="hidden" name='id' value ='<?php echo $_GET['id']; ?>'/>
                    <input type="hidden" name='data' value ='<?php echo $_GET['data']; ?>'/>
               </form>
               
                <div class="span1"></div>
                <div class='span5'>
                    <p align="center">
                        <a onclick="view_record(document.getElementsByName('recordForm'));"><span id="leftShelf" ></span></a>
                    </p>
                </div>
                <div class='span5'>              
                    <p align="center">
                        <a onclick="view_record(document.getElementsByName('recordForm'));"><span id="rightShelf" ></span></a>   
                    </p>
                </div>
                <div class="span1"></div>
            </div>            
            <BR>
            <BR>
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
        $(".fa").toggleClass("fa-caret-square-o-up fa-caret-square-o-down");
      });
      $(".delButton").click(function(event) {
        event.preventDefault();
        $(this).parents('.myBook').fadeOut();
      });

    </script> 
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>    
    <script type="text/javascript" src="js/models/Page.js"></script>
    <script type="text/javascript" src="js/jquery.qtip.js"></script>
    <script>         
            
            function getMetadataDiv(page_obj){
                console.log(page_obj);
                
                return "<span> <strong>"+ page_obj.author + ', ' + page_obj.text + ', ' + page_obj.date+" <BR>"+
                        page_obj.writing_sup + ', ' + page_obj.width + ' x ' + page_obj.height + ', ' + page_obj.no_of_col + ' col. ' + page_obj.no_of_lines + ' lines '+ "<BR>" +
                            page_obj.contents +
                        "</strong><span>";
            };
            
            $(document).ready(function(){
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
                    ptr = ptr -2;
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
                    
                });
                
                $("#right").click(function(){
                    ptr = ptr + 2;
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
            });
            
            
            
        </script>
  </body>
</html>

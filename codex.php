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
            <div class="col-md-3" id="logo"><a href="index.php"><img src="img/logo.png" /></div>
          	<div class="col-md-9" style=" height: 55px;">
            		<ul class="link-nav pull-right">
              		<li><a href="search.php">search</a></li>
  		            <li><a href="about.php">about</a></li>
  		            <li><a href="browse.php">browse</a></li>
  		            <li class="active"><a href="resources.php">resources</a></li>
  		            <li><a href="#">citation shelfmarks</a></li>
  		            <li><a href="login.php">login</a></li>
            		</ul>
          	</div>
      	</div>
    </div>
      
    <!--<div class="back">-->
        <div class="container" style="width: 100%">
            <div class="row-fluid">
                <div class="span6">
                    <img id="lpage" style="max-width: 100%" src="images/1.jpg"/>
                </div>
                <div  class="span6">
                    <img id="rpage" style="max-width: 100%" src="images/2.jpg"/>
                </div>
            </div>
            <div class='row-fluid'>
                <div class='span6'>
                    <p align="left">
                        <input type="button" id="left" value="<--"/>        
                    </p>
                </div>
                <div class='span6'>                    
                    <p align="right">
                        <input type="button" id="right" value="-->"/>    
                    </p>
                </div>
            </div>
        </div>
   <!-- </div>-->


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

    </script> 
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
            function Page(){
                this.pageNum = -1;
                this.pageSide = "x";
                this.pageId = -1;
                this.image = "blankpage.jpg";
                this.getPageNum = function getPageNum(){
                    return this.pageNum;
                };
                this.getPageId = function getPageId(){
                    return this.pageId;
                };
                this.getPageSide = function getPageSide(){
                    return this.pageSide;
                };
                this.getImage = function getImage(){
                    return this.image;
                };
            }
            
            $(document).ready(function(){               
                alert('funtioncalled');
                var ptr = 0;
                var pages = [];
                var archivePages = [];
                $.ajax({
                    
                    url: 'getpages.php', //current page
                    type: 'GET',
                    data: {mscript_id: <?php echo $_GET['mscript_id']?> },
                    dataType: "json",
                    contentType: "application/json",                    
                    success: function (d) {
                        alert('success return');
                        $.each(d, function(index, element){
                            var page = new Page();
                            page.pageNum = element.page;
                            page.image = element.path;
                            page.pageNum = element.side;
                            page.pageId = element.id;
                            pages.push(page) ;
                            
                        });
                        $("#lpage").attr('src','/images/'+pages[ptr].getImage());
                        $("#lpage").data('obj',pages[ptr]);
                        
                        $("#rpage").attr('src','/images/'+pages[ptr+1].getImage());
                        $("#rpage").data('obj',pages[ptr+1]);
                        
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
                    $("#lpage").attr('src','/images/'+pages[ptr].getImage());
                    $("#lpage").data('obj',pages[ptr]);
                    $("#rpage").attr('src','/images/'+pages[ptr+1].getImage());
                    $("#rpage").data('obj',pages[ptr+1]);
                    if(ptr===0){
                        document.getElementById("left").disabled=true;
                    }                    
                    document.getElementById("right").disabled=false;
                    
                });
                $("#right").click(function(){
                    ptr = ptr + 2;
                    $("#lpage").attr('src','/images/'+pages[ptr].getImage());
                    $("#lpage").data('obj',pages[ptr]);
                    $("#rpage").attr('src','/images/'+pages[ptr+1].getImage());
                    $("#rpage").data('obj',pages[ptr+1]);
                    if(ptr+2 >= pages.length ){
                        document.getElementById("right").disabled=true;
                    }                    
                    document.getElementById("left").disabled=false;
                    
                });
                /*
                $(".page").dblclick(function(){
                    //Navigate to pan zoom page
                    var page = $(this).data("obj");                   
                    var url = "panzoom.php";
                    var form = $('<form action="' + url + '" method="post">' +
                    '<input type="hidden" name="bookid" value="' + <?php //echo $_POST['bookid']?> + '" />' +
                    '<input type="hidden" name="imageid" value="' + page.pageId + '" />' +
                    '<input type="hidden" name="imagepath" value="' + page.image + '" />' +
                    '</form>');
                    $('body').append(form);
                    $(form).submit();
                    
                    
                });
                */
            });
            
            
            
        </script>
  </body>
</html>

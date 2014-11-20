<?php
    include_once './includes/dbconnect.php';
    include_once './includes/functions.php';
    include_once './includes/constants.php';

    session_start();

    if (login_check() == true) {
        $logged = 'in';
    } else {
        $logged = 'out';
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
        <link href="css/mslink.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript">
            function login_form_submit(form) {                
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
                <div class="col-md-9" style="height: 55px;">
                    <ul class="link-nav pull-right">
                        <li><a href="search.php">search</a></li>
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
                </div>
            </div>
            <?php } ?>
        </div>

        <div id="matchbox">
            <div class="container">
                <div class="row">
                    <?php if(!login_check()) { ?>
                    <div class="col-md-6 col-md-offset-1" >
                        <!--
                        <form role="form">
                            <input type="text" class="form-control" placeholder="Search…">
                        </form>
                        -->
                        <?php if( isset($_GET['reg_error']) && $_GET['reg_error']=='0' ) { ?>
                            <div id="login-box">
                                <p>Thank you for registering. An activation link has been sent to your registered email account. Please click that link to activate your account.
                                   Please check your spam folder if you cannot find an activation email from <?php echo " " . WEBMAIL_ID . " "; ?> in your inbox.
                                </p>
                            </div>
                        <?php } ?>

                    </div>
                    <div class="col-md-3 col-md-offset-2">
                        <div id="login-box">
                            <form role="form" name="login_form" action="utils/process_login.php" method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input name="pass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <a href="login.php">Register</a>
                            </form>
                            <a ><button type="submit" class="btn btn-default pull-right" style="margin-top: -20px;" onclick="login_form_submit(document.getElementsByName('login_form'))">Login</button></a>

                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row about-mss">
                <div class="col-md-5">
                    <p class="lead intro">
                        Welcome to manuscriptlink, an innovative online resource for scholars, librarians, and teachers that seeks to reunite digital images of dismembered and dispersed medieval manuscript leaves into virtual codices.
                    </p>
                </div>
                <div class="col-md-7">
                    <p>
                        manuscriptlink provides a worldwide “collective collection” of virtual manuscripts from ca. 800 to ca. 1600, drawn from thousands of individual manuscript constituents held by its international partners. Our suite of image navigation tools enables users to study individual fragments either as independent objects or as the aggregated components of reconstructed medieval and Renaissance books. Comprehensive and accurate metadata on each item is provided.
                    </p>
                    
                </div>

            </div>

            <div class="row">
                <div class="col-md-5" id="reader-filter" style="text-align: right; padding-right: 2em; color: #fff;">
                    <div data-spy="affix" data-offset-top="676">
                        <ul class="nav nav-pills nav-stacked">
                            <li id="news"><a href="#stay">News</a></li>
                            <li id="blog"><a href="#stay">Blog</a></li>
                            <li id="video"><a href="#stay">Videos</a></li>
                        </ul>
                    </div>
                    &nbsp;
                </div>

                <div id="resting" class="col-md-7 reader">
                    <a name="stay"></a>
                    <div class="news post">
                        <h3>Sample blog post</h3>
                        <h6>Posted on 4/22/2014 by <a href="#">Scott Gwara</a></h6>
                        <p>
                            Whether comparing the paleographical features of multiple manuscripts simultaneously or attempting to recover and read previously lost texts, manuscriptlink conveys a treasury of information engaging a host of Humanities disciplines. Users can customize a personal image archive as well. Imagine the immense cultural and scholarly value of restoring a lost medieval library amounting to thousands of volumes, studying high-resolution images under magnification, comparing multiple features from the same or different sources, and shaping the results of one’s scholarship in a personalized archive.
                        </p>
                    </div>
                    <div class="news post">
                        <h3>Sample blog post</h3>
                        <h6>Posted on 4/22/2014 by <a href="#">Scott Gwara</a></h6>
                        <p>
                            Whether comparing the paleographical features of multiple manuscripts simultaneously or attempting to recover and read previously lost texts, manuscriptlink conveys a treasury of information engaging a host of Humanities disciplines. Users can customize a personal image archive as well. Imagine the immense cultural and scholarly value of restoring a lost medieval library amounting to thousands of volumes, studying high-resolution images under magnification, comparing multiple features from the same or different sources, and shaping the results of one’s scholarship in a personalized archive.
                        </p>
                    </div>
                    <div class="news post">
                        <h3>Sample blog post</h3>
                        <h6>Posted on 4/22/2014 by <a href="#">Scott Gwara</a></h6>
                        <p>
                            Whether comparing the paleographical features of multiple manuscripts simultaneously or attempting to recover and read previously lost texts, manuscriptlink conveys a treasury of information engaging a host of Humanities disciplines. Users can customize a personal image archive as well. Imagine the immense cultural and scholarly value of restoring a lost medieval library amounting to thousands of volumes, studying high-resolution images under magnification, comparing multiple features from the same or different sources, and shaping the results of one’s scholarship in a personalized archive.
                        </p>
                    </div>
                    <div class="news post">
                        <h3>Sample blog post</h3>
                        <h6>Posted on 4/22/2014 by <a href="#">Scott Gwara</a></h6>
                        <p>
                            Whether comparing the paleographical features of multiple manuscripts simultaneously or attempting to recover and read previously lost texts, manuscriptlink conveys a treasury of information engaging a host of Humanities disciplines. Users can customize a personal image archive as well. Imagine the immense cultural and scholarly value of restoring a lost medieval library amounting to thousands of volumes, studying high-resolution images under magnification, comparing multiple features from the same or different sources, and shaping the results of one’s scholarship in a personalized archive.
                        </p>
                    </div>
                </div>
            </div>
        </div>








        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script launguage="JavaScript">
            $('.nav-stacked li').on('click', function() {
                $('li').removeClass('active');
                $(this).addClass('active');
            });
            $('#news').on('click', function() {
                $('.blog').fadeOut();
                $('.video').fadeOut();
                $('.news').fadeIn();
            });
            $('#video').on('click', function() {
                $('.blog').fadeOut();
                $('.news').fadeOut();
                $('.video').fadeIn();
            });
            $('#blog').on('click', function() {
                $('.news').fadeOut();
                $('.video').fadeOut();
                $('.blog').fadeIn();
            });

            $(document).ready(function(){
                $("#shelfmarks").load('citationShelfmark.php');
            });

        </script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

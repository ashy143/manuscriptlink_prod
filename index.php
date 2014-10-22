<?php
    include_once './includes/dbconnect.php';
    include_once './includes/functions.php';

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
                    <div class="col-md-6 col-md-offset-1" id="home-search">
                        <form role="form">
                            <input type="text" class="form-control" placeholder="Search…">
                        </form>
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
                        "And withal it is very simple, David.  The earth was once a nebulous mass.  It cooled, and as it cooled it shrank.  At length a thin crust of solid matter formed upon its outer surface&mdash;a sort of shell; but within it was partially molten matter and highly expanded gases
                    </p>
                </div>
                <div class="col-md-7">
                    <p>
                        As it continued to cool, what happened?  Centrifugal force burled the particles of the nebulous center toward the crust as rapidly as they approached a solid state.  You have seen the same principle practically applied in the modern cream separator.  Presently there was only a small super-heated core of gaseous matter remaining within a huge vacant interior left by the contraction of the cooling gases.  
                    </p>
                    <p>
                        The equal attraction of the solid crust from all directions maintained this luminous core in the exact center of the hollow globe.  What remains of it is the sun you saw today&mdash;a relatively tiny thing at the exact center of the earth.  Equally to every part of this inner world it diffuses its perpetual noonday light and torrid heat.
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
                        <h3>"Knife? Aye, aye," cried Queequeg, and seizing</h3>
                        <h6>Posted on 4/22/2014 by <a href="#">Scott Gwara</a></h6>
                        <p>Then came the night of the first falling star.  It was seen early in the morning, rushing over Winchester eastward, a line of flame high in the atmosphere.  Hundreds must have seen it, and taken it for an ordinary falling star.  Albin described it as leaving a greenish streak behind it that glowed for some seconds.  Denning, our greatest authority on meteorites, stated that the height of its first appearance was about ninety or one hundred miles.  It seemed to him that it fell to earth about one hundred miles east of him.</p>

                        <p>I was at home at that hour and writing in my study; and although my French windows face towards Ottershaw and the blind was up (for I loved in those days to look up at the night sky), I saw nothing of it. Yet this strangest of all things that ever came to earth from outer space must have fallen while I was sitting there, visible to me had I only looked up as it passed.  Some of those who saw its flight say it travelled with a hissing sound.  I myself heard nothing of that.  Many people in Berkshire, Surrey, and Middlesex must have seen the fall of it, and, at most, have thought that another meteorite had descended. No one seems to have troubled to look for the fallen mass that night.</p>
                    </div>

                    <div class="blog post">
                        <h3>'Why, what are YOUR shoes done</h3>
                        <h6>Posted on 4/22/2014 by <a href="#">Digital Scriptorium</a></h6>

                        <p>The Queen turned to the mice that attended her and told them to go at once and get all her people.  As soon as they heard her orders they ran away in every direction as fast as possible.</p>

                        <p>"Now," said the Scarecrow to the Tin Woodman, "you must go to those trees by the riverside and make a truck that will carry the Lion."</p>

                        <p>So the Woodman went at once to the trees and began to work; and he soon made a truck out of the limbs of trees, from which he chopped away all the leaves and branches.  He fastened it together with wooden pegs and made the four wheels out of short pieces of a big tree trunk.  So fast and so well did he work that by the time the mice began to arrive the truck was all ready for them.</p>
                    </div>

                    <div class="video post">
                        <h3>Then came the night of the first falling star.</h3>
                        <h6>Posted on 4/22/2014 by <a href="#">Scott Gwara</a></h6>
                        <div class="player">
                            <iframe src="//player.vimeo.com/video/67805732?byline=0&amp;portrait=0&amp;color=D9305B"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        </div>
                    </div>

                    <div class="blog post">
                        <h3>'Why, what are YOUR shoes done</h3>
                        <h6>Posted on 4/22/2014 by <a href="#">Scott Gwara</a></h6>

                        <p>The Queen turned to the mice that attended her and told them to go at once and get all her people.  As soon as they heard her orders they ran away in every direction as fast as possible.</p>

                        <p>"Now," said the Scarecrow to the Tin Woodman, "you must go to those trees by the riverside and make a truck that will carry the Lion."</p>

                        <p>So the Woodman went at once to the trees and began to work; and he soon made a truck out of the limbs of trees, from which he chopped away all the leaves and branches.  He fastened it together with wooden pegs and made the four wheels out of short pieces of a big tree trunk.  So fast and so well did he work that by the time the mice began to arrive the truck was all ready for them.</p>
                    </div>

                    <div class="video post">
                        <h3>Then came the night of the first falling star.</h3>
                        <h6>Posted on 4/22/2014 by <a href="#">Scott Gwara</a></h6>

                        <div class="player">
                            <iframe src="//player.vimeo.com/video/73617382?byline=0&amp;portrait=0&amp;color=D9305B" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        </div>
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

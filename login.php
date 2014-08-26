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
        
        <script src="js/gen_validatorv31.js" type="text/javascript"></script>
        <script type="text/javascript">
            function login_form_submit(form){                
                $(form).submit(); 
            }
            
            function register_form_submit(form){
                $(form).submit();
            }
        </script>
    </head>
    <body>

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
                        <li class="active"><a href="#">login</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="matchbox">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-1">
                        <div id="register-box">
                            <h3>Register</h3>
                            <span style="color: green">
                                <?php                                    
                                    if( isset($_GET['reg_suc']) ){                                        
                                        echo $_GET['reg_suc'];
                                        unset($_GET['reg_suc']);
                                    }
                                ?>                                    
                                </span>
                                 <span style="color: red">
                                <?php                                    
                                    if( isset($_GET['reg_error']) ){                                        
                                        echo $_GET['reg_error'];
                                        unset($_GET['reg_error']);
                                    }
                                ?>
                                    
                                </span>
                            <form role="form" name="reg_form" action="utils/process_register.php" method="post">

                                <div class="form-group" >
                                    <label for="inputName">Name</label>
                                    <input type="name" name="name" class="form-control" id="inputName" placeholder="Enter name">
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail">Email address</label>
                                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" name="pass" class="form-control" id="inputPassword" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm password</label>
                                    <input type="password" name="confirm_pass" class="form-control" id="confirmPassword" placeholder="Password">
                                </div>                                
                            </form>
                            <button type="submit" class="btn btn-default pull-right" onclick="register_form_submit(document.getElementsByName('reg_form'))">Submit</button>                  
                            <script>
                                var reg_form_validator = new Validator("reg_form");
//                                    reg_form_validator.EnableOnPageErrorDisplay();
                                reg_form_validator.EnableMsgsTogether();
                                reg_form_validator.addValidation('name','req','Please enter your name');
                                reg_form_validator.addValidation('email','req','Please enter your email');
                                reg_form_validator.addValidation('pass','req','Please enter your password');
                                reg_form_validator.addValidation("pass","minlen=7","Minimum length for Password is 7");
                                reg_form_validator.addValidation('confirm_pass','req','Please retype your password');

                            </script>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-offset-2">
                        <div id="login-box-login-page">
                            <h3>Login</h3>
                            
                            <span style="color: red">   <!-- for error display -->
                                <?php                                    
                                    if( isset($_GET['login_error']) ){                                        
                                        echo $_GET['login_error'];
                                        unset($_GET['login_error']);
                                    }
                                ?>
                            </span>
                            
                            <form name="login_form" role="form" action="utils/process_login.php" method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name='email' class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name='pass' class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                            </form>

                            <a><button type="submit" class="btn btn-default pull-right" onclick="login_form_submit(document.getElementsByName('login_form'))">Login</button></a>

                        </div>
                    </div>

                </div>
            </div>
        </div>






        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

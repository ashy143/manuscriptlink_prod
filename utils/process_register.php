<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../includes/functions.php';
include_once '../includes/constants.php';

session_start();

if(isset($_POST['email'],$_POST['pass'],$_POST['name'])){
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $name = $_POST['name'];
    $id = register($name, $email, $password, $mysqli);
    if($id){
        //after successful registaration navigate user to index page asking him to login.
        //Send an email for account activation
        
        // return mail('ash.patthi@gmail.com', 'My Subject', 'This is test mail - no reply');

        $from = WEBMAIL_ID;
        $protocol = (strstr('https',$_SERVER['SERVER_PROTOCOL']) === false)?'http':'https';
        $host_url = $protocol.'://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'];
        $to = $email;
        $subject = "Welcome to Manuscript Link";
        $message = "Dear " . $name . "\n" 
                    .BASE_URL
                    . "Thank you for registering with Manuscript Link. Please click <a href = '$host_url/activateuser.php?id=$id'>here</a> to activate your account. \n"; 
                    


        $headers = 'From: $from' . "\r\n".
                    'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);
        header("location: ../index.php?reg=1");
    }else{
        //Login failed
        header("location: ../index.php?reg_error=1");
    }
         
}else{
    echo "Invalid request";
}

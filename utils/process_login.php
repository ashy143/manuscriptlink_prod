<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../includes/dbconnect.php';
include_once '../includes/functions.php';

session_start();

if(isset($_POST['email'],$_POST['pass'])){
    $email = $_POST['email'];
    $password = $_POST['pass'];
    
    if(login($email, $password, $mysqli)){
        //Login success
        header("location: ../user.php");
    }else{
        //Login failed
        header("location: ../index.php?error=1");
    }
         
}else{
    echo "Invalid request";
}

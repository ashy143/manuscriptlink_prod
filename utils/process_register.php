<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../includes/dbconnect.php';
include_once '../includes/functions.php';

session_start();

if(isset($_POST['email'],$_POST['pass'],$_POST['name'])){
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $name = $_POST['name'];
    if(register($name, $email, $password, $mysqli)){
        //after successful registaration navigate user to index page asking him to login.
        header("location: ../index.php?reg=1");
    }else{
        //Login failed
        header("location: ../index.php?reg_error=1");
    }
         
}else{
    echo "Invalid request";
}

<?php 
    include_once 'config.php';
//    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE, PORT);
    global $mysqli;
//    $mysqli = new mysqli("localhost", "ashwin", "manuscriptlink", "manuscriptlink", 3306);
    
    //Local config
    $mysqli = new mysqli("localhost", "root", NULL, "mydb", 3306);      
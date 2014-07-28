<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$host = "localhost:3306";
$databaseName = "mydb";
$tableName = "folios";
$username = "root";
$con = mysql_connect($host,$username) or die("Unable to connect to MySQL");

mysql_select_db($databaseName, $con) or die("Could not select" .mysql_error());

$handle = fopen("C:\\xampp\\htdocs\\manuscriptlink_prod\\utils\\abc.txt", 'r');



while( ($linetemp = fgets($handle)) != FALSE){
    $line = str_replace("\n", "", $linetemp);
    $words = explode('/',$line);    
    $lastwordtemp = $words[count($words)-1];
    $lastword = str_replace('\n', '', $lastwordtemp);
//    echo $lastword;
//    echo "\n";
    $image_name= str_replace('.jpg', '', $lastword);
      
    $query = "update folios set res_ident = '" . mysql_real_escape_string($line) ."' where res_ident = '" . mysql_real_escape_string($image_name) . "'";
    echo $query;
    echo "\n";
   // mysql_query($query) or die(mysql_error());
    
}




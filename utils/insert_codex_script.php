<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$host = "127.0.0.1:8889";
$databaseName = "mlinkdb";
$tableName = "manuscript";
$username = "root";
$pass= "root";

$mysqli = new mysqli("localhost", "root", "root", "mlinkdb", 8889);     

// $con = mysql_connect('localhost', 'root', 'root'); or die("Unable to connect to MySQL");

// mysql_select_db($databaseName, $con) or die("Could not select" .mysql_error());

$handle = fopen("/Users/ashwin/Downloads/codex_master.csv", 'r');

fgetcsv($handle);//Skip header
$count  = 161;
$found = 0 ;
while( ($line = fgetcsv($handle)) != FALSE){
    $check_blank_line= implode(',',$line);    
    $rep_line = str_replace(',', '', $check_blank_line);
    
    if(strcmp($rep_line, "") == 0){
        echo 'found';
        $found = $found +1;
        continue;
    }
    $mscript_link_part = explode('.', $line[0]);    
    $mscriptlink = $mscript_link_part[0];
    $part = $mscript_link_part[1];
//    
//    $date = $line[1];
//    $century = $line[1];
//    $writing_sup = $line[1];
//    $type_text = $line[1];
//    $liturgical_use = $line[1];
//    $date = $line[1];
//    $gender_use = 
//    $subj = $line[1];
//    $century = $line[1];
//    $writing_sup = $line[1];
//    $type_text = $line[1];
//    $liturgical_use = $line[1];
//    $date = $line[1];
//    
//    
    $query = sprintf("INSERT INTO manuscript values (%d, %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s', '%s', '%s','%s', '%s','%s', '%s', '%s','%s', %d, %d,'%s', '%s','%s', '%s', '%s', '%s');",$count,$mscriptlink, $part, mysql_real_escape_string($line[1]) ,mysql_real_escape_string($line[2]),mysql_real_escape_string($line[3]),mysql_real_escape_string($line[4]),mysql_real_escape_string($line[5]),  mysql_real_escape_string($line[7]),mysql_real_escape_string($line[8]),mysql_real_escape_string($line[14]),mysql_real_escape_string($line[15]),mysql_real_escape_string($line[16]),mysql_real_escape_string($line[17]),mysql_real_escape_string($line[18]),mysql_real_escape_string($line[19]),mysql_real_escape_string($line[20]),mysql_real_escape_string($line[21]),$line[22],$line[23],mysql_real_escape_string($line[24]),mysql_real_escape_string($line[25]),mysql_real_escape_string($line[26]),mysql_real_escape_string($line[27]),mysql_real_escape_string($line[28]),mysql_real_escape_string($line[29]));
    //echo $query;
    //echo "\n";
    // mysql_query($query) or die(mysql_error());
    $mysqli->query($query);
    $query_loc = sprintf("INSERT INTO origin values (%d, '%s', '%s', '%s', '','%s','%s');" ,$count,mysql_real_escape_string($line[9]),mysql_real_escape_string($line[10]), mysql_real_escape_string($line[11]), mysql_real_escape_string($line[12]), mysql_real_escape_string($line[13]));
    //echo $query_loc;
    // mysql_query($query_loc) or die(mysql_error());
    $mysqli->query($query_loc);
    $count = $count + 1;
}
echo $found;



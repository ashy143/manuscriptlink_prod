
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$host = "localhost";
$databaseName = "mlinkdb";

$username = "root";
$con = mysql_connect($host, $username, 'root') or die("Unable to connect to MySQL");

mysql_select_db($databaseName, $con) or die("Could not select" .mysql_error());

$handle = fopen("/Users/ashwin/Downloads/folio_master.csv", 'r');

fgetcsv($handle);//Skip header
$count  = 1;
$found = 0 ;
while( ($line = fgetcsv($handle)) != FALSE){
    $check_blank_line= implode(',',$line);    
    $rep_line = str_replace(',', '', $check_blank_line);
    echo 'linecount'.count($line);
    echo "\n";
    if(strcmp($rep_line, "") == 0){
        echo 'found';
        $found = $found +1;
        continue;
    }
    echo "\n";
    echo $line[0];
    $mscript_link_part = explode('.', $line[0]);    
    $mscriptlink = $mscript_link_part[0];
    $part = $mscript_link_part[1];
    
    $query_m = sprintf("SELECT mscript_id from manuscript where mlinknumber = %d and part = %d", $mscriptlink, $part); 
//    echo $query_m;
    $result = mysql_query($query_m) or die(mysql_error());
    $row = mysql_fetch_row($result);
    
    $mscript_id = $row[0];
    echo $mscript_id;
    
    $folio_num_side = $line[16];
    $side = 'r';
    if (strpos($folio_num_side, 'verso') !== false ){
        $side = 'v';
    }else if (strpos($folio_num_side, 'v') !== false){
        $side = 'v';
    }
    
    $folio_num = preg_replace("/[^0-9]/","",$folio_num_side);
    
    if($mscript_id <= 0){
        continue;
    }
    
    $query = sprintf("INSERT INTO folios values (%d, %d, '%s', '%s', '%s', '%s', '%s', '%s', %d, '%s', %d, %d, %f, %f, %f, %f , '%s','%s', '%s', %d, %d, %f,'%s', '%s', '%s', '%s','%s', '%s', '%s', '%s' '%s', '%s', '%s', '%s', '%s', '%s');",$count,$mscript_id, mysql_real_escape_string($line[1]) ,mysql_real_escape_string($line[2]),mysql_real_escape_string($line[3]),mysql_real_escape_string($line[4]), mysql_real_escape_string($line[14]),mysql_real_escape_string($line[15]),$folio_num, $side, $line[17], $line[18], $line[19], $line[20], $line[21],$line[22],mysql_real_escape_string($line[23]),mysql_real_escape_string($line[24]),mysql_real_escape_string($line[25]), $line[26], $line[27] ,$line[28],mysql_real_escape_string($line[29]),mysql_real_escape_string($line[30]),mysql_real_escape_string($line[31]),mysql_real_escape_string($line[32]),mysql_real_escape_string($line[33]),mysql_real_escape_string($line[34]),mysql_real_escape_string($line[35]),mysql_real_escape_string($line[36]),mysql_real_escape_string($line[37]),mysql_real_escape_string($line[38]),mysql_real_escape_string($line[39]),mysql_real_escape_string($line[40]),mysql_real_escape_string($line[41]),mysql_real_escape_string($line[13]));
    
    mysql_query($query) or die(mysql_error());
    
    $query_loc = sprintf("INSERT INTO location values (%d, '%s', '%s', '%s', '%s','%s','%s', '%s','%s');" ,$count,mysql_real_escape_string($line[5]),mysql_real_escape_string($line[6]), mysql_real_escape_string($line[7]), mysql_real_escape_string($line[8]), mysql_real_escape_string($line[9]), mysql_real_escape_string($line[10]), mysql_real_escape_string($line[11]), mysql_real_escape_string($line[12]));
    mysql_query($query_loc);
    
    $count = $count + 1;
}
echo $found;



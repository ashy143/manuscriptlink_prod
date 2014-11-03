
<?php
    include_once '../includes/functions.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$host = "localhost";
$databaseName = "manuscriptlink";

$username = "ashwin";
$con = mysql_connect($host, $username, 'manuscriptlink') or die("Unable to connect to MySQL");

mysql_select_db($databaseName, $con) or die("Could not select" .mysql_error());

$handle = fopen("folio_master.csv", 'r');

fgetcsv($handle);//Skip header
$count  = 1;
$found = 0 ;
while( ($line = fgetcsv($handle)) != FALSE){
    $check_blank_line= implode(',',$line);    
    $rep_line = str_replace(',', '', $check_blank_line);
    //echo 'linecount'.count($line);
    //echo "\n";
    if(strcmp($rep_line, "") == 0){
        echo 'found';
        $found = $found +1;
        continue;
    }
    //echo "\n";
    //echo $line[0];
    $mscript_link_part = explode('.', $line[0]);    
    $mscriptlink = $mscript_link_part[0];
    $part = $mscript_link_part[1];
    
    $query_m = sprintf("SELECT mscript_id from manuscript where mlinknumber = %d and part = %d", $mscriptlink, $part); 
    $result = mysql_query($query_m) or die(mysql_error());
    $row = mysql_fetch_row($result);
    
    $mscript_id = $row[0];
    //echo $mscript_id;
    
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

    $min_ht = getMinMaxValue($line[20], "MIN");
    $max_ht = getMinMaxValue($line[20], "MAX");
    $min_width = getMinMaxValue($line[22], "MIN");
    $max_width = getMinMaxValue($line[22], "MAX");
    $min_ht_written = getMinMaxValue($line[24], "MIN");
    $max_ht_written = getMinMaxValue($line[24], "MAX");
    $min_width_written = getMinMaxValue($line[26], "MIN");
    $max_width_written = getMinMaxValue($line[26], "MAX");

    
    $query = sprintf("INSERT INTO folios values 
        (%d, %d, '%s', '%s', '%s', 
        '%s', '%s', '%s', %d, '%s', 
        %d, %d, '%s', '%s', '%s', 
        '%s', '%s', '%s', '%s', %d, 
        %d, %f, '%s', '%s', '%s', 
        '%s', '%s', '%s', '%s', '%s',
        '%s', '%s', '%s', '%s', '%s',
        %d, %d, %d, %d, %d,
        %d, %f, %f, %f, %f,
        %f, %f, %f, %f );",
        $count, $mscript_id, mysql_real_escape_string($line[1]), mysql_real_escape_string($line[2]), mysql_real_escape_string($line[3]),
        mysql_real_escape_string($line[4]), mysql_real_escape_string($line[14]), mysql_real_escape_string($line[15]), $folio_num, $side, 
        $line[17], $line[19], $line[20], $line[22], $line[24],
        $line[26], mysql_real_escape_string($line[28]), mysql_real_escape_string($line[29]), mysql_real_escape_string($line[30]), $line[31], 
        $line[33], $line[34], mysql_real_escape_string($line[35]), mysql_real_escape_string($line[36]), mysql_real_escape_string($line[38]), 
        mysql_real_escape_string($line[39]), mysql_real_escape_string($line[40]), mysql_real_escape_string($line[41]), mysql_real_escape_string($line[42]), mysql_real_escape_string($line[43]), 
        mysql_real_escape_string($line[44]), mysql_real_escape_string($line[45]), mysql_real_escape_string($line[46]), mysql_real_escape_string($line[47]), mysql_real_escape_string($line[13]),
        $line[18], $line[21], $line[23], $line[25], $line[27],
        $line[32], $min_ht, $max_ht, $max_width, $min_width,
        $min_ht_written, $max_ht_written, $min_width_written, $max_width_written );
    
    mysql_query($query) or die(mysql_error());
    
    $query_loc = sprintf("INSERT INTO location values (%d, '%s', '%s', '%s', '%s','%s','%s', '%s','%s');" ,
        $count,mysql_real_escape_string($line[5]), mysql_real_escape_string($line[6]), mysql_real_escape_string($line[7]), mysql_real_escape_string($line[8]), mysql_real_escape_string($line[9]), mysql_real_escape_string($line[10]), mysql_real_escape_string($line[11]), mysql_real_escape_string($line[12]));
    
    mysql_query($query_loc);
    $count = $count + 1;
}



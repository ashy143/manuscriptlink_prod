<?php


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$host = "localhost:3306";
$databaseName = "mydb";
$tableName = "folios";
$username = "root";
$con = mysql_connect($host,$username) or die("Unable to connect to MySQL");

mysql_select_db($databaseName, $con) or die("Could not select" .mysql_error());

if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else{
    $sql_pages = "SELECT folio_num, folio_side, res_ident, folio_id FROM ".$tableName." WHERE mscript_id=".$_GET['mscirpt_id']." order by folio_num asc, folio_side asc";
    $sql_minpage = "SELECT MIN(folio_num) from ".$tableName." WHERE mscript_id=".$_GET['mscript_id'];
    $sql_maxpage = "SELECT MAX(folio_num) from ".$tableName." WHERE mscript_id=".$_GET['mscript_id'];
    
    $result = mysql_query($sql_pages) or die(mysql_error());
    $result_min = mysql_query($sql_minpage) or die(mysql_error());
    $result_max = mysql_query($sql_maxpage) or die(mysql_error());

    $row_min = mysql_fetch_row($result_min);
    $row_max = mysql_fetch_row($result_max);
    
    class Page{
        public $num  = "x";
        public $side = "x";
        public $path = "";
        public $id  = -1;
    }
    $blank_page = new Page();
    $blank_page->path = "blankpage.jpg";
    $pages = array();
    $max = $row_max[0];
    $min = $row_min[0];
    //Add first and last page of the book as blank
    $pages[] = $blank_page;
    
    $prev_page = $row_min[0]-1;
    $prev_side = "v";
    while ($row = mysql_fetch_row($result)){
        if($prev_side == "v"){  //when previous page is verso
            if($row[0]- $prev_page > 1){
                //add a complet blank folio which means 2 blank pages
                $pages[] = $blank_page;
                $pages[] = $blank_page;
            }
        }else{  //when previous page is recto
            if($row[0]- $prev_page > 0){
                $pages[] = $blank_page;
            }
        }
        $p = new Page();
        $p -> num = $row[0];
        $p -> side = $row[1];
        $p -> path = $row[2];
        $p -> id = $row[3];
               
        $pages[] = $p;
        $prev_page = $row[0];
        $prev_side = $row[1];
         
    }
    $pages[] = $blank_page;
    $json_data = json_encode($pages);
    echo $json_data;
}


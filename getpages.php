<?php

include_once './includes/config.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    
    $tableName = "folios";    
    $con = mysql_connect(HOST.':'.PORT, USER, PASSWORD) or die("Unable to connect to MySQL");
    mysql_select_db(DATABASE, $con) or die("Could not select" .mysql_error());

if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else{
    $sql_pages = "SELECT fol.folio_num, fol.folio_side, fol.res_ident, fol.folio_id, fol.abreviated_shelf, fol.author, fol.height, fol.width, fol.no_of_col, fol.no_of_lines, fol.folio_contents, ms.text_type, ms.date_manuscript, ms.writing_support " 
                  . " FROM " .$tableName. " as fol LEFT JOIN manuscript AS ms ON fol.mscript_id = ms.mscript_id WHERE ms.mscript_id IN ( SELECT mscript_id FROM manuscript WHERE mlinknumber = "
                  . " (SELECT mlinknumber FROM manuscript WHERE mscript_id = " . $_GET['mscript_id']. ") )"
                  . " ORDER BY folio_num ASC, folio_side ASC ";
    

    $sql_minpage = "SELECT MIN(folio_num) from ".$tableName." WHERE mscript_id=".$_GET['mscript_id'];
    $sql_maxpage = "SELECT MAX(folio_num) from ".$tableName." WHERE mscript_id=".$_GET['mscript_id'];
    
    $result = mysql_query($sql_pages) or die(mysql_error());
    $result_min = mysql_query($sql_minpage) or die(mysql_error());
    $result_max = mysql_query($sql_maxpage) or die(mysql_error());

    $row_min = mysql_fetch_row($result_min) or die(mysql_error());
    $row_max = mysql_fetch_row($result_max)or die(mysql_error());
    
    class Page{
        public $num  = "x";
        public $side = "x";
        public $path = "";
        public $id  = -1;
        public $abbrshelf = '--';
        public $author = '';
        public $height = '';
        public $width='';
        public $no_of_lines='';
        public $no_of_cols='';
        public $text = '';
        public $genre = '';
        public $origin = '';
        public $date = '';
        public $writing_sup='';
        public $contents='';
        
    }
    $blank_page = new Page();
    //Will load blank page from project folder rather than manuscript_images folder
    $blank_page->path = "./img/missing_leaf.jpg";
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
        $p -> abbrshelf = $row[4];
        $p-> author = $row[5];
        $p-> height = $row[6];
        $p->width = $row[7];
        $p->no_of_cols = $row[8];
        $p->no_of_lines = $row[9];
        $p->contents = $row[10];
        $p->text = $row[11];
        $p->date = $row[12];
        $p->writing_sup =$row[13];
               
        $pages[] = $p;
        $prev_page = $row[0];
        $prev_side = $row[1];
         
    }
    $pages[] = $blank_page;
    $json_data = json_encode($pages);
    echo $json_data;
}


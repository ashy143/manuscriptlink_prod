
<?php

    include_once '../includes/functions.php';
    include_once '../includes/dbconnect.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    class Msg{
        public $statusNum = 200;
        public $statusMsg = "Ok";
    }
    $msg = new Msg();

    $mscript_link_part = explode('.', $_GET['mscript']);
    $mscriptlink = $mscript_link_part[0];
    $part = $mscript_link_part[1];
    
    $query_m = sprintf("SELECT mscript_id from manuscript where mlinknumber = %d and part = %d", $mscriptlink, $part); 
    $res = $mysqli->query($query_m);
    if($res->num_rows < 1){
        $msg->statusNum = 210;
        $msg->statusMsg = "The manuscript you mentioned doesn't exist. Please try again by entering proper value or create a manuscript if it doesn't exist.";

    }else{
        $row = $res->fetch_assoc();
        $mscript_id = $row['mscript_id'];
        //echo $mscript_id;
        
        $side = $_GET['fol_side'];
        $folio_num = $_GET['fol_num'];

        $min_ht = getMinMaxValue($_GET['height'], "MIN");
        $max_ht = getMinMaxValue($_GET['height'], "MAX");
        $min_width = getMinMaxValue($_GET['width'], "MIN");
        $max_width = getMinMaxValue($_GET['width'], "MAX");
        $min_ht_written = getMinMaxValue($_GET['height_written'], "MIN");
        $max_ht_written = getMinMaxValue($_GET['height_written'], "MAX");
        $min_width_written = getMinMaxValue($_GET['width_written'], "MIN");
        $max_width_written = getMinMaxValue($_GET['width_written'], "MAX");

    
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
            NULL, $mscript_id, mysqli_real_escape_string($mysqli, $_GET['title']), mysqli_real_escape_string($mysqli, $_GET['alt_title']), mysqli_real_escape_string($mysqli, $_GET['author']),
            mysqli_real_escape_string($mysqli, $_GET['date_text']), mysqli_real_escape_string($mysqli, $_GET['folio_contents']), mysqli_real_escape_string($mysqli, $_GET['folio_prov']), $folio_num, $side, 
            $_GET['no_of_lines'], $_GET['no_of_col'], $_GET['height'], $_GET['width'], $_GET['height_written'],
            $_GET['width_written'], mysqli_real_escape_string($mysqli, $_GET['quire_sign']), mysqli_real_escape_string($mysqli, $_GET['catchwords']), mysqli_real_escape_string($mysqli, $_GET['neumes']), $_GET['staves_per_page'], 
            $_GET['lines_per_staff'], $_GET['dim_staff'], mysqli_real_escape_string($mysqli, $_GET['col_staff']), mysqli_real_escape_string($mysqli, $_GET['res_ident']), mysqli_real_escape_string($mysqli, $_GET['website']), 
            mysqli_real_escape_string($mysqli, $_GET['contrib_inst']), mysqli_real_escape_string($mysqli, $_GET['rights_mgmt']), mysqli_real_escape_string($mysqli, $_GET['image_format']), mysqli_real_escape_string($mysqli, $_GET['digit_specs']), mysqli_real_escape_string($mysqli, $_GET['date_digital']), 
            mysqli_real_escape_string($mysqli, $_GET['scan_tech']), mysqli_real_escape_string($mysqli, $_GET['meta_catag']), mysqli_real_escape_string($mysqli, $_GET['coll_admin']), mysqli_real_escape_string($mysqli, $_GET['faculty_liason']), mysqli_real_escape_string($mysqli, $_GET['abreviated_shelf']),
            $_GET['no_of_lines_broken'], $_GET['ht_fol_broken'], $_GET['width_fol_broken'], $_GET['ht_written_space_broken'], $_GET['width_written_space_broken'],
            $_GET['staves_per_page_broken'], $min_ht, $max_ht, $max_width, $min_width,
            $min_ht_written, $max_ht_written, $min_width_written, $max_width_written );
    
        $mysqli->query($query);
        
        $query_loc = sprintf("INSERT INTO location values (%d, '%s', '%s', '%s', '%s','%s','%s', '%s','%s');" ,
            $$mysqli->insert_id, mysqli_real_escape_string($mysqli, $_GET['state']), mysqli_real_escape_string($mysqli, $_GET['country']), mysqli_real_escape_string($mysqli, $_GET['municipality']), mysqli_real_escape_string($mysqli, $_GET['institution']), mysqli_real_escape_string($mysqli, $_GET['division']), mysqli_real_escape_string($mysqli, $_GET['collection']), mysqli_real_escape_string($mysqli, $_GET['callno']), mysqli_real_escape_string($mysqli, $_GET['series']));
        
        $mysqli->query($query_loc);
    }

    echo json_encode($msg);


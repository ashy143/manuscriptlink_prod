
<?php

    include_once '../includes/functions.php';
    include_once '../includes/dbconnect.php';
    include_once '../includes/constants.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    error_log(print_r($_POST, true));
    error_log("GET");
    error_log(print_r($_FILES, true));
    class Msg{
        public $statusNum = 200;
        public $statusMsg = "Ok";
    }
    $msg = new Msg();

    $mscript_link_part = explode('.', $_POST['mscript']);
    $mscriptlink = $mscript_link_part[0];
    $part = $mscript_link_part[1];
    $query_m = sprintf("SELECT mscript_id from manuscript where mlinknumber = %d and part = %d", $mscriptlink, $part); 
    error_log($query_m);
    $res = $mysqli->query($query_m);
    if($res->num_rows < 1){
        $msg->statusNum = 201;
        $msg->statusMsg = "The manuscript you mentioned doesn't exist. Please try again by entering proper value or create a manuscript if it doesn't exist.";

    }else{
        $row = $res->fetch_assoc();
        $mscript_id = $row['mscript_id'];
        //echo $mscript_id;
        
        $side = $_POST['fol_side'];
        $folio_num = $_POST['fol_num'];

        $min_ht = getMinMaxValue($_POST['height'], "MIN");
        $max_ht = getMinMaxValue($_POST['height'], "MAX");
        $min_width = getMinMaxValue($_POST['width'], "MIN");
        $max_width = getMinMaxValue($_POST['width'], "MAX");
        $min_ht_written = getMinMaxValue($_POST['height_written'], "MIN");
        $max_ht_written = getMinMaxValue($_POST['height_written'], "MAX");
        $min_width_written = getMinMaxValue($_POST['width_written'], "MIN");
        $max_width_written = getMinMaxValue($_POST['width_written'], "MAX");
        $image_path = IMAGE_UPLOAD_ROOT_DIR . join(DIRECTORY_SEPARATOR, array($_POST['image_institution'], $_POST['date_acq'], $_POST['image_collection'], $_POST['ms_call'], 'images', $_POST['image_name'].'.jpg'));

        error_log($image_path);
            //FILE UPLODAD LOGIC
          $temp = explode(".", $_FILES["file"]["name"]);
          if ( (($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg")) && ($_FILES["file"]["size"] < 6000000)){
                if ($_FILES["file"]["error"] > 0){
                      $msg->statusNum = 201;
                      $msg->statusMsg = 'File error:' . $_FILES["file"]["error"];
                }else{

                      // $fileName = $temp[0].".".$temp[1];
                      // $temp[0] = rand(0, 3000); //Set to random number
                      // $fileName;

                    error_log(IMAGE_UPLOAD_ROOT_DIR . $_FILES["file"]["name"]);

                      if (file_exists(IMAGE_UPLOAD_ROOT_DIR . $_FILES["file"]["name"])){
                            $msg->statusNum = 201;
                            $msg->statusMsg = $_FILES["file"]["name"] . " already exists. ";
                      }else{
                            move_uploaded_file($_FILES["file"]["tmp_name"], $image_path);
                            $msg->statusMsg = "File uploaded successfully.";
                      }
                }
          }else{
                $msg->statusNum = 201;
                $msg->statusMsg = "Invalid File. Maximum allowed file size 6 MB. " . $_FILES["file"]["type"];
          }






    
        $query = sprintf("INSERT INTO folios_temp values 
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
            NULL, $mscript_id, mysqli_real_escape_string($mysqli, $_POST['title']), mysqli_real_escape_string($mysqli, $_POST['alt_title']), mysqli_real_escape_string($mysqli, $_POST['author']),
            mysqli_real_escape_string($mysqli, $_POST['date_text']), mysqli_real_escape_string($mysqli, $_POST['folio_contents']), mysqli_real_escape_string($mysqli, $_POST['folio_prov']), $folio_num, $side, 
            $_POST['no_of_lines'], $_POST['no_of_col'], $_POST['height'], $_POST['width'], $_POST['height_written'],
            $_POST['width_written'], mysqli_real_escape_string($mysqli, $_POST['quire_sign']), mysqli_real_escape_string($mysqli, $_POST['catchwords']), mysqli_real_escape_string($mysqli, $_POST['neumes']), $_POST['staves_per_page'], 
            $_POST['lines_per_staff'], $_POST['dim_staff'], mysqli_real_escape_string($mysqli, $_POST['col_staff']), mysqli_real_escape_string($mysqli, $_POST['res_ident']), mysqli_real_escape_string($mysqli, $_POST['website']), 
            mysqli_real_escape_string($mysqli, $_POST['contrib_inst']), mysqli_real_escape_string($mysqli, $_POST['rights_mgmt']), mysqli_real_escape_string($mysqli, $_POST['image_format']), mysqli_real_escape_string($mysqli, $_POST['digit_specs']), mysqli_real_escape_string($mysqli, $_POST['date_digital']), 
            mysqli_real_escape_string($mysqli, $_POST['scan_tech']), mysqli_real_escape_string($mysqli, $_POST['meta_catag']), mysqli_real_escape_string($mysqli, $_POST['coll_admin']), mysqli_real_escape_string($mysqli, $_POST['faculty_liason']), mysqli_real_escape_string($mysqli, $_POST['abreviated_shelf']),
            $_POST['no_of_lines_broken'], $_POST['ht_fol_broken'], $_POST['width_fol_broken'], $_POST['ht_written_space_broken'], $_POST['width_written_space_broken'],
            $_POST['staves_per_page_broken'], $min_ht, $max_ht, $max_width, $min_width,
            $min_ht_written, $max_ht_written, $min_width_written, $max_width_written );
    
        $mysqli->query($query);
        
        $query_loc = sprintf("INSERT INTO location_temp values (%d, '%s', '%s', '%s', '%s','%s','%s', '%s','%s');" ,
            $$mysqli->insert_id, mysqli_real_escape_string($mysqli, $_POST['state']), mysqli_real_escape_string($mysqli, $_POST['country']), mysqli_real_escape_string($mysqli, $_POST['municipality']), mysqli_real_escape_string($mysqli, $_POST['institution']), mysqli_real_escape_string($mysqli, $_POST['division']), mysqli_real_escape_string($mysqli, $_POST['collection']), mysqli_real_escape_string($mysqli, $_POST['callno']), mysqli_real_escape_string($mysqli, $_POST['series']));
        
        $mysqli->query($query_loc);
    }

    echo json_encode($msg);


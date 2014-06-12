<?php

require_once 'folio_location.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Folio{
    
       
    public $folio_id = "--";
    public $mscript_id = "--";
    public $title = "--";
    public $alt_title = "--";
    public $author = "--";
    public $abbreviated_shelf = "--";
    public $folio_location = "--";
    
    public $date_text = "--";
    public $folio_contents = "--";
    public $folio_prov = "--";
    public $folio_num = "--";
    public $folio_side = "--";
    
    public $no_of_lines = "--";
    public $no_of_cols = "--";
    public $height = "--";
    public $width = "--";
    
    public $height_written = "--";
    public $width_written = "--";
    public $quire_sign = "--";
    public $catch_words = "--";
    public $neumes = "--";
    public $staves_per_page = "--";
    public $lines_per_staff = "--";
    public $dim_staff = "--";
    
    public $col_staff = "--";
    public $res_ident = "--";
    public $website = "--";
    public $contrib_inst = "--";
    public $rights_mgmt = "--";
    public $image_format = "--";
    public $digit_specs = "--";
    public $date_digital = "--";
    
    public $scan_tech = "--";
    public $meta_catag = "--";
    public $coll_admin = "--";
    public $faculty_liason = "--";
    
    public function __construct() {
       $this->folio_location = new Location();        
    }
    
    
    
}
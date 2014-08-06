<?php

require_once 'ms_origin.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Manuscript{
    
       
    public $mlinknum = "--";
    public $mscript_id = "--";
    public $part = "--";
    public $date_manu = "--";
    public $century = "--";
    public $writing_sup = "--";
    public $text_type = "--";
    
    public $liturgical_use = "--";
    public $folio_contents = "--";
    public $subject_lcsh = "--";
    public $folio_num = "--";
    public $language = "--";
    
    public $ruling_med = "--";
    public $collation = "--";
    public $decoration = "--";
    public $miniatures = "--";
    
    public $text_contents = "--";
    public $history = "--";
    public $schoen_num = "--";
    public $script = "--";
    public $scribe = "--";
    public $artist = "--";
    public $no_of_fol = "--";
    public $no_of_avail_fol = "--";
    
    public $edition_cited = "--";
    public $biblio = "--";
    public $pub_digital = "--";
    
    public $min_lines = '--';
    public $max_lines = '--';
    
    public $origin = '--';
    
    public $folio_objs = array();
    
    public function __construct($mscript_id) {
        $this->mscript_id = $mscript_id;
        $this->origin = new MSOrigin($mscript_id);
    }
    
    
    
}
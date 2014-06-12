<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MSOrigin{
    
    public $mscript_id = '--';
    public $state = '--';
    public $country = '--';
    public $municipality = '--';
    public $institution = '--';       
    public $region = '--';    
    public $commagent = '--';
    
    
    public function __construct($mscript_id) { 
        $this->mscript_id = $mscript_id;
    }
    
    
    
}
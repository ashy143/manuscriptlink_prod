<?php
include_once 'dbconnect.php';
require_once dirname(__FILE__).'./../data_models/folio.php';
require_once dirname(__FILE__).'./../data_models/manuscript.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function login($email, $password){
    //Use of prepared statements to login
        global $mysqli;
        $statement = $mysqli->prepare('SELECT user_id, email, name FROM users where email = ? and password = ?' );
        $statement->bind_param('ss',$email,$password);
        $statement->execute();
        $statement->store_result();
        
        //getting variables from the result
        $statement->bind_result($userid, $email, $name);
        $statement->fetch();
        
        if($statement->num_rows == 1){       
            $_SESSION['name'] = $name;            
            $_SESSION['username'] = $email;
            $_SESSION['user_id'] = $userid;
            $statement->close();
            //header("location: user.php");
            return true;
        }else{
            //$error="Invalid username or password";        
            //header("location: ../index.php?login_error=".$error);
            $statement->close();
            return false;
        }
}

function login_check(){
    //TODO: check with password
    if(isset($_SESSION['name'],$_SESSION['username'])){
        //User already logged in
        return true;
    }else {
        //Not logged in
        return false;
    }
}

function register($name, $email, $pass){
    global $mysqli;
    $statement = $mysqli->prepare('INSERT into users (email, name, password) values (?, ?, ?)' );
    $statement->bind_param('sss',$email,$name, $pass);
    $statement->execute();
    
    if($statement->affected_rows == 1){
        $id = $statement->insert_id;
        $statement->close();
        return $id;
    }else{
        //$error="Invalid username or password";        
        //header("location: ../index.php?login_error=".$error);
        $statement->close();
        return false;
    }
    
}

function execute_select($query){
    global $mysqli;
    $mysqli_stmt = $mysqli->prepare($query);
    $mysqli_stmt->execute(); 
    $mysqli_stmt->bind_result($folio_id, $mscript_id, $title, $abbrv_shelf, $folio_num, $folio_side);
    
    $objects = array();
    while($mysqli_stmt->fetch()){
        $folio = new Folio();
        $folio->folio_id = $folio_id;
        $folio->mscript_id = $mscript_id;
        $folio->title = $title;
        $folio->abbreviated_shelf = $abbrv_shelf;
        $folio->folio_num = $folio_num;
        $folio->folio_side = $folio_side;
                
        $objects[] = $folio;
    }    
    return $objects;
}

function getManuscriptById($manuscriptId){
    global $mysqli;
    $query = "SELECT * "
            . "FROM manuscript LEFT JOIN origin ON manuscript.mscript_id = origin.mscript_id " 
            . "WHERE manuscript.mscript_id = ". $manuscriptId ;
    
    $sql_minlines = "SELECT MIN(no_of_lines) as min from folios WHERE folios.mscript_id=".$manuscriptId;
    $sql_maxlines = "SELECT MAX(no_of_lines) as max from folios WHERE folios.mscript_id=".$manuscriptId;
    
    $result_min = $mysqli->query($sql_minlines) or die(mysql_error());
    $result_max = $mysqli->query($sql_maxlines) or die(mysql_error());

    $row_min = $result_min->fetch_assoc();
    $row_max =$result_max->fetch_assoc();
    
    $min = $row_min['min'];
    $max = $row_max['max'];
    
    
    $result = $mysqli->query($query) or die(mysql_error());
    $manuscript_obj = NULL;
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $manuscript_obj = new Manuscript($row['mscript_id']);
        $manuscript_obj->mlinknum = $row['mlinknumber'];
        $manuscript_obj->part = $row['part'];
        $manuscript_obj->artist = $row['artist'];   //row col from db
        $manuscript_obj->text_type = $row['text_type']; 
        $manuscript_obj->date_manu = $row['date_manuscript'];
        $manuscript_obj->script = $row['script'];
        $manuscript_obj->scribe = $row['scribe'];
        $manuscript_obj->biblio = $row['bibliography'];
        $manuscript_obj->decoration = $row['decoration'];
        $manuscript_obj->script = $row['script'];
        $manuscript_obj->collation = $row['collation'];
        $manuscript_obj->no_of_avail_fol = $row['numof_avail_folios'];
        $manuscript_obj->language = $row['language'];
        $manuscript_obj->liturgical_use = $row['liturgicaluse'];
        $manuscript_obj->ruling_med = $row['ruling_medium'];
        $manuscript_obj->miniatures = $row['miniatures'];
        $manuscript_obj->schoen_num = $row['schoenberg_num'];
        $manuscript_obj->history = $row['history'];
        $manuscript_obj->writing_sup = $row['writing_support'];
        $manuscript_obj->edition_cited = $row['edition_cited'];
        
        $manuscript_obj->min_lines = $min;
        $manuscript_obj->max_lines = $max;
        
        $manuscript_obj->origin->country = $row['country'];
        $manuscript_obj->origin->municipality = $row['municipality'];
        $manuscript_obj->origin->region = $row['region'];
        $manuscript_obj->origin->commagent = $row['commagent'];
        $manuscript_obj->origin->institution = $row['institution'];
        $manuscript_obj->origin->state = $row['state'];
    }
    
    return $manuscript_obj;
    
}

function getFoliosByManuscriptId($manuscript_id){
    global $mysqli;
    $query = "SELECT *"
            . "FROM folios "   
            . " LEFT JOIN location ON folios.folio_id = location.folio_id " 
            . "WHERE folios.mscript_id = " . $manuscript_id . " ORDER BY folio_num ASC " ;
    $result = $mysqli->query($query);
    $folio_objs = array();
    if($result->num_rows > 0) {        
        while($row =$result->fetch_assoc()){
            $folio = new Folio();
            $folio->folio_id = $row['folio_id'];
            $folio->mscript_id = $row['mscript_id'];
            $folio->title = $row['title'];
            $folio->abbreviated_shelf = $row['abreviated_shelf'];
            $folio->folio_num = $row['folio_num'];
            $folio->folio_side = $row['folio_side'];
            $folio->folio_location->state = $row['state'];
            $folio->folio_location->municipality = $row['municipality'];
            $folio->res_ident = $row['res_ident'];
            

            $folio_objs[] = $folio;
        } 
    }
    return $folio_objs;
        
}

function getFolioById($folio_id){
    global $mysqli;
    $query = "SELECT *"
            . "FROM folios " 
            . "WHERE folios.folio_id = " . $folio_id ;
    $result = $mysqli->query($query);
    $folio = new Folio();
    if($result->num_rows > 0) {        
        $row =$result->fetch_assoc();
        
        $folio->folio_id = $row['folio_id'];
        $folio->mscript_id = $row['mscript_id'];
        $folio->title = $row['title'];
        $folio->abbreviated_shelf = $row['abreviated_shelf'];
        $folio->folio_num = $row['folio_num'];
        $folio->folio_side = $row['folio_side'];
        $folio->folio_location->state = $row['state'];
        $folio->folio_location->municipality = $row['municipality'];
        $folio->res_ident = $row['res_ident'];
    }
    return $folio;
}
        

function getJuxtaImagesForLoggedInUser(){
    global $mysqli;
    $user_id = $_SESSION['user_id'];    
    $query = 'SELECT arc.folio_id, fol.abreviated_shelf, fol.mscript_id, fol.folio_num, fol.folio_side, fol.res_ident FROM archives As arc INNER JOIN folios As fol ON arc.folio_id = fol.folio_id '
            .' where arc.user_id = ' .$user_id .' and arc.archive_juxta = "JUXTA" ' ;
    $result = $mysqli->query($query) or die(mysql_errno());
    $folio_objs = array();
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
             
            $folio = new Folio();
            $folio->folio_id = $row['folio_id'];
            $folio->mscript_id = $row['mscript_id'];
            $folio->abbreviated_shelf = $row['abreviated_shelf'];
            $folio->folio_num = $row['folio_num'];
            $folio->folio_side = $row['folio_side'];
            $folio->res_ident = $row['res_ident'];
            $folio_objs[] = $folio;
        }
    }    
    return $folio_objs;
}

function getJuxtaImagesForFolios($folio_ids){
    global $mysqli;
    $user_id = $_SESSION['user_id'];    
    $query = 'SELECT arc.folio_id, fol.abreviated_shelf, fol.mscript_id, fol.folio_num, fol.folio_side, fol.res_ident FROM archives As arc INNER JOIN folios As fol ON arc.folio_id = fol.folio_id '
            .' where arc.user_id = ' .$user_id .' and arc.archive_juxta = "JUXTA" and arc.folio_id in ('. $folio_ids .')' ;
    error_log($query);
    $result = $mysqli->query($query) or die(mysql_errno());
    $folio_objs = array();
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
             
            $folio = new Folio();
            $folio->folio_id = $row['folio_id'];
            $folio->mscript_id = $row['mscript_id'];
            $folio->abbreviated_shelf = $row['abreviated_shelf'];
            $folio->folio_num = $row['folio_num'];
            $folio->folio_side = $row['folio_side'];
            $folio->res_ident = $row['res_ident'];
            $folio_objs[] = $folio;
        }
    }    
    return $folio_objs;
}

function getArchivedImagesForLoggedInUser(){
    global $mysqli;
    $user_id = $_SESSION['user_id'];    
    $query = 'SELECT arc.folio_id, fol.abreviated_shelf, fol.mscript_id, fol.res_ident, fol.folio_num, fol.folio_side, loc.municipality, loc.state FROM archives As arc INNER JOIN '
            .' (folios As fol INNER JOIN location AS loc ON fol.folio_id = loc.folio_id ) '
            .' ON arc.folio_id = fol.folio_id '
            .' where arc.user_id = ' .$user_id .' and arc.archive_juxta = "ARCHIVE" ' ;
    $result = $mysqli->query($query) or die(mysql_errno());
    $folio_objs = array();
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
             
            $folio = new Folio();
            $folio->folio_id = $row['folio_id'];
            $folio->abbreviated_shelf = $row['abreviated_shelf'];
            $folio->mscript_id = $row['mscript_id'];
            $folio->res_ident = $row['res_ident'];
            $folio->folio_num = $row['folio_num'];
            $folio->folio_side = $row['folio_side'];
            $folio->folio_location->municipality = $row['municipality'];
            $folio->folio_location->state = $row['state'];
            
            $folio_objs[] = $folio;
        }
    }    
    return $folio_objs;
}

function getMlinkNumberOfManuscript($manuscriptId){
    global $mysqli;

    $query = "SELECT mlinknumber "
            . "FROM manuscript WHERE manuscript.mscript_id = ". $manuscriptId ;
    $result = $mysqli->query($query) or die(mysql_errno());
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['mlinknumber'];
    }else{
        return -1;
    }
}

function getFoliosByManuscriptIdWithParts($manuscript_id){
    global $mysqli;
    $query = "SELECT * "
            . "FROM folios "   
            . " LEFT JOIN location ON folios.folio_id = location.folio_id "
            . " WHERE folios.mscript_id in ( SELECT mscript_id FROM manuscript WHERE mlinknumber =  "
            . " (SELECT mlinknumber FROM manuscript WHERE mscript_id = " . $manuscript_id . ") )"
            . " ORDER BY folio_num ASC, folio_side ASC" ;
    error_log($query);
    $result = $mysqli->query($query);
    $folio_objs = array();
    if($result->num_rows > 0) {        
        while($row =$result->fetch_assoc()){
            $folio = new Folio();
            $folio->folio_id = $row['folio_id'];
            $folio->mscript_id = $row['mscript_id'];
            $folio->title = $row['title'];
            $folio->abbreviated_shelf = $row['abreviated_shelf'];
            $folio->folio_num = $row['folio_num'];
            $folio->folio_side = $row['folio_side'];
            $folio->folio_location->state = $row['state'];
            $folio->folio_location->municipality = $row['municipality'];
            $folio->res_ident = $row['res_ident'];
            

            $folio_objs[] = $folio;
        } 
    }
    return $folio_objs;
        
}

function getMinMaxValue($range, $MINorMAX){
    $numbers =  array();
    while($range != ''){
        $currentNumber = '';
        while( is_numeric(substr($range, 0, 1)) ){
            $currentNumber = $currentNumber.substr($range, 0, 1);
            $range = substr($range, 1);         
        }
        $numbers[] = $currentNumber;
        $range = substr($range, 1);
    }
    if(count($numbers) > 0){
        if($MINorMAX == 'MIN')
            return min($numbers);
        else
            return max($numbers);
    }else{
        return 0;
    }
}    

function activateUser($userId){

    global $mysqli;
    $statement = $mysqli->prepare('UPDATE users set isactivated = TRUE where user_id = 10' );
    $statement->execute();
    
    $html_text = '';
    if($statement->affected_rows > 0){
        $html_text = "You have successfully activated your account. Please click <a href = 'index.php'>here<a> to login." ;
    }else{
        $html_text = "Failed to activate your account. Please try again." ;
    }

    return $html_text;
}





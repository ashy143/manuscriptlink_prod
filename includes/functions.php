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
        //$_SESSION['name'] = $name;            
        //$_SESSION['username'] = $email;            
        //header("location: user.php");
        $statement->close();
        return true;
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
            . "WHERE manuscript.mscript_id = " . $manuscriptId ;
    $result = $mysqli->query($query);
    $manuscript_obj = NULL;
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $manuscript_obj = new Manuscript($row['mscript_id']);
        $manuscript_obj->mlinknum = $row['mlinknumber'];
        $manuscript_obj->artist = $row['artist'];   //row col from db
        $manuscript_obj->text_type = $row['text_type']; 
        $manuscript_obj->date_manu = $row['date_manuscript'];
        
        $manuscript_obj->scribe = $row['scribe'];
        $manuscript_obj->biblio = $row['bibliography'];
        $manuscript_obj->decoration = $row['decoration'];
        $manuscript_obj->script = $row['script'];
        $manuscript_obj->collation = $row['collation'];
        $manuscript_obj->no_of_avail_fol = $row['numof_avail_folios'];
        
        $manuscript_obj->origin->country = $row['country'];
        $manuscript_obj->origin->municipality = $row['municipality'];
    }
    
    return $manuscript_obj;
    
}

function getFoliosByManuscriptId($manuscript_id){
    global $mysqli;
    $query = "SELECT *"
            . "FROM folios "   
            . " LEFT JOIN location ON folios.folio_id = location.folio_id " 
            . "WHERE folios.mscript_id = " . $manuscript_id ;
    
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

function getManuscriptByFolioId(){
    
}




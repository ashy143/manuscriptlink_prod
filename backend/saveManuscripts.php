<?php
/* 
 * This script saves the manuscript details into temporary db named manuscript_temp (whenever user edits or adds new)
 * This list will be displayed in unpublished list with an option for admin to view and commit
 * When user commits this will be added/replaced into manuscript table and the entry is deleted from temp table

    


 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../includes/functions.php';
include_once '../includes/dbconnect.php';

session_start();
if(login_check() == false){
    header("location: ./index.php");
}

$user_check = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

class Msg{
    public $statusNum = 200;
    public $statusMsg = "Ok";
}
$msg = new Msg();

$mlink_part = $_GET['mlinkno'] . '.' . $_GET['part'];

//Same query will be used both for edit/add. We will be using some paramenters passed through request to identify if its edit or add
//The order of fields can be viewed from table schema (used phpmyadmin's table structure)
$query = sprintf("INSERT INTO manuscript_temp values 
        (%d, %d, '%s', '%s', '%s', 
        '%s', '%s', '%s', '%s', '%s', 
        '%s', '%s',' %s', '%s', '%s', 
        '%s', '%s', '%s',  %d,  %d, 
        '%s', '%s', '%s', '%s', '%s', 
        '%s', '%s', %d);",
        NULL, $_GET['mlinkno'], $_GET['part'], mysqli_real_escape_string($mysqli, $_GET['dateMS']) ,mysqli_real_escape_string($mysqli, $_GET['century']),
        mysqli_real_escape_string($mysqli, $_GET['writing_sup']), mysqli_real_escape_string($mysqli, $_GET['text_type']), mysqli_real_escape_string($mysqli, $_GET['liturgical']), mysqli_real_escape_string($mysqli, $_GET['subj_lcsh']), mysqli_real_escape_string($mysqli, $_GET['lang']),
        mysqli_real_escape_string($mysqli, $_GET['rule_med']), mysqli_real_escape_string($mysqli, $_GET['rule_pat']), mysqli_real_escape_string($mysqli, $_GET['collation']), mysqli_real_escape_string($mysqli, $_GET['deco']), mysqli_real_escape_string($mysqli, $_GET['miniatures']),
        mysqli_real_escape_string($mysqli, $_GET['text_cont']), mysqli_real_escape_string($mysqli, $_GET['history']), mysqli_real_escape_string($mysqli, $_GET['schoenberg']), $_GET['script'], $_GET['scribe'],
        mysqli_real_escape_string($mysqli, $_GET['artist']), mysqli_real_escape_string($mysqli, $_GET['no_of_folios']), mysqli_real_escape_string($mysqli, $_GET['avail_folios']), mysqli_real_escape_string($mysqli, $_GET['cited']), mysqli_real_escape_string($mysqli, $_GET['biblio']),
        mysqli_real_escape_string($mysqli, $_GET['pub_digital']), mysqli_real_escape_string($mysqli, $mlink_part), $_GET['ref_mscript_id']);

        //echo $query;
        if(!$mysqli->query($query)){
            if ( $mysqli->errno == 1062) {
                error_log($mysqli->errno);
                $msg->statusNum = 201;    
                $msg->statusMsg = "Manuscript with given manuscript link and part already set for edit by some one.";
            }
        }else{
            //The id generated from above insert will be used as primary key for origin table's row
            $query_loc = sprintf("INSERT INTO origin_temp values (%d, '%s', '%s', '%s', '%s','%s','%s');" ,$mysqli->insert_id, mysqli_real_escape_string($mysqli, $_GET['country']),mysqli_real_escape_string($mysqli, $_GET['state']), mysqli_real_escape_string($mysqli, $_GET['region']), mysqli_real_escape_string($mysqli, $_GET['municipality']), mysqli_real_escape_string($mysqli, $_GET['institution']), mysqli_real_escape_string($mysqli, $_GET['comm_agent']));

            //echo $query_loc;
            $mysqli->query($query_loc);
        }



//Return the status message
echo json_encode($msg);


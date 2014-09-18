<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once './includes/functions.php';
include_once './includes/dbconnect.php';

session_start();
if(login_check() == false){
    header("location: ./index.php");
}

$user_check = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$folio_id = $_GET['folio_id'];
$is_juxta = $_GET['is_juxta'];

$archiveORjuxta = "ARCHIVE"; //to check if action is for archive or juxtapose.
if($is_juxta==='true'){
    $archiveORjuxta = "JUXTA";
}
$PAGE_EXISTS_ARCHIVE_MSG = "Folio already added to archives";
$PAGE_EXISTS_JUXTAPOSE_MSG = "Folio already added for comparing";

class Msg{
    //set statusNum to 201 for existing page in archives
    public $statusNum = 200;
    public $statusMsg = "Ok";
}
$msg = new Msg();

//$con = mysql_connect(HOST.':'.PORT, USER, PASSWORD) or die("Unable to connect to MySQL");
//mysql_select_db(DATABASE, $con) or die("Could not select" .mysql_error());

if( strpos($folio_id  , ',') === false ){
    $page_result_exists = $mysqli->query("SELECT folio_id from  archives WHERE folio_id=$folio_id AND user_id=$user_id AND archive_juxta='".$archiveORjuxta."'");
    if(!$page_result_exists){
        //TODO: Return error message on select query
        $msg->statusNum = 201;    
        $msg->statusMsg = mysql_error();
    }else{        
    //    $count = mysql_num_rows($page_result_exists);
        if($page_result_exists->num_rows > 0){
            $msg->statusNum = 201;    
            $msg->statusMsg = $PAGE_EXISTS_ARCHIVE_MSG;
            if($is_juxta==='true'){
                $msg->statusMsg = $PAGE_EXISTS_JUXTAPOSE_MSG;
            }
        }else{        
            $sql_query_result = $mysqli->query("INSERT INTO archives (folio_id, user_id, archive_juxta) values ($folio_id, $user_id, '$archiveORjuxta')");
            if(!$sql_query_result){        
                $msg->statusNum = 201;    
                $msg->statusMsg = "Failed to update database".mysql_error();
            }else{
                $msg->statusMsg = "Folio successfully added to your archives";
                if($is_juxta==='true'){
                    $msg->statusMsg = "Folio successfully added for juxtaposing";
                }
                $msg->statusNum = 200;
            }
        }
    }
}else{
    try{
        $mysqli->begin_transaction();
        //The query below should be executed only when you want to delete all the folios and replace with new one.
        //TODO: Need to put a logic to bypass this code when you only want to add folios to archives/juxta and not replacing
        $mysqli->query("DELETE from  archives WHERE user_id = $user_id AND archive_juxta = '$archiveORjuxta' ");
        $folioIds = explode(',', $folio_id);
        foreach ($folioIds as $folId ) {
            $sql_query_result = $mysqli->query("INSERT INTO archives (folio_id, user_id, archive_juxta) values ($folId, $user_id, '$archiveORjuxta')");
        }
        $msg->statusMsg = "Folios successfully added to your archives";
        if($is_juxta==='true'){
            $msg->statusMsg = "Folios successfully added for juxtaposing";
        }
        $msg->statusNum = 200;
        $mysqli->commit();
    }catch(Exception $e){
        error_log($e);
        $mysqli->rollback();
        $msg->statusNum = 201;    
        $msg->statusMsg = "Failed to update database".mysql_error();
    }
}
//Return the status message
echo json_encode($msg);


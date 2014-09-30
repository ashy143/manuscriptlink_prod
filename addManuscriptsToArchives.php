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
$ms_ids = $_GET['mscript_ids'];

$archiveORjuxta = "ARCHIVE"; //to check if action is for archive or juxtapose.

class Msg{
    //set statusNum to 201 for existing page in archives
    public $statusNum = 200;
    public $statusMsg = "Ok";
}
$msg = new Msg();

//$con = mysql_connect(HOST.':'.PORT, USER, PASSWORD) or die("Unable to connect to MySQL");
//mysql_select_db(DATABASE, $con) or die("Could not select" .mysql_error());

try{
    $mysqli->begin_transaction();
    //The query below should be executed only when you want to delete all the folios and replace with new one.
    //TODO: Need to put a logic to bypass this code when you only want to add folios to archives/juxta and not replacing
    $query = "SELECT folio_id FROM folios WHERE mscript_id IN ($ms_ids) " ;
    $sql_query_result = $mysqli->query($query);
    $query_value_part = array();
    if($sql_query_result->num_rows > 0) {        
        while($row =$sql_query_result->fetch_assoc()){
            $folioId = $row['folio_id'];
            $query_value_part[] = "( $folioId, $user_id, 'ARCHIVE' )" ;
        } 
    }
    $values = implode(',', $query_value_part);
    $folio_insert_query = "REPLACE INTO archives (folio_id, user_id, archive_juxta) values  $values ";
    $sql_query_result = $mysqli->query( $folio_insert_query);
    $msg->statusMsg = "Folios successfully added to your archives";
    $msg->statusNum = 200;
    $mysqli->commit();
}catch(Exception $e){
    error_log($e->getMessage());
    $mysqli->rollback();
    $msg->statusNum = 201;    
    $msg->statusMsg = "Failed to update database".mysql_error();
}
//Return the status message

echo json_encode($msg);


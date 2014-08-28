<?php 
	
	include_once './includes/functions.php';
	include_once './includes/dbconnect.php';

	session_start();
	if(login_check() == false){
	    header("location: ./index.php");
	}

	
	$PAGE_EXISTS_JUXTAPOSE_MSG = "Error removing folio from bookshelf";
	class Msg{
	    //set statusNum to 201 for existing page in archives
	    public $statusNum = 200;
	    public $statusMsg = "Ok";
	}
	$msg = new Msg();

	$user_check = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];
	$folio_id = $_GET['folio_id'];

	$deleteFolio = $mysqli->query("DELETE from  archives WHERE folio_id = $folio_id AND user_id = $user_id AND archive_juxta = 'JUXTA' ");
	// if ($mysqli->mysql_affected_rows() < 1 ){
	// 	$msg->statusNum = 201;    
 //        $msg->statusMsg = "Error removing folio from bookshelf. Please try again";
	// }
	echo json_encode($msg); 
?>
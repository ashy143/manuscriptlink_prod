<?php 
	
	include_once './includes/functions.php';
	include_once './includes/dbconnect.php';

	session_start();
	if(login_check() == false){
	    header("location: ./index.php");
	}

	class Msg{
	    //set statusNum to 201 for error deleting archives
	    public $statusNum = 200;
	    public $statusMsg = "Ok";
	}
	$msg = new Msg();

	$user_check = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];

	try{
		$mysqli->query("DELETE from  archives WHERE user_id = $user_id AND archive_juxta = 'ARCHIVE' ") ;
		$msg->statusMsg = 'Archives cleared successfully';
	}catch(Exception $e){
		$msg->statusNum = 201;
		$msg->statusMsg = $e->getMessage();
	}
	echo json_encode($msg); 
?>
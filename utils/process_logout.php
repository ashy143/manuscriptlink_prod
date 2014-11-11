<?php

	include_once '../includes/config.php';

	session_start();
	$userId = $_SESSION['user_id'];
	$con = mysql_connect(HOST.':'.PORT, USER, PASSWORD) or die("Unable to connect to MySQL");
    mysql_select_db(DATABASE, $con) or die("Could not select" .mysql_error()); 
	if(session_destroy()){

		//Delete user search query from db if exists
		$query = "DELETE FROM user_search_query WHERE user_id = ". $userId;
		mysql_query($query);
		header("Location: ../index.php");
	}

?>
<?php
	//Start session
	
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
		header("location: index.php?err=Please Login To Continue!");
		exit();
	}else{
		$_SESSION['id'] = $_SESSION['SESS_MEMBER_ID'];
			$_SESSION['SESS_NAME'];
			$_SESSION['SESS_EMAIL'];
			$_SESSION['SESS_PHONE'];
			
	}
	
?>
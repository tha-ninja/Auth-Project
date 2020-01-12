<?php
	//Start session
include'config/dbcon.php';
	session_start();
	
	//Array to store validation errors
	
	//Sanitize the POST values
	$login = ($_POST['username']);
	$password = ($_POST['password']);
	
	//Input Validations
	if($login == '') {
		$errmsg_arr = 'Username missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if(isset($errflag)) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php?error=$errmsg_arr");
		exit();
	}
	
	//Create query
	$salt = "d9b8d2eff08d2c803d2ef817400a3d59";
  $pass = md5($password . $salt);
	//Create query
	$query = $conn->prepare("SELECT * FROM user WHERE phone =  ? OR email = ? AND password = ? AND status = ?");
		$query->execute(array($login,$login,$pass,1));
		$count = $query->rowcount();
		$row = $query->fetch();		
	
	//Check whether the query was successful or not
	if($count > 0){
		
			//Login Successful
		//setcookie(loggedin, date("F jS - g:i a"), $seconds);
			session_regenerate_id();
			//$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $row['user_id'];
			$_SESSION['SESS_NAME'] = $row['username'];
			$_SESSION['SESS_PHONE'] = $member['phone'];
			$_SESSION['SESS_EMAIL'] = $member['email'];
			
			session_write_close();
			

		header("location: home.php?status=Welcome");
			exit();
		 }else {
          header("location: index.php?error=Failed! Invalid Credentials!!!");
			exit();  
     } 
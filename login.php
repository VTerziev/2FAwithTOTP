<?php

	session_start();
	session_regenerate_id(true);
	
	DEFINE ("PEPPER","kflds$#@fdsfdsgfdsgHFGDs");

	if(isset($_POST['user']) && isset($_POST['pass'])){		
		$user = $_POST['user'];
		$pass = $_POST['pass'];
	}
	else{
		header("Location: index.php");
		exit;
	}
	
	$link = mysqli_connect("localhost", "osup", "apwuniopejrfpaw", "osup");
	if(!$link){
		echo 'Database maintenance';
		exit;
	}
	$sql = 'SELECT id, pass, 2fa FROM users
			WHERE user="'.$user.'"';
	
	$result = @mysqli_query($link, $sql);
	if(!$result){
		echo 'Database maintenance';
		exit; 
	}

	$row = @mysqli_fetch_assoc($result);

	if(!isset($row['id']) || !password_verify($pass.PEPPER, $row['pass'])){
		echo 'Invalid username OR password';		
		exit;
	}

	if ($row['2fa']) {
		$_SESSION['1factor_authenticated_id'] = $row['id'];
		$_SESSION['1factor_authenticated'] = true;
		header("Location: 2factor_login.php");			
	} else {		
		$_SESSION['uid'] = $row['id'];
		header("Location: securearea.php");
	}
?>

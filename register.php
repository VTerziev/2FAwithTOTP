<!DOCTYPE html>
<html lang="bg-BG">
<head>
<meta charset="utf-8" />
</head>
<body>
<?php
	DEFINE ("PEPPER","kflds$#@fdsfdsgfdsgHFGDs");
	
	if(!isset($_POST['user'])
		|| !isset($_POST['pass1'])
		|| !isset($_POST['pass2'])){
		goto form;	
	}
	if(strlen($_POST['user'])<4 || strlen($_POST['user'])>32){
		echo 'Username must be between 4 and 32 symbols';
		goto form;
	}
	if($_POST['pass1'] != $_POST['pass2']){
		echo 'The given passwords do not match';
		goto form;
	}

	$user = $_POST['user'];
	
	$pass = password_hash($_POST['pass1'].PEPPER, PASSWORD_DEFAULT, ['memory_cost' => 3907, 'time_cost'=>150, 'threads'=>1]);
	
	$link = mysqli_connect("localhost", "osup", "apwuniopejrfpaw", "osup");

	$sql = 'INSERT INTO users(user, pass, 2fa, shared_key) VALUES
			("'.$user.'", "'.$pass.'",'."false".',"")';
	
	$result = mysqli_query($link, $sql);
	if(!$result){
		echo 'User already exists';
		goto form;
	}
	echo 'Registration successful! ';
	goto loginlink;

?>
<?php form: ?><h1>Register</h1>
<form action="register.php" method="POST">
	Username: <input type="text" name="user" /><br />
	Password: <input type="password" name="pass1" /><br />
	Repeat password: <input type="password" name="pass2" /><br />
	<input type="submit" name="submit" value="Register" /><br />
</form>
<?php loginlink: ?><a href="index.php">Enter</a>
</body>
</html>
<?php
	session_start();
	session_regenerate_id(true);
?><!DOCTYPE html>
<html lang="bg-BG">
<head>
<meta charset="utf-8" />
</head>
<body>
<h1>Enter</h1>
<form action="login.php" method="POST">
	Username: <input type="text" name="user" /><br />
	Password: <input type="password" name="pass" /><br />
	<input type="submit" name="submit" value="Enter" /><br />
</form>
<a href="register.php">Not registered?</a>
</body>
</html>
<?php
	session_start();
	session_regenerate_id(true);
	if(!isset($_SESSION['uid'])){
		header("Location: index.php");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="bg-BG">
<head>
<meta charset="utf-8" />
<link href="./includes/styles.css" rel="stylesheet" media="all" type="text/css" />
</head>
<body>
<header>
<h1>Hello <?=$_SESSION['uid']?></h1>
</header>
<nav>
<a href="securearea.php">Start</a> | 
<a href="profile.php">Profile</a> | 
<a href="2factor_config.php">2FA</a> | 
<a href="logout.php">Logout</a>
</nav>
<article>
	
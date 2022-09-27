<!DOCTYPE html>
<head>
<meta charset="utf-8" />
</head>
<body>
<?php
	require("../util/encryption.php");

	if(!isset($_POST['app']) || !isset($_POST['shared_key'])){
		goto form;	
	}

	$app = $_POST['app'];
	$encrypted_shared_key = bin2hex(encrypt($_POST['shared_key']));

	$link = mysqli_connect("localhost", "osup", "apwuniopejrfpaw", "osup");

	$sql = 'INSERT INTO apps(name, shared_key) VALUES
			("'.$app.'", "'.$encrypted_shared_key.'")';
	
	$result = mysqli_query($link, $sql);

	// Update the key if the app exists
	if(!$result){
		$link = mysqli_connect("localhost", "osup", "apwuniopejrfpaw", "osup");
		$sql = 'UPDATE apps SET shared_key="'.$encrypted_shared_key.'" WHERE name="'.$app.'"';
		$result = mysqli_query($link, $sql);
	
		if(!$result){
			echo "Something went wrong";
			goto form;
		}
		echo 'Key is saved successfully! ';
		goto totplink;		
	}
	echo 'Key is saved successfully! ';
	goto totplink;

?>
<?php form: ?><h1>Add Key</h1>
<form action="add_key.php" method="POST">
	App: <input type="text" name="app" /><br />
	Key: <input type="text" name="shared_key" /><br />
	<input type="submit" name="submit" value="Submit" /><br />
</form>
<?php totplink: ?><a href="index.php">TOTPs</a>
</body>
</html>
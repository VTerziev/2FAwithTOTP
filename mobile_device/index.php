<!DOCTYPE html>
<html lang="bg-BG">
<head>
<meta charset="utf-8" />
</head>
<body>
<h1>TOTPs</h1>
<?php
	require("../util/totp_utils.php");
	require("../util/encryption.php");

	$link = mysqli_connect("localhost", "osup", "apwuniopejrfpaw", "osup");

	if(!$link){
		echo "Database maintenance";
		exit;
	}
	
	$sql = "SELECT name, shared_key FROM apps ORDER BY id";
	$result = @mysqli_query($link, $sql);

	$has_keys = false;
	while($row = @mysqli_fetch_assoc($result)){
		$has_keys = true;
		$shared_key = decrypt(hex2bin($row['shared_key']));
		$totp = generateTOTPForNow($shared_key);

		echo "<p><b>".$row['name']."</b> -> <b>".$totp."</b></p>";
	}

	if (!$has_keys) {
		echo "There are no existing keys!<br>";
	}

?>

<a href="index.php">Refresh</a> <br>
<a href="add_key.php">Add New Key</a>

</body>
</html>
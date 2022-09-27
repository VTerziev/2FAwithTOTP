<?php
require("./includes/header.php");
require("./util/encryption.php");
?>
<p>
<?php
	
	// Activate/deactivate 2FA
	if (isset($_POST['2fa'])) {
		$link = mysqli_connect("localhost", "osup", "apwuniopejrfpaw", "osup");
		if(!$link){
			echo "Database maintenance";
			exit;
		}
		$shared_key = bin2hex(openssl_random_pseudo_bytes(10));

		$encrypted_shared_key = bin2hex(encrypt($shared_key));
		$sql = "UPDATE users SET 2fa=!2fa, shared_key='".$encrypted_shared_key."' WHERE id=".$_SESSION['uid'];

		@mysqli_query($link, $sql);
	}


	$link = mysqli_connect("localhost", "osup", "apwuniopejrfpaw", "osup");
	if(!$link){
		echo "Database maintenance";
		exit;
	}
	
	$sql = "SELECT user, 2fa, shared_key FROM users WHERE id=".$_SESSION['uid'];
	$result = @mysqli_query($link, $sql);
	$row = @mysqli_fetch_assoc($result);
	
	$using_2fa = $row['2fa'];
	if ($row['shared_key'] != "") {
		$shared_key = decrypt(hex2bin($row['shared_key']));
	}
	if (!$using_2fa) {
		echo "Now NOT using 2FA<br>";
	} else {
		echo "Now using 2FA<br>";
	}

?>
</p>

<form action="2factor_config.php" method="POST">
<input type="submit" name="2fa" value=<?php 
	if (!$using_2fa) {
		echo "Turn on";
	} else {
		echo "Turn off";
	}
 ?> /><br /><br />
</form>

<?php

	if ($using_2fa) {
		echo "<h2>Shared key is: ".$shared_key."</h2>";
	}

?>

<?php
require("./includes/footer.php");
?>
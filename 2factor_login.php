<?php
    require("./util/totp_utils.php");
    require("./util/encryption.php");

	session_start();
	session_regenerate_id(true);
	
	DEFINE ("PEPPER","kflds$#@fdsfdsgfdsgHFGDs");

    if(!isset($_SESSION['1factor_authenticated']) || $_SESSION['1factor_authenticated'] == false){
		header("Location: index.php");
		exit;
	}
    
	if(isset($_POST['totp'])){	
        $totp = $_POST['totp'];
        $user_id = $_SESSION['1factor_authenticated_id'];
    }
	else{
        goto form;
		exit;
	}
	
	$link = mysqli_connect("localhost", "osup", "apwuniopejrfpaw", "osup");
    
    if(!$link){
		echo 'Database maintenance';
		exit;
	}
	$sql = 'SELECT id, 2fa, shared_key FROM users
			WHERE id="'.$user_id.'"';
	
	$result = @mysqli_query($link, $sql);
	if(!$result){
		echo 'Database maintenance';
		exit; 
	}

	$row = @mysqli_fetch_assoc($result);
    $shared_key = decrypt(hex2bin($row['shared_key']));
    $expected_totps = generateCurrentlyValidTOTPS($shared_key);

	if(!isset($row['2fa']) || $row['2fa'] == false || !in_array($totp, $expected_totps)){
		echo 'Token not valid';	
		exit;
	}

	$_SESSION['uid'] = $row['id'];
	header("Location: securearea.php");
?>

<!DOCTYPE html>
<html lang="bg-BG">
<head>
<meta charset="utf-8" />
</head>
<body>
<?php form: ?><h1>Enter TOTP</h1>
<form action="2factor_login.php" method="POST">
	TOTP: <input type="text" name="totp" /><br />
	<input type="submit" name="submit" value="Submit" /><br />
</form>
</body>
</html>
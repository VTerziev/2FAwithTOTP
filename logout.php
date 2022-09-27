<?php
require("./includes/header.php");
?>
<?php
	session_destroy();
	header("Location: index.php");
?>
<?php
require("./includes/footer.php");
?>
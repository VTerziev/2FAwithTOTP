<?php
require("./includes/header.php");
?>
<p>
<?php

	$link = mysqli_connect("localhost", "osup", "apwuniopejrfpaw", "osup");

	if(!$link){
		echo "Database maintenance";
		exit;
	}
	
	$sql = "SELECT user FROM users ORDER BY user";
	$result = @mysqli_query($link, $sql);
	while($row = @mysqli_fetch_assoc($result)){
		echo "<a href='profile.php?user=".$row['user']."'>".$row['user']."</a><br />";
	}
?>
</p>
<p id="profilearea"></p>
<script>
var currentSearch = document.location.search;
var searchParams = new URLSearchParams(currentSearch);
var username = searchParams.get('user');
if(username != null){
	document.getElementById('profilearea').innerHTML = 'Профилът на '+username+'<br /><br />...';
}
</script>
<?php
require("./includes/footer.php");
?>
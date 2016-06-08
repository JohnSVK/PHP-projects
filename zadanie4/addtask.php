<?php
	include "config.php";
	
	if($_POST['owner'] && $_POST['priority'] && $_POST['text']) {
		
		$owner = $_POST["owner"];
		$priority = $_POST["priority"];
		$text = $_POST["text"];
			
		$myquery = "INSERT INTO tasks (owner, priority, text) VALUES ('$owner', '$priority', '$text')";
		$myresult = $mysqli->query($myquery);
		
		echo "Halooooooo";
	}
	
	//echo "Halo ";
?>
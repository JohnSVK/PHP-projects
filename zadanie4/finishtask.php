<?php
	include "config.php";
	
	if($_POST['id'] && $_POST["name"]) {
		
		$id = $_POST["id"];
		$name = $_POST["name"];
		
		$myquery = "UPDATE tasks SET finished_by='$name', finished_at=CURRENT_TIMESTAMP WHERE id='$id'";
		$myresult = $mysqli->query($myquery);
		
		echo "Halooooooo";
	}
	
	//echo "Halo ";
?>
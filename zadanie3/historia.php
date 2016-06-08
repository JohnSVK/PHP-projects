<?php
session_start();
if(!isset($_SESSION['google_data']) && !isset($_SESSION['login'])):header("Location:index.php");endif;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>História</title>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<div class="center">
			<h1>História prihlásení</h1>
		
<?php
	include "config.php";
	
	if($_SESSION['google_data']) {
		$login = $_SESSION['google_data']['given_name'];
	} else {
		$login = $_SESSION['login'];
	}
	// historia puzivatela
	$myquery = "SELECT * FROM history WHERE login='$login'";
	$myresult = $mysqli->query($myquery);
	
	echo "<br>História prihlásení pre aktuálany účet:";
	while($row = $myresult->fetch_row()) {
			echo "<br>{$row[1]} {$row[2]} {$row[3]}";
	}
	
	//historia servera
	$myquery = "SELECT DISTINCT sposob, count(sposob) FROM history GROUP BY sposob";
	$myresult = $mysqli->query($myquery);
	
	echo "<br><br>História prihlásení celkovo:";
	while($row = $myresult->fetch_row()) {
			echo "<br>{$row[0]}: {$row[1]}";
	}
	
	echo '<br><br><a href="main.php">Späť na hlavnú stránku</a>';
	
	echo "<br><br>Prihlásený: {$login}";
	echo '<br><a href="logout.php?logout">Logout</a>';
	
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	
	//echo "halo";
?>
		
		</div>
	</body>
</html>
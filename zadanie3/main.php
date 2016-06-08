<?php
session_start();
if(!isset($_SESSION['google_data']) && !isset($_SESSION['login'])):header("Location:index.php");endif;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Hlavná stránka</title>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<div class="center">
			<h1>Hlavná stránka</h1>
		
<?php
	include "config.php";
	
	/*
	if($_SESSION['google_data']) {
		echo '<div class="welcome_txt">Welcome <b>'.$_SESSION['google_data']['given_name'].'</b></div>';
		echo '<div class="google_box">';
		echo '<p class="image"><img src="'.$_SESSION['google_data']['picture'].'" alt="" width="300" height="220"/></p>';
		echo '<p><b>Google ID : </b>' . $_SESSION['google_data']['id'].'</p>';
		echo '<p><b>Name : </b>' . $_SESSION['google_data']['name'].'</p>';
		echo '<p><b>Email : </b>' . $_SESSION['google_data']['email'].'</p>';
		echo '<p><b>Gender : </b>' . $_SESSION['google_data']['gender'].'</p>';
		echo '<p><b>Locale : </b>' . $_SESSION['google_data']['locale'].'</p>';
		echo '<p><b>Google+ Link : </b>' . $_SESSION['google_data']['link'].'</p>';
		echo '<p><b>You are login with : </b>Google</p>';
		echo '<p><b>Logout from <a href="logout.php?logout">Google</a></b></p>';
		echo '</div>';
	}*/
	
	if($_SESSION['google_data']) {
		$login = $_SESSION['google_data']['given_name'];
	} else {
		$login = $_SESSION['login'];
	}
	
	echo "{$login} vitaj na hlavnej stránke!<br>";
	
	echo '<br><a href="historia.php">Minulé prihlásenia</a><br>';
	
	echo "<br><br>Prihlásený: {$login}";
	echo '<br><a href="logout.php?logout">Logout</a>';
	
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	
	//echo "halo";
?>

		</div>
	</body>
</html>
<?php
session_start();
if(isset($_SESSION['google_data']) || isset($_SESSION['login'])):header("Location:main.php");endif;
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Prihlásenie</title>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<div class="container center">
			<div class="row">
				<h1>Prihlásenie</h1>
			
				<form name="formular" onSubmit="" action="index.php" method="post" enctype="multipart/form-data">
					<fieldset>
						<legend>Prihlasovacie údaje</legend>
						
						<div id="login">
							Login:<br>
							<input type="text" name="login" id="loginField">
						</div>
		
						<div id="pass">
							Heslo:<br>
							<input type="password" name="password" id="passField">
							<br>
						</div>
						
					</fieldset>
				
					<input type="submit" id="potvrd" value="Prihlásiť sa">
				</form>
			</div>
			<br>
				
			<div class="row">
				<a href="register.php">Vytvoriť nový účet</a><br>
				<a href="login_ldap.php">Prihlásiť sa pomocou LDAP</a><br>
				<a href="login_google.php">Prihlásiť sa cez Google Account</a><br>
			
<?php
	include "config.php";
	
	if(mysqli_connect_error()) {
		die('Connection Error (' . mysqli_connect_errno() . ' ) ' . mysqli_connect_error());
	}
	
	if($_POST["login"] && $_POST["password"]) {
		$login = $_POST["login"];
		$password = md5($_POST["password"]);

		$myquery = "SELECT login, heslo FROM users WHERE login='$login'";
		$myresult = $mysqli->query($myquery);
		
		$row = $myresult->fetch_row();
		
		if($row[0] && $row[1]) {
			if($row[1] == $password) {
				echo "PRIHLASENY";
				
				$_SESSION['login'] = $login;
				
				$myquery = "INSERT INTO history (login, cas, sposob) VALUES ('$login', now(), 'registrácia')";
				$myresult = $mysqli->query($myquery);
				
				header("Location: main.php");
				exit();
			}
		}
	}
	
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	
	//echo "halo";
?>
			</div>
		</div>
	</body>
</html>
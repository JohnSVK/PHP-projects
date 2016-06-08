<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registrácia</title>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<div class="center">
			<h1>Registrácia</h1>
		
			<form name="formular" onSubmit="" action="register.php" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Osobné údaje</legend>
					
					<div id="meno">
						Meno:<br>
						<input type="text" name="name" id="nameField">
						<br>
					</div>
					
					<div id="surname">
						Priezvisko:<br>
						<input type="text" name="surname" id="surnameField">
						<br>
					</div>
					
					<div id="email">
						Email:<br>
						<input type="text" name="email" id="emailField">
					</div>
				</fieldset>
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
			
				<input type="submit" id="potvrd" value="Zaregistrovať sa">
			</form>
			
			<a href="index.php">Späť na hlavnú stránku</a><br>
<?php
	include "config.php";

	if($_POST["login"] && $_POST["password"]) {
		$name = $_POST["name"];
		$surname = $_POST["surname"];
		$email = $_POST["email"];
		$login = $_POST["login"];
		$password = md5($_POST["password"]); // hash MD5
		
		$myquery = "INSERT INTO users (meno, priezvisko, email, login, heslo) VALUES ('$name', '$surname', '$email', '$login', '$password')";
		$myresult = $mysqli->query($myquery);
		
		header("Location: index.php");
	}
		
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	
	//echo "halo";
?>

		</div>
	</body>
</html>
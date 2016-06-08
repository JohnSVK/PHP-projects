<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pridanie novej osoby</title>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="center container">
			<h1>Pridanie novej osoby</h1>
		
			<form name="formular" onSubmit="" action="addperson.php" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Osobné údaje</legend>
					
					<div id="meno">
						Meno:<br>
						<input type="text" name="meno" id="menoField">
					</div>
	
					<div id="priez">
						Priezvisko:<br>
						<input type="text" name="priezvisko" id="priezField">
						<br>
					</div>
					
					<div id="nardatum">
						Dátum narodenia:<br>
						<input type="text" name="nardatum" id="nardatumField">
						<br>
					</div>
					<div id="narmiesto">
						Miesto narodenia:<br>
						<input type="text" name="narmiesto" id="narmiestoField">
						<br>
					</div>
					<div id="narkrajina">
						Krajina narodenia:<br>
						<input type="text" name="narkrajina" id="narkrajinaField">
						<br>
					</div>
				</fieldset>
			
				<input type="submit" id="potvrd" value="Pridať osobu">
			</form>
			
			<br><a href="index.php">Späť na hlavnú stránku</a>
		</div>
	</body>
</html>

<?php
	$mysqli = new mysqli('localhost', 'user', '123456', 'db_z1');
	$mysqli->set_charset("utf8");

	if(mysqli_connect_error()) {
		die('Connection Error (' . mysqli_connect_errno() . ' ) ' . mysqli_connect_error());
	}
	
	if($_POST["meno"] && $_POST["priezvisko"] && $_POST["nardatum"] && $_POST["narmiesto"] && $_POST["narkrajina"]) {
		$name = $_POST["meno"];
		$surname = $_POST["priezvisko"];
		$birthDay = $_POST["nardatum"];
		$birthPlace = $_POST["narmiesto"];
		$birthCountry = $_POST["narkrajina"];
		
		$myquery = "INSERT INTO osoby (name, surname, birthDay, birthPlace, birthCountry) VALUES('$name', '$surname', '$birthDay', '$birthPlace', '$birthCountry')";
		$myresult = $mysqli->query($myquery);
	}
	
	$mysqli->close();
	
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	
	//echo "halo";
?>
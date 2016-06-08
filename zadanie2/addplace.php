<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pridanie nového umiestnenia</title>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="center">
			<h1>Pridanie nového umiestnenia</h1>
		
			<form name="formular" onSubmit="" action="addplace.php" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Údaje o umiestnení</legend>
					
					<div id="selekty">
						Osoba:<br>
						<select name="person" id="osobaOptions">
						
<?php
	$mysqli = new mysqli('localhost', 'user', '123456', 'db_z1');
	$mysqli->set_charset("utf8");

	if(mysqli_connect_error()) {
		die('Connection Error (' . mysqli_connect_errno() . ' ) ' . mysqli_connect_error());
	}
	
	$query = "SELECT id_person, name, surname FROM osoby";
	$result = $mysqli->query($query);
	
	// vykreslenie dropdown menu vsetkych osob
	while($row = $result->fetch_row()) {
		echo "<option value=\"{$row[0]}\">{$row[1]} {$row[2]}</option>";
	}
	
	echo "</select><br>";
	
	// vykreslenie dropdown menu vsetkych OH
	echo "Olympijské Hry:<br>";
	echo "<select name=\"oh\" id=\"ohOptions\">";
	
	$query = "SELECT id_OH, type, city, year FROM oh";
	$result = $mysqli->query($query);
	
	
	while($row = $result->fetch_row()) {
		echo "<option value=\"{$row[0]}\">{$row[1]} {$row[2]} {$row[3]}</option>";
	}
	echo "</select>";
	
	if($_POST["person"] && $_POST["oh"] && $_POST["umiestnenie"] && $_POST["disciplina"]) {
		$person = $_POST["person"];
		$oh = $_POST["oh"];
		$umiestnenie = $_POST["umiestnenie"];
		$disciplina = $_POST["disciplina"];
		
		$myquery = "INSERT INTO umiestnenie (id_person, ID_OH, place, discipline) VALUES('$person', '$oh', '$umiestnenie', '$disciplina')";
		$myresult = $mysqli->query($myquery);
	}
	
	$mysqli->close();
	
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	
	//echo "halo";
?>

						
					</div>
	
					<div id="umiest">
						Umiestnenie:<br>
						<input type="number" name="umiestnenie" id="umiestField">
						<br>
					</div>
			
					<div id="discip">
						Disciplína:<br>
						<input type="text" name="disciplina" id="discipField">
						<br>
					</div>
					
				</fieldset>
			
				<input type="submit" id="potvrd" value="Pridať umiestnenie">
			</form>
			
			<br><a href="index.php">Späť na hlavnú stránku</a>
		</div>
	</body>
</html>
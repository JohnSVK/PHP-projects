<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Zmena údajov osoby</title>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="center">
			<h1>Zmena údajov osoby</h1>
		
			<form name="formular" onSubmit="" action="index.php" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Osobné údaje</legend>
					
<?php
	$mysqli = new mysqli('localhost', 'user', '123456', 'db_z1');
	$mysqli->set_charset("utf8");

	if(mysqli_connect_error()) {
		die('Connection Error (' . mysqli_connect_errno() . ' ) ' . mysqli_connect_error());
	}
	
	if($_GET["osoba"]) {
		$osobaID = $_GET["osoba"];
	
		$myquery = "SELECT os.id_person, os.name, os.surname, h.year, h.city, h.type, um.discipline
				FROM osoby AS os
				JOIN umiestnenie AS um ON os.id_person=um.id_person
				JOIN oh AS h ON um.ID_OH=h.id_OH
				WHERE um.place=1 AND os.id_person='$osobaID' ".$query_order;
		//$myquery = "SELECT * FROM osoby WHERE id_person='$osobaID'";
		$myresult = $mysqli->query($myquery);
		$row = $myresult->fetch_row();
		
		echo "<input type=\"hidden\" name=\"person_id\" id=\"personIDField\" value=\"{$row[0]}\">";
		echo "<div id=\"meno\"> Meno:<br>";
		echo "<input type=\"text\" name=\"meno\" id=\"menoField\" value=\"{$row[1]}\">
					</div>

					<div id=\"priez\">
						Priezvisko:<br>";
		echo "<input type=\"text\" name=\"priezvisko\" id=\"priezField\" value=\"{$row[2]}\">
					</div>

					<div id=\"rok\">
						Rok OH:<br>";
		echo "<input type=\"text\" name=\"rok\" id=\"nardatumField\" value=\"{$row[3]}\">
					</div>

					<div id=\"narmiesto\">
						Miesto OH:<br>";
		echo "<input type=\"text\" name=\"narmiesto\" id=\"narmiestoField\" value=\"{$row[4]}\">
					</div>

					<div id=\"narkrajina\">
						Disciplína OH:<br>";
		echo "<input type=\"text\" name=\"narkrajina\" id=\"narkrajinaField\" value=\"{$row[6]}\">
					</div>";
	}
	/*
	if($_POST["meno"] && $_POST["priezvisko"] && $_POST["nardatum"] && $_POST["narmiesto"] && $_POST["narkrajina"] && $_POST["person_id"]) {
		$osobaID = $_POST["person_id"];
		
		$name = $_POST["meno"];
		$surname = $_POST["priezvisko"];
		$birthDay = $_POST["nardatum"];
		$birthPlace = $_POST["narmiesto"];
		$birthCountry = $_POST["narkrajina"];
		
		$myquery = "UPDATE osoby SET name='$name', surname='$surname', birthDay='$birthDay', birthPlace='$birthPlace', birthCountry='$birthCountry' WHERE id_person='$osobaID'";
		$myresult = $mysqli->query($myquery);
		
	}*/
	
	$mysqli->close();
	
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	//echo "halo";
?>

				</fieldset>
			
				<input type="submit" id="potvrd" value="Uložiť zmeny">
			</form>
			
			<br><a href="index.php">Späť na hlavnú stránku</a>
		</div>
	</body>
</html>
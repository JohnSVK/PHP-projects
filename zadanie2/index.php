<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Tabuľka OH</title>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<div class="container center">
			<div class="row">
				<h1>Tabuľka OH</h1>
				<br>
<?php

	include "config.php";

	if(mysqli_connect_error()) {
		die('Connection Error (' . mysqli_connect_errno() . ' ) ' . mysqli_connect_error());
	}
	
	// zmena udajov v tabulke
	if($_POST["meno"] && $_POST["priezvisko"] && $_POST["rok"] && $_POST["narmiesto"] && $_POST["narkrajina"] && $_POST["person_id"]) {
		$osobaID = $_POST["person_id"];
		
		$name = $_POST["meno"];
		$surname = $_POST["priezvisko"];
		$year = $_POST["rok"];
		$city = $_POST["narmiesto"];
		$discipline = $_POST["narkrajina"];
		
		$myquery = "UPDATE osoby AS os 
					JOIN umiestnenie AS um ON os.id_person=um.id_person
					JOIN oh AS h ON um.ID_OH=h.id_OH
					SET os.name='$name', os.surname='$surname', h.year='$year', h.city='$city', um.discipline='$discipline' WHERE os.id_person='$osobaID'";
		$myresult = $mysqli->query($myquery);
		
	}
	
	// vymazanie z tabulky
	if($_GET["delete"]) {
		$deleteID = $_GET["delete"];
	
		$myquery = "DELETE FROM osoby WHERE id_person='$deleteID'";
		$myresult = $mysqli->query($myquery);
	}
	
	// tabulka
	echo "<table class=\"table\">";
	
	echo "<tr>";
	echo "<th>Meno</th> <th><a href=\"index.php?order=surname\">Priezvisko</a></th>"; 
	echo "<th><a href=\"index.php?order=year\">Rok</a></th> <th>Miesto</th>";
	echo "<th><a href=\"index.php?order=type\">Typ</a></th> <th>Disciplína</th> <th>Akcia</th>";
	echo "</tr>";
	
	if($_GET["order"] && ($_GET["order"] == "surname")) {
		$query_order = "ORDER BY os.surname ASC";
	} else if($_GET["order"] && ($_GET["order"] == "year")) {
		$query_order = "ORDER BY h.year ASC";
	} else if($_GET["order"] && ($_GET["order"] == "type")) {
		$query_order = "ORDER BY h.type ASC";
	}
	
	$myquery = "SELECT os.name, os.surname, h.year, h.city, h.type, um.discipline, os.id_person
				FROM osoby AS os
				JOIN umiestnenie AS um ON os.id_person=um.id_person
				JOIN oh AS h ON um.ID_OH=h.id_OH
				WHERE um.place=1 ".$query_order;
	$myresult = $mysqli->query($myquery);
	
	while($row = $myresult->fetch_row()) {
		echo "<tr>";
		echo "<td><a href=\"detail.php?osoba={$row[6]}\">{$row[0]}</a></td>" ;
		echo "<td>{$row[1]}</td>";
		echo "<td>{$row[2]}</td>";
		echo "<td>{$row[3]}</td>";
		echo "<td>{$row[4]}</td>";
		echo "<td>{$row[5]}</td>";
		echo "<td><a href=\"edit.php?osoba={$row[6]}\">upraviť</a> <a href=\"index.php?delete={$row[6]}\">odstrániť</a></td>";
		echo "</tr>";
	}
	
	echo "</table>";

	echo "<br><a href=\"addperson.php\">Pridať novú osobu</a>";
	echo "<br><a href=\"addplace.php\">Pridať nové umiestnenie</a>";
	
	$mysqli->close();
	
?>
			</div>
		</div>
	</body>
</html>
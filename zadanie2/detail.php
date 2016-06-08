<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!--<title>Detaily</title>-->
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		
<?php
	$mysqli = new mysqli('localhost', 'user', '123456', 'db_z1');
	$mysqli->set_charset("utf8");

	if(mysqli_connect_error()) {
		die('Connection Error (' . mysqli_connect_errno() . ' ) ' . mysqli_connect_error());
	}
	
	if($_GET["osoba"]) {
		$myquery = "SELECT os.name, os.surname, h.year, h.city, h.type, um.discipline, um.place
					FROM osoby AS os
					JOIN umiestnenie AS um ON os.id_person=um.id_person
					JOIN oh AS h ON um.ID_OH=h.id_OH
					WHERE os.id_person='".$_GET["osoba"]."'";
		$myresult = $mysqli->query($myquery);
		
		$row = $myresult->fetch_row();
		$meno = $row[0] ." ". $row[1];
		
		echo "<title>{$meno}</title>";
		echo "</head>";
		echo "<body>";
		echo "<div class=\"center\">";
		
		echo "<h1>{$meno}</h1>";
		echo "ÚSPECHY:<br>";
		
		do {
			echo "umiestnenie:  {$row[6]}. miesto<br>";
			echo "kategória:	{$row[5]}<br>";
			echo "miesto a rok: {$row[3]} {$row[2]}<br><br>";
		} while($row = $myresult->fetch_row());

		echo "<a href=\"index.php\">Späť na hlavnú stránku</a>";
		
		echo "	</div>
		</body>";
	} else {
		echo "<title>Osoba</title>";
	}
	
	$mysqli->close();
	
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	
	//echo "halo";
?>

	
</html>
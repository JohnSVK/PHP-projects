<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Štatistika návštevnosti</title>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<div class="container center">
			<h1>Štatistika návštevnosti</h1>
			
			<?php
				include_once("config.php");
			
				if ($_GET["country"]) {
					
					$country = $_GET["country"];
					
					$query = "SELECT ip FROM navstevnici";
					$result = $mysqli->query($query);
					
					echo '<table class="table">';
					echo "<th>Mesto</th><th>Počet návštev</th>";

					$cities = [];
					
					while($row = $result->fetch_row()) {
						$location = json_decode(file_get_contents("http://ip-api.com/json/{$row[0]}"));
						
						if (strtolower($location->countryCode) === $country) {
							$city = $location->city;
							
							if ($city) {
								$cities["{$city}"]["name"] = $city;
								$cities["{$city}"]["count"]++;
							} else {
								$cities["other"]["name"] = "Nelokalizované mestá a vidiek";
								$cities["other"]["count"]++;
							}
						}
					}
					
					foreach($cities as $city) {
						
						echo "<tr>";
						echo "<td>{$city["name"]}</td>";
						echo "<td>{$city["count"]}</td>";
						echo "</tr>";
					}
					
					echo "</table>";
					
				}
				
				echo "<br>";
				echo "<a href=\"stats.php\">Späť</a>";
			?>
			
		</div>

		<!-- jQuery -->
		<script src="js/jquery-2.1.3.js"></script>
		<!-- bootstrap-->
		<script src="js/bootstrap.min.js"></script>
		<!-- javascript -->
		<script src="js/client.js"></script>
	</body>
</html>
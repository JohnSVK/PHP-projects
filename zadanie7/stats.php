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
			
			<p>
				<a href="weather.php">Predpoveď počasia</a>
				<a href="location.php">Informácie o polohe</a>
				<a href="stats.php">Štatistika návštevnosti</a>
			</p>
			
			<?php
				include_once("config.php");
			
				//zitenie ip
				$ip = $_SERVER['REMOTE_ADDR'];
				
				$query = "SELECT * FROM navstevnici WHERE ip='$ip' AND DATE(date)=DATE(now())";
				$result = $mysqli->query($query);
				$row = $result->fetch_row();

				if (!$row) {
					$myquery = "INSERT INTO navstevnici (ip, page) VALUES ('$ip', 2)";
					$myresult = $mysqli->query($myquery);
				}
				
				$query = "SELECT ip FROM navstevnici";
				$result = $mysqli->query($query);
				
				echo '<table class="table">';
				echo "<tr><th>Vlajka</th><th>Štát</th><th>Počet návštev</th></tr>";

				$countries = [];
				$points = [];
				
				while($row = $result->fetch_row()) {
					$location = json_decode(file_get_contents("http://ip-api.com/json/{$row[0]}"));
					
					$points["lat"] = $location->lat;
					$points["lng"] = $location->lon;
					
					$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$location->lat},{$location->lon}&components=country:{$location->countryCode}&region={$location->countryCode}&language=SK&key={$google_apikey}";
					$geolocation = json_decode(file_get_contents($url));
				
					$country = $geolocation->results[0]->address_components[0]->long_name;
					
					$countries["{$country}"]["code"] = strtolower($location->countryCode);
					$countries["{$country}"]["name"] = $country;
					$countries["{$country}"]["count"]++;
				}
				
				foreach($countries as $country) {
					
					echo "<tr>";
					echo "<td><img src=\"http://www.geonames.org/flags/x/{$country["code"]}.gif\" height=\"20\" width=\"20\" alt=\"flag\"></td>";
					echo "<td><a href=\"countrystats.php?country={$country["code"]}\">{$country["name"]}</a></td>";
					echo "<td>{$country["count"]}</td>";
					echo "</tr>";
				}
				
				echo "</table><br><br>";
				
				// ----- google map -------
				echo "<div id=\"map\"></div>";
				
				
				echo "<br><br>";
				
				// casy navstev
				$query = "SELECT time(date), ip, date FROM navstevnici";
				$result = $mysqli->query($query);
				
				$ranges = [0, 0, 0, 0];
				
				while($row = $result->fetch_row()) {
					$timestamp = strtotime($row[2]);
					
					$location = json_decode(file_get_contents("http://ip-api.com/json/{$row[1]}"));
					
					$url = "https://maps.googleapis.com/maps/api/timezone/json?location={$location->lat},{$location->lon}&timestamp={$timestamp}&language=SK&key={$google_apikey}";
					$timezone = json_decode(file_get_contents($url));
				
					//$offset = $timezone->dstOffset;
					//if(!$offset)
					$offset = ($timezone->rawOffset);
					
					//echo $offset . "<br>";
					
					$time = strtotime($row[0]) + $offset;
					
					/*if ($row[0]) {
						echo $row[0] . "<br>";
					}*/
					
					if ($time >= strtotime("00:00:00") && $time <= strtotime("05:59:00")) {
						$ranges[0]++;
					}
					if ($time >= strtotime("06:00:00") && $time <= strtotime("13:59:00")) {
						$ranges[1]++;
					}
					if ($time >= strtotime("14:00:00") && $time <= strtotime("19:59:00")) {
						$ranges[2]++;
					}
					if ($time >= strtotime("20:00:00") && $time <= strtotime("23:59:00")) {
						$ranges[3]++;
					}
					
				}
				
				echo '<table class="table">';
				echo "<tr><th>00:00-05:59</th><th>06:00-13:59</th><th>14:00-19:59</th><th>20:00-23:59</th></tr>";
				echo "<tr><td>{$ranges[0]}</td><td>{$ranges[1]}</td><td>{$ranges[2]}</td><td>{$ranges[3]}</td></tr>";
				echo "</table>";
				
				echo "<br><br>";
				
				// navstevnost stranok
				//$query = "SELECT page, max(SELECT count(ip) FROM navstevnici GROUP BY page) FROM navstevnici";
				$query = "SELECT page, count(page) as pocet FROM navstevnici GROUP BY page ORDER BY pocet DESC";
				$result = $mysqli->query($query);
				$page = $result->fetch_row();

				echo "Najviac návštev bolo zaznamenaných na stránke: ";
				switch($page[0]) {
					case 0: 
						echo "<a href=\"weather.php\">Predpoveď počasia</a>";
						break;
					case 1:
						echo "<a href=\"location.php\">Informácie o polohe</a>";
						break;
					case 2:
						echo "<a href=\"stats.php\">Štatistika návštevnosti</a>";
						break;
					default:
						echo "Nebola zanznamenaná žiadna stránka";
				}
				
			?>
			
		</div>

		
		<!-- jQuery -->
		<script src="js/jquery-2.1.3.js"></script>
		<!-- bootstrap-->
		<script src="js/bootstrap.min.js"></script>
		<!-- javascript -->
		<script src="js/map.js"></script>
		<!--Google maps-->
		<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPlT1-ZjWsfjG8pBzq9aBxR3UaxnCuJko&callback=initMap">
		</script>
	</body>
</html>
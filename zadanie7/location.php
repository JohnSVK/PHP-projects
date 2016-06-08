<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Informácie o návštevníkovi</title>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<div class="container center">
			<h1>Informácie o návštevníkovi</h1>
			
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
					$myquery = "INSERT INTO navstevnici (ip, page) VALUES ('$ip', 1)";
					$myresult = $mysqli->query($myquery);
				}
				
				$location = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
				
				echo "Vaša IP: " . $location->query . "<br>";
				echo "Vaše GPS súradnice: Lat: " . $location->lat . " Lon: " . $location->lon . "<br>";
				
				if($location->city) {
					echo "Mesto: " . $location->city . "<br>";
				} else {
					echo "Mesto sa nedá lokalizovať alebo sa nachádzate na vidieku<br>";
				}
				
				$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$location->lat},{$location->lon}&components=country:{$location->countryCode}&region={$location->countryCode}&language=SK&key={$google_apikey}";
				
				$geolocation = json_decode(file_get_contents($url));
				
				echo "Štát: " . $geolocation->results[0]->address_components[0]->long_name . "<br>";
				//var_dump($geolocation);
				
				$url = "https://restcountries.eu/rest/v1/alpha?codes={$location->countryCode}";
				$country = json_decode(file_get_contents($url));
				
				echo "Hlavné mesto krajiny: " . $country[0]->capital;
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
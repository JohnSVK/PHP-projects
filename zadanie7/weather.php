<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Predpoveď počasia</title>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<div class="container center">
			<h1>Predpoveď počasia</h1>
			
			<p>
				<a href="weather.php">Predpoveď počasia</a>
				<a href="location.php">Informácie o polohe</a>
				<a href="stats.php">Štatistika návštevnosti</a>
			</p>

			<h3>Predpoveď počasia pre vašu aktuálnu polohu:</h3>
			<div id="result"></div>
			
			<?php
				include_once("config.php");
			
				//zitenie ip
				$ip = $_SERVER['REMOTE_ADDR'];
				
				$query = "SELECT * FROM navstevnici WHERE ip='$ip' AND DATE(date)=DATE(now())";
				$result = $mysqli->query($query);
				$row = $result->fetch_row();

				if (!$row) {
					$myquery = "INSERT INTO navstevnici (ip, page) VALUES ('$ip', 0)";
					$myresult = $mysqli->query($myquery);
				}
				
				$location_data = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
				
				echo "Vaša IP: " . $location_data->query . "<br>";
				
				echo "Vaša Poloha: " . $location_data->city;
				echo "<br><br>";
				
				//zistenie pocasia
				$appid = "d13b16b1710ce9fe47f9390787336351";
				$url = "http://api.openweathermap.org/data/2.5/weather?q={$location_data->city},{$location_data->countryCode}&units=metric&appid={$weather_apikey}";
				
				//$weather = json_decode(file_get_contents("api.openweathermap.org/data/2.5/weather?q=London&appid=" . $appid));
				$weather = json_decode(file_get_contents($url));
				
				echo $weather->weather[0]->main;
				echo "<br>Teplota: ";
				echo $weather->main->temp . " °C";
				
				echo "<br>Tlak: ";
				echo $weather->main->pressure . " hPa";
				
				echo "<br>Vlhkosť vzduchu: ";
				echo $weather->main->humidity . " %";
				
				echo "<br>Rýchlosť vetra: ";
				echo $weather->wind->speed . " m/s";
				
				//echo $weather;
				echo $weather->weather->main;
				
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
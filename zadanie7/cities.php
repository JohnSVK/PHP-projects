<?php
	header('Content-Type: application/json; charset=UTF-8');

	$method = $_SERVER['REQUEST_METHOD'];

	switch ($method) {
	  case 'GET':
			//nacitanie udajov z databazy
			include_once("config.php");
			
			$query = "SELECT ip FROM navstevnici";
			$result = $mysqli->query($query);
			
			$i = 0;
			while($row = $result->fetch_row()) {
				$location = json_decode(file_get_contents("http://ip-api.com/json/{$row[0]}"));
				
				$response["success"] = 1;
				$response["result"]["cities"][$i]["lat"] = strval($location->lat);
				$response["result"]["cities"][$i]["lng"] = strval($location->lon);
				
				$i++;
			}
			
			if ($response["success"]) {
				echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
			} 
			
			break;
	}
	
	if ($response["success"] == null){
		$response["success"] = 0;
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
		break;
	}
		

?>
<?php
	header('Content-Type: application/json; charset=UTF-8');

	$xml = simplexml_load_file("meniny.xml") or die("Error loading xml document!");
	 
	// get the HTTP method, path and body of the request
	$method = $_SERVER['REQUEST_METHOD'];
	//var_dump($method); echo("<br>");
	$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
	$input = json_decode(file_get_contents('php://input'),true);   // php://input - read raw data from the request body
	 
	// retrieve the table and key from the path
	$country = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
	$service = array_shift($request);
	//var_dump($key); echo("<br>");
	
	//echo $key;
	 
	switch ($method) {
	  case 'GET':
		if (!$xml->zaznam[1]->{$country} && !$country == "all") {
			$response["success"] = 0;
			echo json_encode($response, JSON_UNESCAPED_UNICODE);
			break;
		}
	  
		if($service == "meniny") {
			//$date = $key;
			if($_GET["date"]) {
				$date = $_GET["date"];
			
				foreach($xml->zaznam as $zaznam) {
					if($zaznam->den == $date) {
						$response["success"] = 1;
						$response["result"]["name"] = strval($zaznam->{$country});
						
						if ($country == "all") {
							$response["result"]["name"] = strval($zaznam->SKd);
						}

						echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
						break;
					} 
				}
			} else if($_GET["name"]) {
				$name = $_GET["name"];
				
				foreach($xml->zaznam as $zaznam) {
					
					if ($country == "all") {
						$country = "SKd";
					}
					foreach(explode(',', $zaznam->{$country}) as $zaznam_name) {
						if (trim($zaznam_name) === $name) {
							$response["success"] = 1;
							$response["result"]["date"] = strval($zaznam->den);

							echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
							break;
						}
					}
				}
			}
		} else if ($service == "sviatky") {
			$sviatky = "{$country}sviatky";
			$i = 0;
			
			foreach($xml->zaznam as $zaznam) {
				if ($zaznam->{$sviatky}) {
					$response["success"] = 1;
					$response["result"]["sviatky"][$i]["den"] = strval($zaznam->den);
					$response["result"]["sviatky"][$i]["sviatok"] = strval($zaznam->{$sviatky});
					
					$i++;
				}
			}
			
			if ($response["success"]) {
				echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
			}
		
		} else if ($service == "pamiatky") {
			$pamiatky = "{$country}dni";
			$i = 0;
			
			foreach($xml->zaznam as $zaznam) {
				if ($zaznam->{$pamiatky}) {
					$response["success"] = 1;
					$response["result"]["pamiatky"][$i]["den"] = strval($zaznam->den);
					$response["result"]["pamiatky"][$i]["pamiatka"] = strval($zaznam->{$pamiatky});
					
					$i++;
				}
			}
			
			if ($response["success"]) {
				echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
			}
		
		} 
		
		if ($response["success"] == null){
			$response["success"] = 0;
			echo json_encode($response, JSON_UNESCAPED_UNICODE);
			break;
		}
		break;
	  /*case 'PUT':
		//if($country == "meniny") {
			
			parse_str(file_get_contents("php://input"),$data);
			//$data = explode('&', $service);
			$input = json_decode(file_get_contents('php://input'),true);
			$response["success"] = "response:" . $input['date'];
			
			
			echo json_encode($response, JSON_UNESCAPED_UNICODE);
			break;
			
			if($data) {
				//$date = explode('&', $data[0])[1];
				//$name = explode('&', $data[1])[1];
				$date = $data["date"];
				$name = $data["name"];
			
				foreach($xml->zaznam as $zaznam) {
					if($zaznam->den == $date) {
						$zaznam->SKd .= ", {$name}";
						
						$xml->saveXML("meniny.xml");
						
						$response["success"] = 1;

						echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
						break;
					} 
				}
			}
			
			if ($response["success"] == null){
				$response["success"] = 0;
				echo json_encode($response, JSON_UNESCAPED_UNICODE);
				break;
			}
		//}
		break;*/
	  case 'POST':
	  
		if($country == "meniny" && $service == "new") {

			if($_POST["date"] && $_POST["name"]) {
				$date = $_POST["date"];
				$name = $_POST["name"];
			
				foreach($xml->zaznam as $zaznam) {
					if($zaznam->den == $date) {
						$zaznam->SKd .= ", {$name}";
						
						$xml->saveXML("meniny.xml");
						
						$response["success"] = 1;

						echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
						break;
					} 
				}
			}
			
			if ($response["success"] == null){
				$response["success"] = 0;
				echo json_encode($response, JSON_UNESCAPED_UNICODE);
				break;
			}
		}
		
		break;
	  case 'DELETE':
		break;
	}
	 
?>
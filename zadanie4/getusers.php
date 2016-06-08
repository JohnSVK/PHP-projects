<?php
	include_once "config.php";
	
	while (true) {
		
		$myquery = "SELECT login FROM users WHERE logged=1";
		$myresult = $mysqli->query($myquery);

		$i = 0;
		$users = array();
		
		while($row = $myresult->fetch_row()) {
			$users[$i] = $row[0];
			
			$i++;
		}
		
		$users = json_encode($users);
		
		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache');
		header("Connection: keep-alive");
		
		$lastId = $_SERVER["HTTP_LAST_EVENT_ID"];
		if (isset($lastId) && !empty($lastId) && is_numeric($lastId)) {
			$lastId = intval($lastId);
			$lastId++;
		} else {
			$lastId = 0;
		}
		
		echo "id: $lastId" . PHP_EOL;
		echo "data: ". PHP_EOL;
		echo "data: {$users} ". PHP_EOL;
		echo "data: ". PHP_EOL;
		echo PHP_EOL;

		$lastId++;
		ob_flush();
		flush();

		sleep(2);
	}
		
?>
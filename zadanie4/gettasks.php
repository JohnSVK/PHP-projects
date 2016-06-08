<?php
	include "config.php";
	
	while (true) {
		// nacitanie vsetkych nedokoncenych uloh
		$myquery = "SELECT * FROM tasks WHERE finished_by IS NULL";
		$myresult = $mysqli->query($myquery);
		
		$i=0;
		$tasks = array(array());
		
		while($row = $myresult->fetch_assoc()) {
			$tasks[$i]["id"] = $row["id"];
			$tasks[$i]["owner"] = $row["owner"];
			$tasks[$i]["priority"] = $row["priority"];
			$tasks[$i]["text"] = $row["text"];
			$tasks[$i]["date"] = $row["date"];
			
			$i++;
		}
		
		// nacitanie dokoncenych uloh
		$myquery = "SELECT * FROM tasks WHERE finished_by IS NOT NULL";
		$myresult = $mysqli->query($myquery);
		
		$i=0;
		$tasks_finished = array(array());
		
		while($row = $myresult->fetch_assoc()) {
			$tasks_finished[$i]["id"] = $row["id"];
			$tasks_finished[$i]["owner"] = $row["owner"];
			$tasks_finished[$i]["priority"] = $row["priority"];
			$tasks_finished[$i]["text"] = $row["text"];
			$tasks_finished[$i]["date"] = $row["date"];
			
			$tasks_finished[$i]["finished_by"] = $row["finished_by"];
			$tasks_finished[$i]["finished_at"] = $row["finished_at"];
			
			$i++;
		}
		
		//echo json_encode($tasks);
		
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

		$tasks = json_encode($tasks);
		$tasks_finished = json_encode($tasks_finished);

		echo "id: $lastId" . PHP_EOL;
		echo "data: {". PHP_EOL;
		echo "data: \"tasks\": {$tasks} , ". PHP_EOL;
		echo "data: \"tasks_finished\": {$tasks_finished}". PHP_EOL;
		echo "data: }". PHP_EOL;
		echo PHP_EOL;

		$lastId++;
		ob_flush();
		flush();

		sleep(2);
	}
?>
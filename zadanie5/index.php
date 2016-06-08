<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Telefónne čísla</title>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<div class="container center">
			<h1>Telefónne čísla</h1>
		
			<form name="formular" onSubmit="" action="index.php" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend class="opacity_full">Zadaj mesto/štát alebo telefónnu predvoľbu</legend>
					
					<div id="input" class="opacity_full">
						Mesto/Štát/Predvoľba:<br>
						<input type="text" name="input" id="inputField">
					</div>
					
				</fieldset>
			
				<input type="submit" id="potvrd" value="Odoslať" class="opacity_full">
			</form>
			<br>

<?php

	if ($_POST["input"]) {
		
		$input = $_POST["input"];
		

		function printSlovenskoResults($url, $input) {
			$result = 1;
			
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$html = curl_exec($curl);
			curl_close($curl);
			
			# Create a DOM parser object		
			$dom = new DOMDocument();
			@$dom->loadHTML($html);

			$finder = new DomXPath($dom);
			$classname="tabulkabox";
			$nodes = $finder->query("//*[contains(@class, '$classname')]");
			
			foreach ($nodes as $node) {
				foreach ($node->getElementsByTagName("tr") as $tr) {
					$city = $tr->childNodes->item(0)->nodeValue;
					$number = $tr->childNodes->item(4)->nodeValue;
					
					if ($city == $input || $number == $input) {
						echo "Mesto/Štát:     {$city}<br>";
						echo "Predvoľba:      {$number}<br><br>";
						
						$result = 0;
					}
				}
			}
			if (!$result)
				return 0;
			else
				return 1;
		}
		
		function printCeskoResults($input) {
			$result = 1;
				// ----------- cesko 1. cast -----------------------------
			$searchurl = "http://www.predvolby.info/component/search/" . urlencode($input);
			//echo $searchurl;
			
			$curl = curl_init($searchurl);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$html = curl_exec($curl);
			curl_close($curl);
					
			$dom = new DOMDocument();
			@$dom->loadHTML($html);

			$finder = new DomXPath($dom);
			$classname="contentpaneopen";
			$nodes = $finder->query("//*[contains(@class, '$classname')]");
			
			$url = $nodes->item(1)->getElementsByTagName("a")->item(0)->getAttribute("href");
			
			$url = "http://www.predvolby.info" . $url;
			//echo $url;
			
			// ---------- cesko 2. cast ------------------------------
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$html = curl_exec($curl);
			curl_close($curl);
					
			$dom = new DOMDocument();
			@$dom->loadHTML($html);

			$finder = new DomXPath($dom);
			$classname="radtab";
			$nodes = $finder->query("//*[contains(@class, '$classname')]");
			
			foreach ($nodes->item(0)->parentNode->parentNode->getElementsByTagName("tr") as $tr) {
				$city = $tr->childNodes->item(1)->nodeValue;
				$number = $tr->childNodes->item(0)->nodeValue;
				
				$city = trim($city);
				$number = trim($number);
				$input = trim($input);
				
				if ($city == $input || $number == $input) {
					echo "Mesto/Štát:          {$city}<br>";
					echo "Predvoľba:      {$number}<br><br>";
					
					$result = 0;
				}
			
			}
			if (!$result)
				return 0;
			else
				return 1;
		}
		
		$notfound = printSlovenskoResults('http://telefonnyzoznam.vyhladajsi.sk/smerovecislamiest.php', $input);
		//if ($notfound)
			$notfound = printSlovenskoResults('http://telefonnyzoznam.vyhladajsi.sk/smerovecislastatov.php', $input);
		//if ($notfound)
			printCeskoResults($input);
	}
	
?>

		</div>
	</body>
</html>
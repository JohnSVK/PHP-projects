<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>O API</title>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<div class="container center">
			<h1>O API</h1>
		
			<div class="row">
				<h3>Základné informácie</h3>
				<p>
					Tento web service predstavuje REST API, ktorá pracuje s databázou mien (meninový kalendár) a ich prislúchajúcich dátumov podľa kalendára menín.
					API poskytuje GET a POST metódy na získanie údajov z tejto databázy v JSON formáte.
				</p>
			</div>
			
			<div class="row">
				<h3>Metódy a príklady použitia REST API</h3>
				
				<p>
					Všetky metódy majú navrátovú hodnotu vo formáte typu JSON
				</p>
				
				<h4>GET index.php/{krajina}/meniny</h4>
				<div class="row margin">
					
					<h5>Resource URL</h5>
					<p>
						http://147.175.98.161/zadanie06/index.php/{krajina}/meniny
					</p>
					
					<h5>Použitie</h5>
					<p>
						-zistenie, kto má meniny, na základe zadaného dátumu<br>
						-zistenie, kedy má osoba meniny, na základe zadaného mena<br>
						{krajina} - jedna z krajín SK, CZ, AT, HU
					</p>
					
					<h5>Povinné parametre (jeden z uvedených)</h5>
					<p>
						date - požadovaný dátum v kalendári (dátum je potrebné zadať vo formáte MMDD, M-mesiac, D- deň)<br>
						name - požadované meno osoby (potrebné zadať s diakritikou)
					</p>	
						
					<h5>Príklad</h5>
					<p>
						GET http://147.175.98.161/zadanie06/index.php/SK/meniny?date=0102 <br>
						vráti JSON v tvare: { "success": 1, "result": { "name": "Alexandra, Karina" } }
					</p>
					<p>
						GET http://147.175.98.161/zadanie06/index.php/CZ/meniny?name=Vilma <br>
						vráti JSON v tvare: { "success": 1, "result": { "date": "0107" } }
					</p>
				</div>
				
				<h4>GET index.php/{krajina}/sviatky</h4>
				<div class="row margin">
					
					<h5>Resource URL</h5>
					<p>
						http://147.175.98.161/zadanie06/index.php/{krajina}/sviatky
					</p>
					
					<h5>Použitie</h5>
					<p>
						-získať všetky slovenské sviatky počas roka<br>
						-získať všetky české sviatky počas roka<br>
						{krajina} - jedna z krajín SK, CZ
					</p>
					
					<h5>Povinné parametre</h5>
					<p>
						Pristup k tomuto resource si nevyžaduje žiadne parametre
					</p>	
						
					<h5>Príklad</h5>
					<p>
						GET http://147.175.98.161/zadanie06/index.php/SK/sviatky <br>
					</p>
					<p>
						GET http://147.175.98.161/zadanie06/index.php/CZ/sviatky <br>
					</p>
				</div>	
				
				<h4>GET index.php/SK/pamiatky</h4>
				<div class="row margin">
					
					<h5>Resource URL</h5>
					<p>
						http://147.175.98.161/zadanie06/index.php/SK/pamiatky
					</p>
					
					<h5>Použitie</h5>
					<p>
						-získať všetky slovenské pamätné udalosti počas roka
					</p>
					
					<h5>Povinné parametre</h5>
					<p>
						Pristup k tomuto resource si nevyžaduje žiadne parametre
					</p>	
						
					<h5>Príklad</h5>
					<p>
						GET http://147.175.98.161/zadanie06/index.php/SK/pamiatky <br>
					</p>
				</div>

				<h4>POST index.php/meniny/new</h4>
				<div class="row margin">
					
					<h5>Resource URL</h5>
					<p>
						http://147.175.98.161/zadanie06/index.php/meniny/new
					</p>
					
					<h5>Použitie</h5>
					<p>
						-pridanie nového mena do meninového kalendára<br>
					</p>
					
					<h5>Povinné parametre (obidva)</h5>
					<p>
						date - dátum v kalendári (dátum je potrebné zadať vo formáte MMDD, M-mesiac, D- deň)<br>
						name - meno novej osoby (potrebné zadať s diakritikou)
					</p>	
						
					<h5>Príklad</h5>
					<p>
						POST http://147.175.98.161/zadanie06/index.php/meniny/new?date=0102&name=Jano <br>
					</p>
				</div>	
			</div>
			<br>

			<a href="client.php">Späť na klientskú stránku</a>
		</div>
		
		<!-- bootstrap-->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Meniny</title>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<div class="container center">
			<h1>Meniny</h1>
		
			<fieldset>
				<legend class="opacity_full">Zadaj dátum a zísti, kto má meniny v uvedenom štáte</legend>
				
				<div id="input" class="opacity_full">
					Dátum:<br>
					<input type="text" name="input1_1" id="inputField1_1">
					<br>
					
					Štát:<br>
					<input type="text" name="input1_2" id="inputField1_2">
					
					<button id="getNameByDate">Zisti meno</button>
				</div>
				
			</fieldset>
			<br>
			
			<fieldset>
				<legend class="opacity_full">Zadaj meno a štát a zísti, kedy má uvedená osoba meniny</legend>
				
				<div class="opacity_full">
					Meno:<br>
					<input type="text" name="input2_1" id="inputField2_1">
					<br>
					
					Štát:<br>
					<input type="text" name="input2_2" id="inputField2_2">
					
					<button id="getDateByName">Zisti dátum</button>
				</div>
				
			</fieldset>
			<br>
			
			<fieldset>
				<legend class="opacity_full">Zadaj dátum a meno a pridaj novú osobu do meninového kalendára</legend>
				
				<div class="opacity_full">
					Dátum:<br>
					<input type="text" name="input3_1" id="inputField3_1">
					<br>
				
					Meno:<br>
					<input type="text" name="input3_2" id="inputField3_2">
					
					<button id="addMeniny">Pridaj meniny</button>
				</div>
				
			</fieldset>
			<br>
			
			<button id="getSKsviatky">Zobraziť SK sviatky</button>
			<button id="getCZsviatky">Zobraziť CZ sviatky</button>
			<button id="getSKpamiatky">Zobraziť SK pamätné dni</button>
			
			<a href="about.php">Ako používať API</a>
			<br>
			
			<div id="result"></div>

		</div>

		<!-- jQuery -->
		<script src="js/jquery-2.1.3.js"></script>
		<!-- bootstrap-->
		<script src="js/bootstrap.min.js"></script>
		<!-- javascript -->
		<script src="js/client.js"></script>
	</body>
</html>
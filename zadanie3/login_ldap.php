<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>LDAP prihlásenie</title>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<div class="center">
			<h1>Prihlásenie cez LDAP</h1>
		
			<form name="formular" onSubmit="" action="login_ldap.php" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Prihlasovacie údaje</legend>
					
					<div id="login">
						LDAP Login:<br>
						<input type="text" name="login" id="loginField">
					</div>
	
					<div id="pass">
						LDAP Heslo:<br>
						<input type="password" name="password" id="passField">
						<br>
					</div>
					
				</fieldset>
			
				<input type="submit" id="potvrd" value="Prihlásiť sa">
			</form>
			
			<a href="index.php">Späť na hlavnú stránku</a><br>
			
<?php
	include "config.php";
	
	//$ldapuid = "xkanas";
	//$ldappass = "123";
	session_start();
	//echo "{$_SESSION['meno']}";
	
	if($_POST["login"] && $_POST["password"]) {
		$dn = 'ou=People, DC=stuba, DC=sk';
		$ldaprdn  = "uid=$ldapuid, $dn"; 
		//echo "$ldappass";
		$ldapconn = ldap_connect("ldap.stuba.sk")
			or die("Nemožno sa pripojiť na LDAP server");

		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

		$ldapBindResult = ldap_bind($ldapconn, $ldaprdn, $ldappass);
		if (!$ldapBindResult) {
			echo "LDAP bind successful...";
			
			$_SESSION['login'] = $_POST["login"];
			$login = $_SESSION['login'];
			
			$myquery = "INSERT INTO history (login, cas, sposob) VALUES ('$login', now(), 'LDAP')";
			$myresult = $mysqli->query($myquery);
			
			header("Location: main.php");
		} else {
			echo "LDAP bind failed...";
		}
		
		@ldap_close($ds);
	}
	
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	
	//echo "halo";
?>

		</div>
	</body>
</html>
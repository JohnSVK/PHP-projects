<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Prihlásenie</title>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		
		<!--
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<meta name="google-signin-client_id" content="1064815200155-jutnol7cgh689e7lfbgqg5g1pvbmlson.apps.googleusercontent.com">
		
		<script>
			function onSignIn(googleUser) {
			  var profile = googleUser.getBasicProfile();
			  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
			  console.log('Name: ' + profile.getName());
			  console.log('Image URL: ' + profile.getImageUrl());
			  console.log('Email: ' + profile.getEmail());
			}

		</script>
		-->
	</head>

	<body>
		<div class="center">
			<h1>Prihlásenie Google</h1>
		
			<!--<div class="g-signin2" data-onsuccess="onSignIn"></div>-->

<?php
	session_start();
	//include "config.php";
	
	include_once("config.php");
	include_once("includes/functions.php");
	
	if(isset($_REQUEST['code'])){
		$gClient->authenticate();
		$_SESSION['token'] = $gClient->getAccessToken();
		header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));
	}

	if (isset($_SESSION['token'])) {
		$gClient->setAccessToken($_SESSION['token']);
	}

	if ($gClient->getAccessToken()) {
		$userProfile = $google_oauthV2->userinfo->get();
		//DB Insert
		$gUser = new Users();
		$gUser->checkUser('google',$userProfile['id'],$userProfile['given_name'],$userProfile['family_name'],$userProfile['email'],$userProfile['gender'],$userProfile['locale'],$userProfile['link'],$userProfile['picture']);
		$_SESSION['google_data'] = $userProfile; // Storing Google User Data in Session
		
		$login = $userProfile['given_name'];
		
		$myquery = "INSERT INTO history (login, cas, sposob) VALUES ('$login', now(), 'Google')";
		$myresult = $mysqli->query($myquery);
		
		header("location: main.php");
		$_SESSION['token'] = $gClient->getAccessToken();
	} else {
		$authUrl = $gClient->createAuthUrl();
	}
	
	if(isset($authUrl)) {
		echo '<a href="'.$authUrl.'"><img src="images/glogin.png" alt="" height="60" width=""/></a>';
	} else {
		echo '<a href="logout.php?logout">Logout</a>';
	}
	
		
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	
	//echo "halo";
?>
		<br>
		<a href="index.php">Späť na hlavnú stránku</a><br>
		
		</div>
	</body>
</html>
<?php
session_start();

include_once("config.php");
if(array_key_exists('logout',$_GET))
{
	/*unset($_SESSION['token']);
	unset($_SESSION['google_data']); //Google session data unset
	$gClient->revokeToken();*/
	//unset($_SESSION["login"]);
	
	if($_SESSION['google_data']) {
		$login = $_SESSION['google_data']['given_name'];
	} else {
		$login = $_SESSION['login'];
	}
	
	$myquery = "UPDATE users SET logged=0 WHERE login='$login'";
	$myresult = $mysqli->query($myquery);
	
	session_destroy();
	
	header("Location: index.php");
}
?>
<?php
	session_start();
	session_destroy();
	session_unset();
	$_SESSION = array();

	/*
		$cookie_name = "username";
		unset($_COOKIE[$cookie_name]);
		$reset = setcookie($cookie_name,'', time() - 3600, "/");

		$cookie_name = "access_level";
		unset($_COOKIE[$cookie_name]);
		$reset = setcookie($cookie_name,'', time() - 3600, "/");
	*/

	header ('Location: http://acadweb1.salisbury.edu/~Restaurant/apptest/');
?>
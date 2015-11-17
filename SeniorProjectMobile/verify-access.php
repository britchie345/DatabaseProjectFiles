<?php
	session_start();

	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	$name = $_SESSION['name'];
	$access_level = $_SESSION['access_level'];
	$customer_id = $_SESSION['customer_id'];

	if ($access_level != 1 || $username == NULL && $password == NULL)
	{
		header('Location: http://acadweb1.salisbury.edu/~Restaurant/apptest/signin.php');
	}
?>
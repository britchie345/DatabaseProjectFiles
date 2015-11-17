<?php				
	//Address error handling

	ini_set('display_errors',1);
	error_reporting(E_ALL & ~E_NOTICE);

	$dbhost = 'localhost';
	$dbuser = 'Restaurant';
	$dbpass = 'changemenow';
	$db = 'Restaurant';
	$connect = @mysql_connect($dbhost, $dbuser, $dbpass);

	//echo "file: connection.php";

	if ($connect) 
	{
		//echo '<p>Successfully connected to MySQL.</p>';
	} 
	else 
	{
		die('<p>Could not connect to MySQL because: <b>' . mysql_error() . '</b></p>');
	}

	if (@mysql_select_db($db, $connect)) 
	{
		//echo '<p>The "Restaurant" Database has been selected.</p>';
	} 
	else 
	{
		die('<p>Could not select the "Restaurant" Database because: <b>'. mysql_error() . '</b></p>');
	}
?>
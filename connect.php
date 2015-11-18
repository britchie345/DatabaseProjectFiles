<html>
<head>
<title>Connecting to the MySQL Server Using PHP and the Database</title>
</head>
<?php

// Address error handling

ini_set('display_errors',1);
error_reporting(E_ALL & ~E_NOTICE);

//Attempt to Connect

if ($connection = @mysql_connect ('localhost', 'br2214', 'changemenow')){
	//print '<p>Successfully connected to MySQL.</p>';
}
else {
	die('<p>Could not connect to MySQL because: <b>' .mysql_error() .
	'</b></p>');
}
if (@mysql_select_db("RITCHIE_PREMIERE", $connection)){
	//print '<p>The RITCHIE_PREMIERE database has been selected.</p>';
}
else {
	die('<p>Cound not select the RITCHIE_PREMIERE database because: <b>' .mysql_error().'</b></p>');
}

?>
</body>
</html>
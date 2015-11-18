<html>
<head>
<title>Select Customer Listing</title>
</head>
<?php
session_start();

echo "Hello " .$_SESSION['username'];

ini_set('display_errors',1);
error_reporting(E_ALL & ~E_NOTICE);
$customer = $_POST['customer'];
print "The customer number chosen was $customer<br/>";

//Attempt to Connect

if ($connection = @mysql_connect ('localhost', 'br2214', 'changemenow')){
	print '<p>Successfully connected to MySQL.</p>';
}
else {
	die('<p>Could not connect to MySQL because: <b>' .mysql_error() .
	'</b></p>');
}
if (@mysql_select_db("RITCHIE_PREMIERE", $connection)){
	print '<p>The RITCHIE_PREMIERE database has been selected.</p>';
}
else {
	die('<p>Cound not select the RITCHIE_PREMIERE database because: <b>' .mysql_error().'</b></p>');
}

//define the query
$query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_NUM = '$customer'";

//output the resulting query table
if ($r = mysql_query($query))
{
while ($row = mysql_fetch_array($r))
{ print "<p>{$row['CUSTOMER_NUM]}<br/>{$row['CUSTOMER_NUM']}<br/></p>\n";
}
}


?>
</body>
</html>
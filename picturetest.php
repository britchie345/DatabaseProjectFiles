<html>
<head>
	<title>Upload an image</title>
</head>
<body>

<form action="picturetest.php" method = "POST" enctype="multipart/form-data">
	File:
	<input type="file" name="image"><input type="submit" value="Upload">
</form>

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
	//print '<p>The flagg alexamara database has been selected.</p>';
}
else {
	die('<p>Cound not select the flagg premiere database because: <b>' .mysql_error().'</b></p>');
}


$id = $_REQUEST['id'];

$image = mysql_query("SELECT * FROM IMAGES WHERE ID = $id");
$imageArray=mysql_fetch_assoc($image);
$image=$imageArray['image'];


$filename=$imageArray['name'];
$ext=end(explode('.',$filename));
header("context-type:$ext");
echo $image;



?>

</body>
</html>

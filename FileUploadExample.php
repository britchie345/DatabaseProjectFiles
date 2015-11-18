<html>
<head>
	<title>Upload an image</title>
</head>
<body>

<form action="FileUploadExample.php" method="POST" enctype="multipart/form-data">
	File:
	<input type="file" name="image"> <input type="submit" value = "Upload">
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
	die('<p>Cound not select the flagg alexamara database because: <b>' .mysql_error().'</b></p>');
}



$file = $_FILES['image']['tmp_name'];
if (!isset($file))
	echo "Please select any image.";
else
{
	$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_name = addslashes($_FILES['image']['name']);
	$image_size = getimagesize($_FILES['image']['tmp_name']);
	if ($image_size == FALSE)
		echo "This is not an image.";
	else
	{

	mysql_query("INSERT INTO IMAGES VALUES('$id', '$image_name', '$image')");
	echo "New record inserted<br>";
	$lastID=mysql_insert_id();
	echo "Image uploaded.<p/>Your Image is: <p/><img src=getImage.php?id=$lastID width=100 height=100 >";
	
	}
}

?>
</body>
</html>



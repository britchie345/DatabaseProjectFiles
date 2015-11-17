<?php 
	include "connection.php";

	$id = $_REQUEST['id']; 

	$image = mysql_query("SELECT * FROM IMAGE WHERE IMAGE_ID = $id"); 
	$imageArray = mysql_fetch_assoc($image);
	$image = $imageArray['IMAGE']; 
	$filename = $imageArray['FILENAME']; 
	$ext = end(explode('.',$filename)); 

	header("context-type:$ext"); 
	echo $image;
?>
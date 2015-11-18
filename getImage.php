<?php

php include("connect2.php"); 


$id = $_REQUEST['id'];

$image = mysql_query("SELECT * FROM ANIMALIMAGES");
$imageArray=mysql_fetch_assoc($image);
$image=$imageArray['IMAGE'];


$filename=$imageArray['NAME'];
$ext=end(explode('.',$filename));
header("content-type:$ext");
echo $image;

?>
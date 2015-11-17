<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel ="stylesheet" type="text/css" href="format2.css" />

<body background="a.jpg">

<html>

<body>



 <?php include("connect2.php"); ?>

<?php
$ID  = $_POST['ID'];
$filename  = $_POST['filename'];
?>

<style type="text/css">
.style2 {
				text-align: center;
}
</style>

<p><a href="http://acadweb1.salisbury.edu/~br2214/Project2/Project2Home.php">
<img alt="" src="spca.jpg" width="237" height="157" class="style3" /></a>&nbsp;</p>
</p>




<form method="post" action="<?php echo $PHP_SELF;?>">

<table align="center" border="0">
<tr bgcolor="#c0c0c0">
<td align="center"><head>Image Maintenance</head>
</tr>
<tr>
<td>Animal ID:</td>
<td align="center"><input type="text" VALUE="<?php print $ID; ?>" name="ID" size="3" maxlength="4"></td>
</tr>
<tr>
<td>File Name:</td>
<td align="center"><input type="text" VALUE="<?php print $filename; ?>" name="filename" size="20" maxlength="20"></td>
</tr>
<tr>
</tr>


<tr>
<td>Choose an option:</td>
<td ><input type="submit" name="delete" value="Delete"></td>

</tr>
</table>
</form>

<form action="Project2animalimage.php" method="POST" enctype="multipart/form-data">
	File:
	<input type="file" name="image"> <input type="submit" value = "Upload">
</form>



<?php
// Address error handling

ini_set('display_errors',1);
error_reporting(E_ALL & ~E_NOTICE);
//Attempt to Connect

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

	mysql_query("INSERT INTO ANIMALIMAGES VALUES('$id', '$image_name', '$image')");
	echo "New record inserted<br>";
	$lastID=mysql_insert_id();
	echo "Image uploaded.<p/>Your Image is: <p/><img src=getImage.php?id=$lastID width=100 height=100 >";
	
	}
}

?>

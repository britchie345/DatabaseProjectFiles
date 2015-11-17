<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel ="stylesheet" type="text/css" href="format2.css" />

<body background="a.jpg">

<html>

<body>



 <?php include("connect2.php"); ?>

 
 
<style type="text/css">
.style2 {
				text-align: center;
}
</style>

<p><a href="http://acadweb1.salisbury.edu/~br2214/Project2/Project2Home.php">
<img alt="" src="spca.jpg" width="237" height="157" class="style3" /></a>&nbsp;</p>
</p>

<?php
$animal_ID  = $_POST['animal_ID'];
$animal_name = $_POST['animal_name'];
$type = $_POST['type'];
$DOB = $_POST['DOB'];
$gender = $_POST['gender'];
$size = $_POST['size'];
$days = $_POST['days'];
?>

<form method="post" action="<?php echo $PHP_SELF;?>">

<table align="center" border="0">
<tr bgcolor="#c0c0c0">
<td align="center"><head>Animal Maintenance</head>
</tr>
<tr>
<td>Animal ID:</td>
<td align="center"><input type="text" VALUE="<?php print $animal_ID; ?>" name="animal_ID" size="3" maxlength="4"></td>
</tr>
<tr>
<td>Animal Name:</td>
<td align="center"><input type="text" VALUE="<?php print $animal_name; ?>" name="animal_name" size="3" maxlength="20"></td>
</tr>
<tr>
<td>Type:</td>
<td align="center"><input type="text" VALUE="<?php print $type; ?>" name="type" size="3" maxlength="3"></td>
</tr>
<tr>
<td>DOB:</td>
<td align="center"><input type="text" VALUE="<?php print $DOB; ?>" name="DOB" size="10" maxlength="12"></td>
</tr>
<tr>
<td>Gender:</td>
<td align="center"><input type="text" VALUE="<?php print $gender; ?>" name="gender" size="3" maxlength="3"></td>
</tr>
<tr>
<td>Size:</td>
<td align="center"><input type="text" VALUE="<?php print $size ?>" name="size" size="3" maxlength="14"></td>
</tr>
<td>Days spent in shelter:</td>
<td align="center"><input type="text" VALUE="<?php print $days ?>" name="days" size="3" maxlength="14"></td>
</tr>
<?php
/*
<td>Adopt Date:</td>
<td align="center"><input type="text" VALUE="<?php print $trait ?>" name="trait" size="3" maxlength="14"></td>
</tr>
<td>Return Date:</td>
<td align="center"><input type="text" VALUE="<?php print $trait ?>" name="trait" size="3" maxlength="14"></td>
</tr>
*/?>
<tr>
<td>Choose an option:</td>
<td colspan="2" ><input type="submit" name="insert" value="Insert"></td>
<td ><input type="submit" name="modify" value="Modify"></td>
<td ><input type="submit" name="delete" value="Delete"></td>
<td ><input type="submit" name="retrieve" value="Retrieve"></td>
</tr>
</table>

</form>



<?php 

$animal_ID  = $_POST['animal_ID'];
$animal_name = $_POST['animal_name'];
$type = $_POST['type'];
$DOB = $_POST['DOB'];
$gender = $_POST['gender'];
$size = $_POST['size'];
$days = $_POST['days'];

if(isset($_POST['insert']))
{
$query = "INSERT INTO `ANIMAL`(`ANIMALID`, `NAME`, `SIZE`, `SHELTERDAYS`, 
`DOB`, `Gender`, `ANIMALTYPE`) VALUES ('$animal_ID','$animal_name','$size','$days','$DOB','$gender','$type')";

$result=mysql_query($query);
if (!$result)die('
  <script type="text/javascript">
    alert("Please fill all boxes with a valid response.");
  </script>
<?php');

echo 'Row inserted.';
}



if(isset($_POST['delete']))
{

echo'
  <script type="text/javascript">
    alert("Are you sure? Press the back button if not.");
  </script>';

$query = "DELETE FROM ANIMAL WHERE ANIMALID = $animal_ID";

$result=mysql_query($query);
if (!$result)die('
  <script type="text/javascript">
    alert("Enter a valid number.");
  </script>
<?php');

echo 'Row deleted.';
}

if(isset($_POST['retrieve']))
{

$query = "Select * FROM ANIMAL WHERE ANIMALID = '$animal_ID'";

if($r = mysql_fetch_array($r))
{
$row['NAME'] = $animal_name;
$row['SIZE'] = $size;
$row['SHELTERDAYS'] = $days;
$row['DOB'] = $DOB;
$row['Gender'] = $gender;
$row['TYPE'] = $type;
}

}

if(isset($_POST['modify']))
{


$query = "UPDATE ANIMAL SET `ANIMALID`='$animal_ID',NAME='$animal_name',
SIZE='$size',DOB='$DOB',Gender='$gender', ANIMALTYPE='$type', SHELTERDAYS='$days' WHERE ANIMALID = $animal_ID";

$result=mysql_query($query);
if (!$result)die('
  <script type="text/javascript">
    alert("Please fill all boxes with a valid response.");
  </script>
<?php');


echo 'Row updated.';
}

$query = "SELECT * FROM ANIMAL";

echo '<center><font size = 8>Current Animals</center></font>';

$brian= mysql_query($query) or die('
  <script type="text/javascript">
    alert("Please enter all forms correctly to perform maintenance.");
  </script>
<?php');

echo '<table align="center" border = 1>';

echo '<thead><tr>
	<th>Animal ID</th><th>Name</th><th>Size
	</th><th>Days at Shelter </th><th>DOB </th><th>Gender </th><th>Type </th></thead>';

while($row = mysql_fetch_assoc($brian)) 
{
    echo '<tr>';
    foreach($row as $cvalue) {
        print '<td>'.$cvalue.'</td>';
    }
    echo '</tr>';
}
echo '</table>';


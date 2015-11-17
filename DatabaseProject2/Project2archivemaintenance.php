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
$adopt = $_POST['adopt'];
$return = $_POST['return'];
$description = $_POST['description'];
$days = $_POST['days'];
?>

<form method="post" action="<?php echo $PHP_SELF;?>">

<table align="center" border="0">
<tr bgcolor="#c0c0c0">
<td align="center"><head>Animal Archive Maintenance</head>
</tr>
<tr>
<td>Animal ID:</td>
<td align="center"><input type="text" VALUE="<?php print $animal_ID; ?>" name="animal_ID" size="3" maxlength="4"></td>
</tr>
<tr>
<td>Adopt Date:</td>
<td align="center"><input type="text" VALUE="<?php print $adopt; ?>" name="adopt" size="10" maxlength="12"></td>
</tr>
<tr>
<td>Return Date:</td>
<td align="center"><input type="text" VALUE="<?php print $return; ?>" name="return" size="10" maxlength="12"></td>
</tr>
<tr>
<td>Description:</td>
<td align="center"><input type="text" VALUE="<?php print $description; ?>" name="description" size="40" maxlength="40"></td>
</tr>
<td>Days spent in shelter:</td>
<td align="center"><input type="text" VALUE="<?php print $days ?>" name="days" size="3" maxlength="14"></td>
</tr>

<tr>
<td>Choose an option:</td>
<td><input type="submit" name="insert" value="Insert"></td>
<td ><input type="submit" name="modify" value="Modify"></td>
<td ><input type="submit" name="delete" value="Delete"></td>
<td ><input type="submit" name="retrieve" value="Retrieve"></td>
</tr>
</table>
</form>



<?php

$animal_ID  = $_POST['animal_ID'];
$adopt = $_POST['adopt'];
$return = $_POST['return'];
$description = $_POST['description'];
$days = $_POST['days'];

if(isset($_POST['insert']))
{
$query = "INSERT INTO `ANIMALARCHIVE`(`ANIMALID`, `ADOPTDATE`,
`RETURNDATE`, `DESCRIPTION`, `SHELTERDAYS`) VALUES ('$animal_ID','$adopt','$return','$description','$days')";

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

$query = "DELETE FROM ANIMALARCHIVE WHERE ANIMALID = $animal_ID";

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

$query = "Select * FROM ANIMALARCHIVE WHERE ANIMALID = '$animal_ID'";

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

$query = "UPDATE ANIMALARCHIVE SET `ANIMALID`='$animal_ID',ADOPTDATE='$adopt',
RETURNDATE='$return',DESCRIPTION='$description', SHELTERDAYS='$days' WHERE ANIMALID = $animal_ID AND ADOPTDATE='$adopt'";

$result=mysql_query($query);
if (!$result)die('
  <script type="text/javascript">
    alert("Please fill all boxes with a valid response.");
  </script>
<?php');


echo 'Row updated.';
}

$query = "SELECT * FROM ANIMALARCHIVE";

echo '<center><font size = 8>Current Animals</center></font>';

$brian= mysql_query($query) or die('
  <script type="text/javascript">
    alert("Please enter all forms correctly to perform maintenance.");
  </script>
<?php');

echo '<table align="center" border = 1>';

echo '<thead><tr>
	<th>Animal ID</th><th>Adopt Date</th><th>Return Date
	</th><th>Description </th><th>Days at Shelter </th></thead>';

while($row = mysql_fetch_assoc($brian))
{
    echo '<tr>';
    foreach($row as $cvalue) {
        print '<td>'.$cvalue.'</td>';
    }
    echo '</tr>';
}
echo '</table>';


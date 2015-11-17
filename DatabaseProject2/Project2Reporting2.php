<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel ="stylesheet" type="text/css" href="format2.css" />



<html>

<body>

 <?php include("connect2.php"); ?>

<p><a href="http://acadweb1.salisbury.edu/~br2214/Project2/Project2Home.php">
<img alt="" src="spca.jpg" width="237" height="157" class="style3" /></a>&nbsp;</p>
<body background="a.jpg">

<?php
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
?>

<form method="post" action="<?php echo $PHP_SELF;?>">

<table align="center" border="0">
<tr bgcolor="#c0c0c0">
<td align="center"><head>Animals that need medical procedures</head>
</tr>
<tr>
<td>Enter a medical procedure ID:</td>
<td align="center"><input type="text" VALUE="<?php print $date1; ?>" name="date1" size="10" maxlength="10"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="shot" value="Find Animals that need this shot"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="med" value="Find Animals that need this medication"></td>
</tr>
</table>

</form>



<?php 

if(isset($_POST['shot'])){


$date1 = $_POST['date1'];
$date2 = $_POST['date2'];


$query = "SELECT DISTINCT(ANIMAL.ANIMALID), NAME
FROM ANIMAL, ANIMALSHOTS
WHERE SHOTID !='$date1'
AND ANIMAL.ANIMALID = ANIMALSHOTS.ANIMALID
LIMIT 0 , 30";

}

if(isset($_POST['med'])){



$date1 = $_POST['date1'];
$date2 = $_POST['date2'];




$query = "SELECT DISTINCT(ANIMAL.ANIMALID), NAME
FROM ANIMAL, ANIMALMEDS
WHERE MEDICINEID !='$date1'
AND ANIMAL.ANIMALID = ANIMALMEDS.ANIMALID
LIMIT 0 , 30";

}


$brian= mysql_query($query) or die('
  <script type="text/javascript">
    alert("Please enter a customer number or ALL.");
  </script>
<?php');

echo '<table align="center" border = 1>';

echo '<thead><tr>
	<th>Animal ID</th><th>Name</th>
	</tr></thead>';

while($row = mysql_fetch_assoc($brian)) 
{
    echo '<tr>';
    foreach($row as $cvalue) {
        print '<td>'.$cvalue.'</td>';
    }
    echo '</tr>';
}
echo '</table>';






?>

</body>



</html>
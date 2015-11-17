<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel ="stylesheet" type="text/css" href="format2.css" />



<html>

<body>

 <?php include("connect2.php"); ?>

<p><a href="http://acadweb1.salisbury.edu/~br2214/Project2Home.php">
<img alt="" src="spca.jpg" width="237" height="157" class="style3" /></a>&nbsp;</p>
<body background="a.jpg">

<?php
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
?>

<form method="post" action="<?php echo $PHP_SELF;?>">

<table align="center" border="0">
<tr bgcolor="#c0c0c0">
<td align="center"><head>Animals Adopted by Time Period</head>
</tr>
<tr>
<td>Enter start search date:</td>
<td align="center"><input type="text" VALUE="<?php print $date1; ?>" name="date1" size="10" maxlength="10"></td>
</tr>
<tr>
<td>Enter end search date:</td>
<td align="center"><input type="text" VALUE="<?php print $date2; ?>" name="date2" size="10" maxlength="10"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="Submit"></td>
</tr>
</table>

</form>



<?php 

if(isset($_POST['date1']) && isset($_POST['date1'])){



$date1 = $_POST['date1'];
$date2 = $_POST['date2'];




$query = "SELECT * FROM `ANIMALARCHIVE`";


$brian= mysql_query($query) or die('
  <script type="text/javascript">
    alert("Please enter a customer number or ALL.");
  </script>
<?php');

echo '<table align="center" border = 1>';

echo '<thead><tr>
	<th>Animal ID</th><th>Adopt Date</th><th>Return Date</th><th>Days in Shelter</th><th>Description
	</th>
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

}




?>

</body>



</html>
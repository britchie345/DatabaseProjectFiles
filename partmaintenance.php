<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel ="stylesheet" type="text/css" href="format2.css" />



<html>

<body>

 <?php include("connect.php"); ?>

 
 
<style type="text/css">
.style2 {
				text-align: center;
}
</style>

<h1 class="style2">Premiere Products</h1>
<p><a href="http://acadweb1.salisbury.edu/~br2214/Project1Home.html">
<p class="style2"><img alt="" src="Appliances.png" width="334" height="250" class="style3" /></a>&nbsp;
</p>

<?php
$customer_num  = $_POST['customer_num'];
$customer_name = $_POST['customer_name'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
?>

<form method="post" action="<?php echo $PHP_SELF;?>">

<table align="center" border="0">
<tr bgcolor="#c0c0c0">
<td align="center"><head>Part Maintenance</head>
</tr>
<tr>
<td>PART_NUM:</td>
<td align="center"><input type="text" VALUE="<?php print $customer_num; ?>" name="customer_num" size="3" maxlength="4"></td>
</tr>
<tr>
<td>DESCRIPTION:</td>
<td align="center"><input type="text" VALUE="<?php print $customer_name; ?>" name="customer_name" size="3" maxlength="20"></td>
</tr>
<tr>
<td>ON_HAND:</td>
<td align="center"><input type="text" VALUE="<?php print $street; ?>" name="street" size="3" maxlength="3"></td>
</tr>
<tr>
<td>CLASS:</td>
<td align="center"><input type="text" VALUE="<?php print $city; ?>" name="city" size="3" maxlength="4"></td>
</tr>
<tr>
<td>WAREHOUSE:</td>
<td align="center"><input type="text" VALUE="<?php print $state; ?>" name="state" size="3" maxlength="3"></td>
</tr>
<tr>
<td>PRICE:</td>
<td align="center"><input type="text" VALUE="<?php print $zip ?>" name="zip" size="3" maxlength="14"></td>
</tr>
<tr>
<td>Choose an option:</td>
<td colspan="2" ><input type="submit" name="insert" value="Insert"></td>
<td ><input type="submit" name="modify" value="Modify"></td>
<td ><input type="submit" name="delete" value="Delete"></td>
</tr>
</table>

</form>



<?php 



$customer_num  = $_POST['customer_num'];
$customer_name = $_POST['customer_name'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
if(isset($_POST['insert']))
{
$query = "INSERT INTO `PART`(`PART_NUM`, `DESCRIPTION`, `ON_HAND`, `CLASS`, `WAREHOUSE`, `PRICE`) 
VALUES ($customer_num,$customer_name,$street,$city,$state,$zip)";

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

$query = "DELETE FROM PART WHERE PART_NUM = $customer_num";

$result=mysql_query($query);
if (!$result)die('
  <script type="text/javascript">
    alert("Enter a valid number.");
  </script>
<?php');

echo 'Row deleted.';
}

if(isset($_POST['modify']))
{
$query = "UPDATE PART SET `PART_NUM`=$customer_num,DESCRIPTION=$customer_name,
ON_HAND=$street,CLASS=$city,WAREHOUSE=$state, PRICE=$zip WHERE PART_NUM = $customer_num";

$result=mysql_query($query);
if (!$result)die('
  <script type="text/javascript">
    alert("Please fill all boxes with a valid response.");
  </script>
<?php');

echo 'Row updated.';
}

$query = "SELECT * FROM PART";



$brian= mysql_query($query) or die('
  <script type="text/javascript">
    alert("Please enter a customer number.");
  </script>
<?php');

echo '<table align="center" border = 1>';

echo '<thead><tr>
	<th>PART_NUM</th><th>DESCRIPTION</th><th>ON_HAND
	</th><th>CLASS </th><th>WAREHOUSE </th><th>PRICE </th></thead>';

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
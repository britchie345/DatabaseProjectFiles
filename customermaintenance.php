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
$balance = $_POST['balance'];
$credit_limit = $_POST['credit_limit'];
$rep_num = $_POST['rep_num'];
?>


<form method="post" action="<?php echo $PHP_SELF;?>">

<table align="center" border="0">
<tr bgcolor="#c0c0c0">
<td align="center"><head>Customer Maintenance</head>
</tr>
<tr>
<td>CUSTOMER_NUM:</td>
<td align="center"><input type="text" VALUE="<?php print $customer_num; ?>" name="customer_num" size="3" maxlength="3"></td>
</tr>
<tr>
<td>CUSTOMER_NAME:</td>
<td align="center"><input type="text" VALUE="<?php print $customer_name; ?>" name="customer_name" size="3" maxlength="40"></td>
</tr>
<tr>
<td>STREET:</td>
<td align="center"><input type="text" VALUE="<?php print $street; ?>" name="street" size="3" maxlength="20"></td>
</tr>
<tr>
<td>CITY:</td>
<td align="center"><input type="text" VALUE="<?php print $city; ?>" name="city" size="3" maxlength="11"></td>
</tr>
<tr>
<td>STATE:</td>
<td align="center"><input type="text" VALUE="<?php print $state; ?>" name="state" size="3" maxlength="11"></td>
</tr>
<tr>
<td>ZIP:</td>
<td align="center"><input type="text" VALUE="<?php print $zip; ?>" name="zip" size="3" maxlength="11"></td>
</tr>
<tr>
<td>BALANCE:</td>
<td align="center"><input type="text" VALUE="<?php print $balance; ?>" name="balance" size="3" maxlength="11"></td>
</tr>
<tr>
<td>CREDIT_LIMIT:</td>
<td align="center"><input type="text" VALUE="<?php print $credit_limit; ?>" name="credit_limit" size="3" maxlength="11"></td>
</tr>
<tr>
<td>REP_NUM:</td>
<td align="center"><input type="text" VALUE="<?php print $rep_num; ?>" name="rep_num" size="3" maxlength="11"></td>
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

mysql_query("LOCK TABLES CUSTOMER WRITE;");

$customer_num  = $_POST['customer_num'];
$customer_name = $_POST['customer_name'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$balance = $_POST['balance'];
$credit_limit = $_POST['credit_limit'];
$rep_num = $_POST['rep_num'];

if(isset($_POST['insert']))
{
$query = "INSERT INTO `CUSTOMER`(`CUSTOMER_NUM`, `CUSTOMER_NAME`, `STREET`, `CITY`, `STATE`, `ZIP`, `BALANCE`, `CREDIT_LIMIT`, `REP_NUM`) 
VALUES ($customer_num,$customer_name,$street,$city,$state,$zip,$balance,$credit_limit,$rep_num)";

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

$query = "DELETE FROM CUSTOMER WHERE CUSTOMER_NUM = $customer_num";

$result=mysql_query($query);
if (!$result)die('
  <script type="text/javascript">
    alert("Enter a customer number.");
  </script>
<?php');

echo 'Row deleted.';
}

if(isset($_POST['modify']))
{
$query = "UPDATE `CUSTOMER` SET `CUSTOMER_NUM`=$customer_num,`CUSTOMER_NAME`=$customer_name,
`STREET`=$street,`CITY`=$city,`STATE`=$state, `ZIP`=$zip,`BALANCE`=$balance,
`CREDIT_LIMIT`=$credit_limit,`REP_NUM`=$rep_num WHERE CUSTOMER_NUM = $customer_num";

$result=mysql_query($query);
if (!$result)die('
  <script type="text/javascript">
    alert("Please fill all boxes with a valid response.");
  </script>
<?php');

echo 'Row modified.';
}

$query = "SELECT * FROM CUSTOMER";



$brian= mysql_query($query) or die('
  <script type="text/javascript">
    alert("Please enter a customer number.");
  </script>
<?php');

echo '<table align="center" border = 1>';

echo '<thead><tr>
	<th>CUSTOMER_NUM</th><th>CUSTOMER_NAME</th><th>STREET
	</th><th>CITY </th><th>STATE </th><th>ZIP </th><th>BALANCE </th><th>CREDIT_LIMIT </th><th>REP_NUM </th></thead>';

while($row = mysql_fetch_assoc($brian)) 
{
    echo '<tr>';
    foreach($row as $cvalue) {
        print '<td>'.$cvalue.'</td>';
    }
    echo '</tr>';
}
echo '</table>';


mysql_query("UNLOCK TABLES;");



?>
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
$customer = $_POST['customer'];
?>

<form method="post" action="<?php echo $PHP_SELF;?>">

<table align="center" border="0">
<tr bgcolor="#c0c0c0">
<td align="center"><head>Customer Order History</head>
</tr>
<tr>
<td>Enter customer number to display order history:</td>
<td align="center"><input type="text" VALUE="<?php print $customer; ?>" name="customer" size="3" maxlength="3"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="Submit Order"></td>
</tr>
</table>

</form>



<?php 

if(isset($_POST['customer'])){



$customer = $_POST['customer'];




$query = "SELECT CUSTOMER_NUM, ORDER_DATE, ORDERS.ORDER_NUM,PART_NUM, NUM_ORDERED, QUOTED_PRICE FROM 
ORDERS, ORDER_LINE WHERE $customer = CUSTOMER_NUM AND ORDERS.ORDER_NUM = ORDER_LINE.ORDER_NUM";



$brian= mysql_query($query) or die('
  <script type="text/javascript">
    alert("Please enter a customer number.");
  </script>
<?php');

echo '<table align="center" border = 1>';

echo '<thead><tr>
	<th>CUSTOMER_NUM</th><th>ORDER_DATE</th><th>ORDER_NUM</th><th>PART_NUM
	</th><th>NUM_ORDERED </th><th>QUOTED_PRICE </th></thead>';

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

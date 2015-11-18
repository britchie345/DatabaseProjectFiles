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
<td align="center"><head>Print Order Form</head>
</tr>
<tr>
<td>Enter an order number to print:</td>
<td align="center"><input type="text" VALUE="<?php print $customer; ?>" name="customer" size="6" maxlength="6"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="Submit Order"></td>
</tr>
</table>

</form>



<?php 

if(isset($_POST['customer'])){

echo '<h1 class="style2">------------------------------------------------------------</h1>';
echo '<h1 class="style2">Premiere Products</h1>';

$customer = $_POST['customer'];

$query2 = "SELECT DISTINCT(ORDERS.ORDER_NUM), ORDER_DATE, CUSTOMER.CUSTOMER_NUM, CUSTOMER.REP_NUM
FROM ORDERS, ORDER_LINE, CUSTOMER
WHERE $customer = ORDERS.ORDER_NUM AND ORDERS.CUSTOMER_NUM = CUSTOMER.CUSTOMER_NUM
AND ORDERS.ORDER_NUM = ORDER_LINE.ORDER_NUM";

$brian= mysql_query($query2) or die();

echo '<table align="center">';

echo '<thead><th>Order:   
	</th><th>Date:     </th><th>Customer:     </th><th>Sales Rep:
	</th></thead>';

while($row = mysql_fetch_assoc($brian)) 
{
    echo '<tr>';
    foreach($row as $cvalue) {
        print '<td>'.$cvalue.'</td>';
    }
    echo '</tr>';
}
echo '</table>';


$query = "SELECT PART_NUM, NUM_ORDERED, QUOTED_PRICE, (
NUM_ORDERED * QUOTED_PRICE
) AS TOTAL
FROM ORDERS, ORDER_LINE, CUSTOMER
WHERE $customer = ORDERS.ORDER_NUM AND ORDERS.CUSTOMER_NUM = CUSTOMER.CUSTOMER_NUM
AND ORDERS.ORDER_NUM = ORDER_LINE.ORDER_NUM";



$brian= mysql_query($query) or die('
  <script type="text/javascript">
    alert("Please enter a customer number.");
  </script>
<?php');



echo '<table align="center" border =1>';

echo '<thead><th>PART_NUM    
	</th><th>NUM_ORDERED     </th><th>QUOTED_PRICE     </th><th>TOTAL
	</th></thead>';

while($row = mysql_fetch_assoc($brian)) 
{
    echo '<tr>';
    foreach($row as $cvalue) {
        print '<td>'.$cvalue.'</td>';
    }
    echo '</tr>';
}
echo '</table>';

$sql =  "SELECT (
NUM_ORDERED * QUOTED_PRICE
) AS TOTAL
FROM ORDERS, ORDER_LINE, CUSTOMER
WHERE $customer = ORDERS.ORDER_NUM AND ORDERS.CUSTOMER_NUM = CUSTOMER.CUSTOMER_NUM
AND ORDERS.ORDER_NUM = ORDER_LINE.ORDER_NUM";
$q = mysql_query($sql);
$total = 0;
echo '<center>Total Order Cost: $';
while($row = mysql_fetch_assoc($q)) 
{

    foreach($row as $cvalue) {
        $total = $total + $cvalue;
    }

}

echo $total;

echo '<h1 class="style2">------------------------------------------------------------</h1>';
}




?>
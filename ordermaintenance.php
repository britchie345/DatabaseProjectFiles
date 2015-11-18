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
$order_num  = $_POST['order_num'];
$order_date = $_POST['order_date'];
$customer_num = $_POST['customer_num'];
$part_num = $_POST['part_num'];
$num_ordered = $_POST['num_ordered'];
$quoted_price = $_POST['quoted_price'];
?>


<form method="post" action="<?php echo $PHP_SELF;?>">

<table align="center" border="0">
<tr bgcolor="#c0c0c0">
<td align="center"><head>Order Maintenance</head>
</tr>
<tr>
<td>ORDER_NUM:</td>
<td align="center"><input type="text" VALUE="<?php print $order_num; ?>" name="order_num" size="3" maxlength="3"></td>
</tr>
<tr>
<td>ORDER_DATE:</td>
<td align="center"><input type="text" VALUE="<?php print $order_date; ?>" name="order_date" size="3" maxlength="10"></td>
</tr>
<tr>
<td>CUSTOMER_NUM:</td>
<td align="center"><input type="text" VALUE="<?php print $customer_num; ?>" name="customer_num" size="3" maxlength="3"></td>
</tr>
<tr>
<td>PART_NUM:</td>
<td align="center"><input type="text" VALUE="<?php print $part_num; ?>" name="part_num" size="3" maxlength="4"></td>
</tr>
<tr>
<td>NUM_ORDERED:</td>
<td align="center"><input type="text" VALUE="<?php print $num_ordered; ?>" name="num_ordered" size="3" maxlength="3"></td>
</tr>
<tr>
<td>QUOTED_PRICE:</td>
<td align="center"><input type="text" VALUE="<?php print $quoted_price; ?>" name="quoted_price" size="3" maxlength="13"></td>
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

$order_num  = $_POST['order_num'];
$order_date = $_POST['order_date'];
$customer_num = $_POST['customer_num'];
$part_num = $_POST['part_num'];
$num_ordered = $_POST['num_ordered'];
$quoted_price = $_POST['quoted_price'];

if(isset($_POST['insert']))
{
$query = "INSERT INTO ORDERS(`ORDER_NUM`, `ORDER_DATE`, `CUSTOMER_NUM`) 
VALUES ($order_num,'$order_date',$customer_num)";

$result=mysql_query($query);
if (!$result)die('
  <script type="text/javascript">
    alert("Please fill all boxes with a valid response.");
  </script>
<?php');

$query = "INSERT INTO `ORDER_LINE`(`ORDER_NUM`, `PART_NUM`, `NUM_ORDERED`, `QUOTED_PRICE`) 
VALUES ($order_num, $part_num, $num_ordered, $quoted_price)";

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

$query = "DELETE FROM ORDERS WHERE ORDER_NUM = $order_num";

$result=mysql_query($query);
if (!$result)die('
  <script type="text/javascript">
    alert("Enter a customer number.");
  </script>
<?php');

$query = "DELETE FROM ORDER_LINE WHERE ORDER_NUM = $order_num";

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
$query = "UPDATE `ORDERS` SET `ORDER_NUM`=$order_num,`ORDER_DATE`='$order_date',
`CUSTOMER_NUM`=$customer_num WHERE ORDER_NUM = $order_num";

$result=mysql_query($query);
if (!$result)die('
  <script type="text/javascript">
    alert("Please fill all boxes with a valid response.");
  </script>
<?php');

$query = "UPDATE `ORDER_LINE` SET `ORDER_NUM`=$order_num,`PART_NUM`=$part_num,
`NUM_ORDERED`=$num_ordered,`QUOTED_PRICE`=$quoted_price WHERE ORDER_NUM = $order_num";

$result=mysql_query($query);
if (!$result)die('
  <script type="text/javascript">
    alert("Please fill all boxes with a valid response.");
  </script>
<?php');

echo 'Row modified.';
}



$query = "SELECT CUSTOMER_NUM, ORDER_DATE, ORDERS.ORDER_NUM, PART_NUM, NUM_ORDERED, QUOTED_PRICE FROM ORDERS, ORDER_LINE
WHERE ORDERS.ORDER_NUM = ORDER_LINE.ORDER_NUM";



$brian= mysql_query($query) or die('
  <script type="text/javascript">
    alert("Please enter a customer number.");
  </script>
<?php');

echo '<table align="center" border = 1>';

echo '<thead><tr>
	<th>ORDER_NUM</th><th>ORDER_DATE</th><th>CUSTOMER_NUM
	</th><th>PART_NUM </th><th>NUM_ORDERED </th><th>QUOTED_PRICE </th></thead>';

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
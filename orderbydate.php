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
$num = $_POST['num'];
$date = $_POST['date'];
?>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">

<table align="center" border="0">
<tr bgcolor="#c0c0c0">
<td align="center"><head>Find Order By Date</head>
</tr>
<tr>
<td>Choose an order number:</td>
<td align="center"><input type="text" VALUE="<?php print $num; ?>" name="num" size="6" maxlength="6"></td>
</tr>
<tr>
<td>Choose an order date:</td>
<td align="center"><input type="text" VALUE="<?php print $date; ?>" name="date" size="10" maxlength="10"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="Submit Order"></td>
</tr>
</table>

</form>



<?php 




if(isset($_POST['num'])){
if(isset($_POST['date'])){




$num = $_POST['num'];
$date = $_POST['date'];




$query = "SELECT ORDER_DATE, ORDERS.ORDER_NUM, CUSTOMER_NUM,PART_NUM, NUM_ORDERED, QUOTED_PRICE FROM 
ORDERS, ORDER_LINE WHERE ORDER_DATE = '$date' AND ORDERS.ORDER_NUM = $num AND ORDERS.ORDER_NUM = ORDER_LINE.ORDER_NUM";

}}

$brian= mysql_query($query) or die('
  <script type="text/javascript">
    alert("Please re-enter valid data.");
  </script>
<?php');

if ($date[4] != '-' && $date[7] != '-' && $date[9] != '-')
{ echo '
  <script type="text/javascript">
    alert("Please enter the date in the correct format.");
  </script>
<?php'; }

else{
echo '<table align="center" border = 1>';


echo '<thead><tr>
	<th>ORDER_DATE</th><th>ORDER_NUM</th><th>CUSTOMER_NUM</th><th>PART_NUM
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

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


<form method="post" action="<?php echo $PHP_SELF;?>">

<table align="center" border="0">
<tr bgcolor="#c0c0c0">
<td align="center"><head>Customer Listing</head>
</tr>
<tr>
<td>Enter customer number or ALL:</td>
<td align="center"><input type="text" VALUE="<?php $customer ?>" name="customer" size="3" maxlength="3"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="Submit Order"></td>
</tr>
</table>


</form>



<?php 

if(isset($_POST['customer'])){



$customer = $_POST['customer'];



if ($customer == 'All' || $customer == 'ALL' || $customer == 'all')
{
$query = "SELECT * FROM CUSTOMER";
}
else 
{
$query = "SELECT CUSTOMER_NUM, CUSTOMER_NAME,STREET, CITY, STATE, ZIP, BALANCE, CREDIT_LIMIT, REP_NUM FROM 
CUSTOMER WHERE $customer = CUSTOMER_NUM";


}

$brian= mysql_query($query) or die('
  <script type="text/javascript">
    alert("Please enter a customer number or ALL.");
  </script>
<?php');

echo '<table align="center" border = 1>';

echo '<thead><tr>
	<th>CUSTOMER_NUM</th><th>CUSTOMER_NAME</th><th>STREET</th><th>CITY</th><th>STATE
	</th><th>ZIP </th><th>BALANCE </th><th>CREDIT_LIMIT</th><th>REP_NUM</th>
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
<html>
<head>
<title>Bob's Auto Parts - Order Results</title>
</head>
<body>
<h1>Bob's Auto Parts</h1>
<h2>Order Results</h2>
<?php
//create short variable names
$tireqty = $_POST['tireqty'];
$oilqty = $_POST['oilqty'];
$sparkqty = $_POST['sparkqty'];
?>
<?php
echo '<p>Order processed at.';
echo date('H:i,jS F');
echo'</p>';
echo '<p>Your order is as follows: </p>';
echo $tireqty. 'tires <br/>';
echo $oilqty. 'bottles of oil <br/>';
echo $sparkqty. 'spark plugs <br/>';

$totalqty = 0;
$totalqty = $tireqty + $oilqty + $sparkqty;
echo 'Items ordered: '.$totalqty.'<br/>';

if($totalqty==0)
{
echo 'You did not order anything on the previous page!<br/>';
}
else
{
if ($tireqty>0)
echo $tireqty.'tires<br/>';
if ($oilqty>0)
echo $oilqty.'bottles of oil<br/>';
if ($sparkqty>0)
echo $sparkqty.'spark plugs<br/>';
}

$totalamount = 0.00;

define('TIREPRICE',100);
define('OILPRICE',10);
define('SPARKPRICE',4);

$totalamount = $tireqty * TIREPRICE + $oilqty * OILPRICE + $sparkqty * SPARKPRICE;

echo 'Subtotal:$'.number_format($totalamount,2).'<br/>';

?>




</body>
</html>
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
$rep_num  = $_POST['rep_num'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$commission = $_POST['commission'];
$rate = $_POST['rate'];
?>

<form method="post" action="<?php echo $PHP_SELF;?>">

<table align="center" border="0">
<tr bgcolor="#c0c0c0">
<td align="center"><head>Representative Maintenance</head>
</tr>
<tr>
<td>REP_NUM:</td>
<td align="center"><input type="text" VALUE="<?php print $rep_num; ?>" name="rep_num" size="3" maxlength="3"></td>
</tr>
<tr>
<td>LAST_NAME:</td>
<td align="center"><input type="text" VALUE="<?php print $last_name; ?>" name="last_name" size="3" maxlength="20"></td>
</tr>
<tr>
<td>FIRST_NAME:</td>
<td align="center"><input type="text" VALUE="<?php print $first_name; ?>" name="first_name" size="3" maxlength="20"></td>
</tr>
<tr>
<td>STREET:</td>
<td align="center"><input type="text" VALUE="<?php print $street; ?>" name="street" size="3" maxlength="20"></td>
</tr>
<tr>
<td>CITY:</td>
<td align="center"><input type="text" VALUE="<?php print $city; ?>" name="city" size="3" maxlength="20"></td>
</tr>
<tr>
<td>STATE:</td>
<td align="center"><input type="text" VALUE="<?php print $state; ?>" name="state" size="3" maxlength="2"></td>
</tr>
<tr>
<td>ZIP:</td>
<td align="center"><input type="text" VALUE="<?php print $zip; ?>" name="zip" size="3" maxlength="5"></td>
</tr>
<tr>
<td>COMMISSION:</td>
<td align="center"><input type="text" VALUE="<?php print $commission; ?>" name="commission" size="3" maxlength="6"></td>
</tr>
<tr>
<td>RATE:</td>
<td align="center"><input type="text" VALUE="<?php print $rate; ?>" name="rate" size="3" maxlength="5"></td>
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

$rep_num  = $_POST['rep_num'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$commission = $_POST['commission'];
$rate = $_POST['rate'];

if(isset($_POST['insert']))
{
$query = "INSERT INTO `REP`(`REP_NUM`,`LAST_NAME`, `FIRST_NAME`, `STREET`, `CITY`, `STATE`, `ZIP`, `COMMISSION`, `RATE`) 
VALUES ($rep_num,$last_name,$first_name,$street,$city,$state,$zip,$commission,$rate)";

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

$query = "DELETE FROM REP WHERE REP_NUM = $rep_num";

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
$query = "UPDATE `REP` SET `REP_NUM`=$rep_num,`LAST_NAME`=$last_name,`FIRST_NAME`=$first_name,
`STREET`=$street,`CITY`=$city,`STATE`=$state, `ZIP`=$zip,`COMMISSION`=$commission,
`RATE`=$rate WHERE REP_NUM = $rep_num";

$result=mysql_query($query);
if (!$result)die('
  <script type="text/javascript">
    alert("Please fill all boxes with a valid response.");
  </script>
<?php');

echo 'Row modified.';
}



$query = "SELECT * FROM REP";



$brian= mysql_query($query) or die('
  <script type="text/javascript">
    alert("Please enter a customer number.");
  </script>
<?php');

echo '<table align="center" border = 1>';

echo '<thead><tr>
	<th>REP_NUM</th><th>LAST_NAME</th><th>FIRST_NAME</th><th>STREET
	</th><th>CITY </th><th>STATE </th><th>ZIP </th><th>COMMISSION </th><th>RATE </th></thead>';

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

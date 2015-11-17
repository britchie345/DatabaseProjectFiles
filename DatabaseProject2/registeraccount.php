<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel ="stylesheet" type="text/css" href="format2.css" />

<body background="a.jpg">

<html>

<body>



 <?php include("connect2.php"); ?>

 
 
<style type="text/css">
.style2 {
				text-align: center;
}
</style>

<?php
$ID  = $_POST['ID'];
$name = $_POST['name'];
$phone1 = $_POST['phone1'];
$phone2 = $_POST['phone2'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
?>

<form method="post" action="<?php echo $PHP_SELF;?>">

<p><a href="http://acadweb1.salisbury.edu/~br2214/Project2Home.php">
<img alt="" src="spca.jpg" width="237" height="157" class="style3" /></a>&nbsp;</p>
</p>

<br>
<td>ID:</td>
<td align="center"><input type="text" VALUE="<?php print $ID ?>" name="ID" size="3" maxlength="14"></td>
</tr>

<br>
<tr>
<td>Name:</td>
<td align="center"><input type="text" VALUE="<?php print $name ?>" name="name" size="3" maxlength="14"></td>
</tr>


<br>
<tr>
<td>Phone1:</td>
<td align="center"><input type="text" VALUE="<?php print $phone1 ?>" name="phone1" size="3" maxlength="14"></td>
</tr>

<br>
<tr>
<td>Phone2:</td>
<td align="center"><input type="text" VALUE="<?php print $phone2 ?>" name="phone2" size="3" maxlength="14"></td>
</tr>

<br>
<tr>
<td>Email:</td>
<td align="center"><input type="text" VALUE="<?php print $email ?>" name="email" size="3" maxlength="14"></td>
</tr>

<br>
<tr>
<td>Password:</td>
<td align="center"><input type="password" VALUE="<?php print $password ?>" name="password" size="3" maxlength="14"></td>
</tr>
<tr>
<td>Confirm password:</td>
<td align="center"><input type="password" VALUE="<?php print $password2 ?>" name="password2" size="3" maxlength="14"></td>
</tr>


<tr>
<td colspan="2" ><input type="submit" name="insert" value="Create Account"></td>

</table>

</form>

<?php 

$animal_ID  = $_POST['ID'];
$animal_name = $_POST['name'];
$type = $_POST['phone1'];
$DOB = $_POST['phone2'];
$size = $_POST['email'];
$days = $_POST['password'];
$days = $_POST['password2'];





if($password == $password2)
{
if(isset($_POST['insert']))
{
$query = "INSERT INTO `VISITORS`(`ID`, `NAME`, `PHONE1`, `PHONE2`, 
`EMAIL`, `PASSWORD`) VALUES ('$ID','$name','$phone1','$phone2','$email','$password')";

$result=mysql_query($query);
if (!$result)die('
  <script type="text/javascript">
    alert("Please fill all boxes with a valid response.");
  </script>
<?php');

echo 'Account Created.';
}
}
else
{

echo 'The passwords do not match.';

}
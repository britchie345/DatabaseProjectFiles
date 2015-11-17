<?php

session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$_SESSION['username'] = $username;
$_SESSION['password'] = $password;

Print_r($_SESSION);



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel ="stylesheet" type="text/css" />

<head>
</head>

 <?php include("connect2.php"); 


?>



<form method="post" action="<?php echo $PHP_SELF;?>">
<table border="0">
<tr>
<td>
<p><a href="http://acadweb1.salisbury.edu/~br2214/Project2/Project2Home.php">
<img alt="" src="spca.jpg" width="237" height="157" class="style3" /></a>&nbsp;</p>
</td>
<td>Email:</td>
<td align="center"><input type="text" VALUE="<?php print $_SESSION['username']; ?>"  name="username" size="20" maxlength="40"></td>
<td>Password:</td>
<td align="center"><input type="password" VALUE="<?php print $_SESSION['password']; ?>" name="password" size="20" maxlength="40"></td>

    
<td colspan="2" align="center"><input type="submit" name = "adminlogin" value="Admin Log in"></td>
<td colspan="2" align="center"><input type="submit" name = "login" value="Log in"></td>

<td><a href="http://acadweb1.salisbury.edu/~br2214/Project2/registeraccount.php">Register a new account.</a></td>

</tr>
</table>
</form>




<?php
$username = $_POST['username'];
$password = $_POST['password'];
$_SESSION['username'] = '$username';
$_SESSION['password'] = '$password';

if(isset($_POST['adminlogin']))
{
$query = " SELECT NAME
FROM EMPLOYEES
WHERE EMAIL =  '$username'
AND PASSWORD = '$password'
LIMIT 0 , 30";

$result = mysql_query($query) or die();

while($row = mysql_fetch_assoc($result)) 
{
    
	if (is_null($row["NAME"]))
         echo "No name data!";
	else{
    foreach($row as $cvalue) {
        print 'Hello Admin '.$cvalue.'<a href="http://acadweb1.salisbury.edu/~br2214/Project2/Project2Maintenance.php"> >>Begin Maintenance<< </a></p>
';}
    }
    
}


}
elseif(isset($_POST['login']))
{
$query = " SELECT `NAME` FROM `VISITORS` WHERE EMAIL =  '$username'
AND PASSWORD = '$password'
LIMIT 0 , 30";

$result = mysql_query($query) or die();

while($row = mysql_fetch_assoc($result)) 
{
    
    foreach($row as $cvalue) {
        print 'Hello Visitor '.$cvalue.'';
    }
    
}


}

else
	print 'Hello Visitor. Please Log on '.$cvalue.'';

?>

<body background="a.jpg">
<div>
<br />

<table border="2">
<tr>
<td>

<p><a href="http://acadweb1.salisbury.edu/~br2214/Project2/Project2Next.php">
<img alt="" src="dog_running.jpg" width="750" height="413" class="style3" /></a>&nbsp;



</td><td>
<a href="dogform.pdf">Download Adoption Form</a></p>
<a href="http://acadweb1.salisbury.edu/~br2214/Project2/aboutus.php">About Us</a>
</td>
</tr>


</table>

<center>Copyright © 2014 Delaware SPCA. All Rights Reserved.</center>
</body>


</html>
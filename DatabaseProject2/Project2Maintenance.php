<?php
session_start();

?>

<?php

$_SESSION['username'] = $username;
$username = $_SESSION['username'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>




<body background="a.jpg">
<center>
<p><a href="http://acadweb1.salisbury.edu/~br2214/Project2/Project2Home.php">
<img alt="" src="spca.jpg" width="237" height="157" class="style3" /></a>&nbsp;</p>

<?php print"<font size = 10> Welcome, admin Carl Sagan </font><br>"; ?>
<a href="http://acadweb1.salisbury.edu/~br2214/Project2/adoptivevisits.php">Adoptive Visitor maintenance</a></p>
<a href="http://acadweb1.salisbury.edu/~br2214/Project2/animalmaintenance.php">Animal maintenance</a></p>
<a href="http://acadweb1.salisbury.edu/~br2214/Project2/Project2archivemaintenance.php">Animal Archive maintenance</a></p>
<a href="http://acadweb1.salisbury.edu/~br2214/Project2/Project2animalimage.php">Animal Images maintenance</a></p>
<a href="http://acadweb1.salisbury.edu/~br2214/Project2/vetmaintenance.php">Veterinarian maintenance</a></p>
<a href="http://acadweb1.salisbury.edu/~br2214/Project2/medmaintenance.php">Medication maintenance</a></p>



<a href="http://acadweb1.salisbury.edu/~br2214/Project2/Project2Reporting1.php">Time Period Reporting</a></p>
</center>


</body>

</html>

<?php
$_SESSION['username']=$username;
?>
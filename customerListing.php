<html>
<head>
<title>Customer Listing</title>
</head>
<body>
<center>Customer Listing</center></body>
<form action="<php echo $_SERVER['PHP_SELF'];?> method="post">
Enter Customer Number to List or All:<input type="test" name ="cusnum" size = 3
value = "<?=$_POST['cusnum']?>">
<input type="submit" value="Get Report"><BR></form>
</body>
</html>
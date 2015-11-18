<?php
session_start();

$colors=array('red','yellow','blue');

$_SESSION['color']=$colors;
$_SESSION['size']='small';
$_SESSION['shape']='round';
print "Done";
?>


<?php
session_start();

print "Our color is ".$_SESSION['color'][0];
print "Our size is ".$_SESSION['size'];
print "Our shape is ".$_SESSION['shape'];
Print_r($_SESSION);
?>
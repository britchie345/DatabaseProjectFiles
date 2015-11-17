
<?
header('Content-disposition: attachment; filename='application.pdf');
header('Content-type: application/pdf');
readfile('application.pdf');
?>
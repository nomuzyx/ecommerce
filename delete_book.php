<?php
include 'mysqlcon.php';

$sql="DELETE FROM books WHERE isbn=".$_GET['isbn'];

mysqli_query($con,$sql);

if (!mysqli_query($con,$sql))
{
	die('Error: ' . mysqli_error($con));
}
mysqli_close($con);
header('Location: show_cat.php?catid='.$_GET['catid']);

?>
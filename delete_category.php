<?php
include 'mysqlcon.php';
$catid = $_GET['catid'];

$qry1 = "select * from books WHERE catid = '$catid'";
$result1 = mysqli_query($con,$qry1);
if (!$result1)
{
	$sql="DELETE FROM category WHERE catid=".$_GET['catid'];
	mysqli_query($con,$sql);

	if (!mysqli_query($con,$sql))
	{
		die('Error: ' . mysqli_error($con));
	}
	mysqli_close($con);
	header('Location: index.php');
}
else
{
	echo'Books Exist In This Category.Cannot be deleted.<br/>';
	echo'<p><a href = show_cat.php?catid='.$catid.'>Go to Show Category</p>'; 
}



?>
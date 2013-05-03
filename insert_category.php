<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add a Category</title>
</head>
<body style="background-color:lavender;">
<?php
include 'mysqlcon.php';
session_start();

if (!empty($_POST['catname']))
{
	$catname= $_POST['catname'];

	if(insert_category($catname,$con))
	{
		echo'Book '.stripslashes($catname).' was added to the database.<br/>';
		echo'<p><a href = "insert_category_form.php">Go to Add a Category Form</p>';
	}
	else
	{
		echo'Book '.stripslashes($catname).' could not be added to the database.<br/>';	
		echo'<p><a href = "insert_category_form.php">Go to Add a Category Form</p>';
	}
}	
else
{
	echo "You have not filled out the form. Please try again.";
	echo'<p><a href = "insert_category_form.php">Go to Add a Category Form</p>';
}

function insert_category($catname,$con)
{
	$qry = "insert into category values('','$catname')";

	$result = mysqli_query($con,$qry);

	if ($result)
	{
		return true;
	}
}
?>
<body>
</html>

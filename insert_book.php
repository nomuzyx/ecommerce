<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add a book</title>
</head>
<body style="background-color:lavender;">
<?php
include 'mysqlcon.php';
session_start();

if (!empty($_POST['isbn']) && !empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['catname']) && !empty($_POST['price']))
{
	$isbn   = $_POST['isbn'];
	$title  = $_POST['title'];
	$author = $_POST['author'];
	$catname= $_POST['catname'];
	$price  = $_POST['price'];
	$descrip= $_POST['descrip'];

	$qry    = "SELECT DISTINCT catname,catid FROM category WHERE catname='$catname'";

	$result = mysqli_query($con,$qry);

	$row = mysqli_fetch_array($result);

	$catid = $row['catid'];

	if(insert_book($isbn,$title,$author,$catid,$price,$descrip,$con))
	{
		echo'Book '.stripslashes($title).' was added to the database.<br/>';
		echo'<p><a href = "insert_book_form.php">Go to Add a book Form</p>';
	}
	else
	{
		echo'Book '.stripslashes($title).' could not be added to the database.<br/>';	
		echo'<p><a href = "insert_book_form.php">Go to Add a book Form</p>';

	}

}	
else
{
	echo "You have not filled out the form. Please try again.";
	echo'<p><a href = "insert_book_form.php">Go to Add a book Form</p>';
}

function insert_book($isbn,$title,$author,$catid,$price,$descrip,$con)
{
	$qry = "insert into books values($isbn,'$title','$author','$catid','$price','$descrip')";

	$result = mysqli_query($con,$qry);

	if ($result)
	{
		return true;
	}
}
?>
<body>
</html>

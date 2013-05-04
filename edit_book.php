<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit a book</title>
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

	if(update_book($isbn,$title,$author,$catid,$price,$descrip,$con))
	{
		echo'Book '.stripslashes($title).' was Updated to the database.<br/>';
		echo'<p><a href = show_book.php?isbn='.$isbn.'>Go to Show book</p>';
	}
	else
	{
		echo'Book '.stripslashes($title).' could not be updated to the database.<br/>';	
		echo'<p><a href = edit_book_form.php?isbn='.$isbn.'>Go to Edit book Form</p>';

	}

}	
else
{
	echo "You have not filled out the form. Please try again.";
	echo'<p><a href = edit_book_form.php?isbn='.$isbn.'>Go to Edit a book Form</p>';
}

function update_book($isbn,$title,$author,$catid,$price,$descrip,$con)
{
	$qry = "update books set title = '$title', author = '$author', catid = '$catid', price = '$price', descrip = '$descrip' WHERE isbn = '$isbn'";

	$result = mysqli_query($con,$qry);

	if ($result)
	{
		return true;
	}
}
?>
<body>
</html>

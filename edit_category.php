<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit a book</title>
</head>
<body style="background-color:lavender;">
<?php
include 'mysqlcon.php';
session_start();

if (!empty($_POST['catid']) && !empty($_POST['catname']) )
{
	$catid   = $_POST['catid'];
	$catname = $_POST['catname'];
	if(update_cat($catid,$catname,$con))
	{
		echo'Category '.stripslashes($catname).' was Updated to the database.<br/>';
		echo'<p><a href = show_cat.php?catid='.$catid.'>Go to Show Category</p>';
	}
	else
	{
		echo'Category '.stripslashes($catname).' could not be updated to the database.<br/>';	
		echo'<p><a href = edit_category_form.php?catid='.$catid.'>Go to Edit Category Form</p>';
	}
}	
else
{
	echo "You have not filled out the form. Please try again.";
	echo'<p><a href = edit_category_form.php?catid='.$catid.'>Go to Edit a Category Form</p>';
}

function update_cat($catid,$catname,$con)
{
	$qry = "update category set catname = '$catname' WHERE catid = '$catid'";

	$result = mysqli_query($con,$qry);

	if ($result)
	{
		return true;
	}
}
?>
<body>
</html>

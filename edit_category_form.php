<?php
	include 'mysqlcon.php';
	session_start();

	if (!isset($_SESSION['valid_user'])) 
	{
   		header("Location: login.php");
   		exit();
	}

	if (isset($_GET['logout'])) 
	{
		session_destroy();
		header("Location: login.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" typ e="text/css" href="css/bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css">
	<script src = "js/jquery.js"></script>
	<title>Edit a Category</title>
</head>

<?php

$catid = $_GET['catid'];

$qry='SELECT * FROM category where catid ='.$catid;

$result = mysqli_query($con,$qry);

$row = mysqli_fetch_array($result);

?>

<body style="background-color:lavender;">
<div class="container">	   
	<div class="row" style="background-color:skyblue;">	
		<div class="span6">
			<h1>Online Book Store</h1>
		</div>	
		<div class="span6">
			<p><a href="edit_book_form.php?logout=logout">Log Out</a></p>
		</div>
	</div>	
    <div class="row" style="margin-top:0%;padding:0%;">	
		<div class="span7">
			<form name="input" class="form-action" action="edit_category.php" style="margin:10%;" method="post">
				<p><Strong>Edit a Category</strong></p>
				<p><input type="text" class="span6" name="catid" value='<?php echo $row["catid"]; ?>' placeholder="Category ID" readonly></p>
	       	 	<p><input type="text" class="span6" name="catname" value='<?php echo $row["catname"]; ?>' placeholder="Category"></p>
	       		<?php
	       		if (isset($_SESSION['valid_user']))
				{
	       			echo'<p><button class="btn btn-success btn-small" type="submit">Update Category</button>';
	       			echo'&nbsp&nbsp&nbsp<a href=delete_category.php?catid='.$row['catid'].'>Delete Category</a></p>';
	       		}
	       		?>
	       		<hr/>
	       		<p><a href = "admin_view.php">Go To Admin Menu</p>
	       	</form>
		</div>
		<div class="span5">
	    </div>
	</div>  
</div>
<body>
</html>

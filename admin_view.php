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
	<title>Online Book Store</title>
</head>

<body style="background-color:lavender;">
<div class="container">	   
	<div class="row" style="background-color:skyblue;">	
		<div class="span6">
			<h1>Online Book Store</h1>
		</div>	
		<div class="span6">
			<p><a href="admin_view.php?logout=logout">Log Out</a></p>
			<?php
				if (isset($_SESSION['valid_user'])) 
				{
   					echo '<p>Assalamualaikum   '.$_SESSION['valid_user'].'</p>';
				}
			?>	
		</div>	
	</div>	
	<h3>Administration</h3>
    <div class="row" style="margin-top:0%;padding:0%;">	
		<div class="span12">
			<p><a href="index.php">Go To main site</a></p>
			<p><a href="insert_category_form.php">Add a new category</a></p>
			<p><a href="insert_book_form.php">Add a new book</a></p>
			<p><a href="passchan.php">Change admin password</a></p>
	    </div>
	</div>  
</div>
<body>
</html>

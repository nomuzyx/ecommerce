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
<?php
session_start();

include 'mysqlcon.php';

$isbn = $_GET['isbn'];


$qry="SELECT isbn,title,catid,author,price,descrip FROM books WHERE isbn =".$isbn;

$result = mysqli_query($con,$qry);
$row = mysqli_fetch_array($result);

if (!isset($_SESSION['cart']))
{
	$_SESSION['cart'] = array();
	$_SESSION['items'] = 0;
	$_SESSION['total_price'] = '0.00';
}

if (isset($_GET['logout'])) 
{
	session_destroy();
	header("Location: login.php");
} 	

?>
<body style="background-color:lavender;">
<div class="container">		
	<div class="row" style="background-color:skyblue;">	
			<div class="span6">
				<h1>Online Book Store</h1>
			</div>	
			<div class="span6">
				<?php
				if (isset($_SESSION['valid_user']))
				{
					echo'<p><a href="edit_book_form.php?logout=logout">Log Out</a></p>';
				}
				else
				{
					echo"<p>Total Items =".$_SESSION['items'];
					echo"</p>";
					echo"<p>Total Price = $".$_SESSION['total_price'];
					echo"</p>";
					echo'<p><a href="show_cart.php">View Cart</a>';
					echo"</p>";
				}	
				?>
			</div>	
	</div>	
	<h3><?php echo $row["title"]; ?></h3>

    
    <div class="row" style="margin-top:0%;padding:0%;">	

		<div class="span2">
			<ul>
				<?php
					$image = 'images/'.$row["isbn"].".jpg";
					echo'<img src="'.$image.'" width="100" height="100">';
				?>
			</ul>	
	    </div>
	    <div class="span10">
	         <ul>
				<?php
					echo "<li>";
					echo'<strong>Author :</strong> ' . $row['author'];
  					echo "</li>";
  					echo "<li>";
					echo'<strong>ISBN : </strong> ' . $row['isbn'];
  					echo "</li>";
  					echo "<li>";
					echo'<strong>Out Price : </strong>' . $row['price'];
  					echo "</li>";
  					echo "<li>";
					echo'<strong>Description : </strong>' . $row['descrip'];
  					echo "</li>";
				?>
			</ul>
	    </div>
	</div>    
	<div class="row" style="margin-top:0%;padding:1%;">	    
	    <div class="span6" style="background-color:lavender;">
	    	<?php

	    	if (isset($_SESSION['valid_user']))
			{
				echo"<p>";
				echo'<a href= edit_book_form.php?isbn='.$row["isbn"].'>Edit Item</a></p>';
				echo'<p><a href="admin_view.php">Admin Menu</a></p>';
			}
			else
			{
				echo"<p>";
				echo'<a href= show_cart.php?new='.$row["isbn"].'>Add To Cart</a></p>';
				echo'<p><a href=show_cat.php?catid='.$row["catid"].'>Continue Shopping</a></p>';
			}
				echo'<p><a href="index.php">Home</a></p>';	
			
			?>
	    </div>
	    <div class="span6">
	         
	    </div>
	</div>    
</div>
<body>
</html>

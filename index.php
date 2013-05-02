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

$qry="SELECT DISTINCT catname,catid FROM category ORDER BY catname";

$result = mysqli_query($con,$qry);

if (!isset($_SESSION['cart']))
	{
		$_SESSION['cart'] = array();
		$_SESSION['item'] = 0;
		$_SESSION['total_price'] = '0.00';
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
				echo"<p>Total Items =".$_SESSION['items'];
				echo"</p>";
				echo"<p>Total Price = $".$_SESSION['total_price'];
				echo"</p>";
				echo'<p><a href="show_cart.php">View Cart <img src="shopcart3.jpg" width="50" height="50"></a>';
				echo"</p>";
				?>
			</div>	
	</div>	
	<h3>Welcome to online book store.</h3>
    <div class="row" style="margin-top:0%;padding:0%;">	

		<div class="span6">
			<p>Please Choose a Category</p>  
			<ul>
				<?php
				while($row = mysqli_fetch_array($result))
				{
					echo "<li>";
					echo'<a href=show_cat.php?catid=' . $row['catid'] . '>'.$row['catname'];
					echo"</a>";
  					echo "</li>";
				}
				?>
			</ul>	
	    </div>
	    <div class="span6">
	         
	    </div>
	</div>    
</div>
<body>
</html>
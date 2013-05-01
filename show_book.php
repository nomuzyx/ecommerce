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

//if (isset($_SESSION['admin_user']))
//{
//	display_button('admin.php','admin-menu','Admin Menu');
//}

$qry="SELECT isbn,title,catid,author,price,descrip FROM books WHERE isbn =".$isbn;

$result = mysqli_query($con,$qry);
$row = mysqli_fetch_array($result);

?>
<body style="background-color:lavender;">
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
				echo'<p><a href="show_cart.php">View Cart</a>';
				echo"</p>";
				?>
			</div>	
	</div>	
	<h2><?php echo $row["title"]; ?></h2>

<div class="container">	    
    <div class="row" style="margin-top:0%;padding:1%;">	

		<div class="span6" style="background-color:tan;">
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
	    <div class="span6">
	         
	    </div>
	</div>    
	<div class="row" style="margin-top:0%;padding:1%;">	    
	    <div class="span6" style="background-color:lavender;">
	    	<?php
			echo"<p>";
			echo'<a href= show_cart.php?new='.$row["isbn"].'>Add To Cart</a></p>';
			echo'<p><a href=show_cat.php?catid='.$row["catid"].'>Continue Shopping</a></p>';
			?>
	    </div>
	    <div class="span6">
	         
	    </div>
	</div>    
</div>
<body>
</html>

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

$qry="SELECT isbn,title,author,price,descrip FROM books WHERE isbn =".$isbn;

$result = mysqli_query($con,$qry);
$row = mysqli_fetch_array($result);

?>
<body style="background-color:lavender;">
	
	<h1 style="background-color:skyblue;">Online Book Store</h1>
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
			<p><a href="<?php echo'addtocart.php?isbn='.$row['isbn'];?>" style="padding:5%;">Add To Cart</a>
			<a href="<?php echo'index.php';?>" style="padding:20%;">Continue Shopping</a></p>
	    </div>
	    <div class="span6">
	         
	    </div>
	</div>    
</div>
<body>
</html>
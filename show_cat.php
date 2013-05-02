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

$catid = $_GET['catid'];

//if (isset($_SESSION['admin_user']))
//{
//	display_button('admin.php','admin-menu','Admin Menu');
//}

$qry="SELECT isbn,title,author FROM books WHERE catid =".$catid;

$result = mysqli_query($con,$qry);

$qry1="SELECT catname FROM category WHERE catid =".$catid;

$rcatname = mysqli_query($con,$qry1);

//$row = mysql_fetch_array($result);

$name = mysqli_fetch_array($rcatname);
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
				echo'<p><a href="show_cart.php">View Cart</a>';
				echo"</p>";
				?>
			</div>	
	</div>	
	<h3><?php echo $name["catname"]; ?></h3>


    <div class="row" style="margin-top:0%;padding:0%;">	

		<div class="span6">
			<p>Please Choose a Book.</p>  
			<ul>
				<?php
				while($row = mysqli_fetch_array($result))
				{	
					$image = 'images/'.$row["isbn"].".jpg";
					echo "<li>";
					if (file_exists($image))
					{
						echo'<img src="'.$image.'" width="50" height="50">';
					}	
					echo'<a href=show_book.php?isbn=' . $row['isbn'] . '>'.$row['title'].'  '. $row['author'];
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

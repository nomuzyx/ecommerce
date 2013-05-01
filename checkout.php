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

if (!$_SESSION['items']) $_SESSION['items'] = '0';
if (!$_SESSION['total_price']) $_SESSION['total_price'] = '0.00';

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
		<h3>Checkout</h3>

<div class="container">	    
    <div class="row" style="margin-top:1%;padding:1%;">	

		<div class="span12">
			<table class="table-bordered">
			<form action="show_cart.php" method="post">	
				
				<?php
				if ($_SESSION['cart'] && array_count_values($_SESSION['cart']))
				{	
					echo"<tr>";
					echo'<th align="left">Item</th>';	
				    echo'<th align="right">Price</th>';
					echo'<th align="right">Quantity</th>';
					echo'<th align="right">Total</th>';
					echo"</tr>";

					$cart = $_SESSION['cart'];
					
					foreach ($cart as $isbn => $qty) 
					{
						$qry="SELECT isbn,title,catid,author,price,descrip FROM books WHERE isbn =".$isbn;
						$result = mysqli_query($con,$qry);
 						$row = mysqli_fetch_array($result);
						$catid = $row['catid'];
						$mcatlink="show_cat.php?catid=".$catid;

						echo"<tr>";
					
						echo'<td align="left">';
						echo'<a href="show_book.php?isbn='.$isbn.'">'.$row['title'].'</a> by '.$row['author'];
						echo"</td>";	
					
						echo'<td align="right"> $'.number_format($row['price'],2);
						echo"</td>";	

						echo'<td align="right">';
						echo $qty;
						echo"</td>";	

						echo'<td align="right">';
						echo'$'.number_format($row['price'] * $qty,2);
						echo"</td>";	
						echo"</tr>";
					}		
						echo"<tr>";
						echo'<td colspan = "2" >Total &nbsp </td>';
						echo'<td align= \"center\">'.$_SESSION['items'].'</td>';
						echo'<td align="right">$'.number_format($_SESSION['total_price'],2).'</td>';	
						echo"</tr>";

						
				}
				else
				{
					echo'There are no items in your cart';
					$mcatlink = 'index.php';
				}

				
				?>
			</form>	
			</table>	
			
	    </div>
	</div>    
	<div class="row" style="margin-top:0%;padding:1%;">	    
	    <div class="span6" style="background-color:lavender;">
			<p><a href='<?php echo "$mcatlink"; ?>'>Continue Shopping</a></p>
	    </div>
	    <div class="span6">
	         
	    </div>
	</div>    
</div>
<body>
</html>

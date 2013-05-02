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

$name = $_POST['name'];
$address=$_POST['address'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$country=$_POST['country'];


if (!$_SESSION['items']) $_SESSION['items'] = '0';
if (!$_SESSION['total_price']) $_SESSION['total_price'] = '0.00';

$shipcharge = 20;

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

	<form action="process.php" method="post">	    
    <div class="row" style="margin-top:0%;padding:0%;">	

		<div class="span12">
			<table class="table table-bordered">		
			<?php

				if ($_SESSION['cart'] && array_count_values($_SESSION['cart']))
				{	
					if($_SESSION['cart']&&$name&&$address&&$city&&$zip&&$country)
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
						
						echo"<tr>";
						echo'<td colspan = "3" >Shipping &nbsp </td>';
						echo'<td align="right">$'.$shipcharge.'</td>';	
						echo"</tr>";

						echo"<tr>";
						echo'<td colspan = "3" >TOTAL INCLUDING SHIPPING &nbsp </td>';
						echo'<td align="right">$'.number_format($_SESSION["total_price"] + $shipcharge,2).'</td>';	
						echo"</tr>";
					}
					else
					{
						echo'You did not fill in all the fields, please try again.<hr/>';	
						$mcatlink = 'checkout.php';
					}
						
				}
				else
				{
					echo'There are no items in your cart';
					$mcatlink = 'index.php';
				}

				
				?>
			</table>			
	    </div>
	</div> 
	<div class="row" style="margin-top:0%;padding:0%;">	    
	    <div class="span12" style="background-color:skyblue;" >
	    	<p class="text-center"><strong>Credit Card Details</strong></p>
	    </div>
	</div> 
	<div class="row" style="margin-top:0%;padding-left:1%;">	 
	    <div class="span12">
			<table class="table">		
				<tr>
				<td class="span4" >Type</td>
				<td class="span8"><input type="text" name="cardtype" class="span3"></td>
			    </tr>
				<tr>
				<td class="span4" >number</td>
				<td class="span8"><input type="text" name="cardno" class="span5"></td>
			    </tr>					
			    <tr>
				<td class="span4" >AMEX code (if required)</td>
				<td class="span8"><input type="text" name="amexcode" class="span2"></td>
			    </tr>
			    <tr>
				<td class="span4" >Expiry Date</td>
				<td class="span8"><input type="date" name="cardexpdt" class="span3"></td>
			    </tr>
			    <tr>
				<td class="span4" >Name on Card</td>
				<td class="span8"><input type="text" name="namecard" class="span5"></td>
			    </tr>
			    <tr>
				<td class="span12" colspan="2" ><strong>Please press Purchase to confirm your purchase,or Continue Shopping to add or remove items.</strong></td>
			    </tr>


			</table>	
			
	    </div>
	</div>    
	<div class="row" style="margin-top:0%;padding:0%;">	    
	    <div class="span4" style="background-color:lavender;">
			<a href='<?php echo "$mcatlink"; ?>'>Continue Shopping</a>
	    </div>
	    <div class="span8">
	    	<?php 
	    	if($_SESSION['cart']&&$name&&$address&&$city&&$zip&&$country)
	    	{
	    		echo'<button type="submit" name="save" class="btn btn-success btn-small">Purchase $</button>';						
	    	}
	        ?>
	    </div>
	</div> 
	</form>	   
</div>
<body>
</html>

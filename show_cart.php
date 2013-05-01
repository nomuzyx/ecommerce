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
@ $new = $_GET['new'];


function calculate_price($cart,$con)
{	
	$price = 0.0;
	if(is_array($cart))
	{
		foreach ($cart as $isbn => $qty) 
		{	
			//$isbn = intval($isbn);
			
			$qry1 ="SELECT price FROM books WHERE isbn ='$isbn'";
			$result1 = $con->query($qry1);
			if ($result1)
			{
				$item       =  $result1->fetch_object();
				$item_price =  $item->price;
				$price      += $item_price * $qty;
			} 
		
		}
	}
	return $price;
}

function calculate_items($cart)
{
	$items=0;
	if(is_array($cart))
	{
		$items=array_sum($cart);
	}
	return $items;
}

if ($new)
{
	if (!isset($_SESSION['cart']))
	{
		$_SESSION['cart'] = array();
		$_SESSION['item'] = 0;
		$_SESSION['total_price'] = '0.00';
 	}

 	if(isset($_SESSION['cart'][$new]))
 	{
 		$_SESSION['cart'][$new]++;
 	}
 	else
 	{
 		$_SESSION['cart'][$new] = 1;
 	}

	$_SESSION['total_price'] = calculate_price($_SESSION['cart'],$con);
	$_SESSION['items'] = calculate_items($_SESSION['cart']);
}

if(isset($_POST['save']))
{
	foreach ($_SESSION['cart'] as $isbn => $qty) 
{
		if ($_POST[$isbn] == '0')
		{
			unset($_SESSION['cart'] [$isbn]);	
		}
		else
		{	
			$_SESSION['cart'] [$isbn] = $_POST[$isbn];
		}	
}

$_SESSION['total_price'] = calculate_price($_SESSION['cart'],$con);
$_SESSION['items'] = calculate_items($_SESSION['cart']);

}


if ($_SESSION['cart'] && array_count_values($_SESSION['cart']))
{
	$mhead = '';
}
else
{
	$mhead = 'There are no items in your cart';
	
}

//$target = 'index.php';


if ($new)
{
	$qry="SELECT isbn,title,catid,author,price,descrip FROM books WHERE isbn =".$new;
	
	$result = mysqli_query($con,$qry);
	$row = mysqli_fetch_array($result);
	$catid = $row['catid'];
	$mcatlink="show_cat.php?catid=".$catid;
}
else
{
	$mcatlink="index.php";
}



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
				?>
			</div>	
		</div>	
		<h5>Your Shopping Cart</h5>
		<p><?php echo $mhead; ?></p>

<div class="container">	    
    <div class="row" style="margin-top:1%;padding:1%;">	

		<div class="span12">
			<table class="table-bordered">
				<tr>
					<th align="left">Item</th>	
				    <th align="right">Price</th>
					<th align="right">Quantity</th>
					<th align="right">Total</th>		
				</tr>

				<?php
				$cart = $_SESSION['cart'];

				foreach ($cart as $isbn => $qty) 
				{
					echo"<tr>";
					
					echo'<td align="left">';
					echo'<a href="show_book.php?isbn='.$isbn.'">'.$row['title'].'</a> by '.$row['author'];
					echo"</td>";	
					
					echo'<td align="right"> $'.number_format($row['price'],2);
					echo"</td>";	

					echo'<td align="right">';
					echo'<input type="text" name='.$isbn.' value = '.$qty.' class = "span1">';
					echo"</td>";	

					echo'<td align="right">';
					echo'$'.number_format($row['price'] * $qty,2);
					echo"</td>";	
					echo"</tr>";

					echo"<tr>";
					echo'<td colspan = "2" >Total &nbsp </td>';
					echo'<td align= \"center\">'.$_SESSION['items'].'</td>';
					echo'<td align="right">$'.number_format($_SESSION['total_price'],2).'</td>';	
					echo"</tr>";

					echo"<tr>";
					echo'<td colspan = "3">&nbsp</td>';
					echo'<td align= "right"><button type="submit" name = "save" class="btn btn-success btn-small">Save Changes</button></td>';
					echo"</tr>";
				}	
				
				?>
			</table>	
			
	    </div>
	</div>    
	<div class="row" style="margin-top:0%;padding:1%;">	    
	    <div class="span6" style="background-color:lavender;">
			<p><a href='<?php echo "$mcatlink"; ?>' style="padding:5%;">Continue Shopping</a>
			<a href="<?php echo'checkout.php';?>" style="padding:20%;">Go To Checkout</a></p>
	    </div>
	    <div class="span6">
	         
	    </div>
	</div>    
</div>
<body>
</html>

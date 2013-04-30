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
include 'mysqlcon.php';
session_start();

@ $new = $_GET['new'];

if ($new)
{
	if (!isset($_SESSION['cart']))
	{
		$_SESSION['cart'] = array();
		$_SESSION['item'] = 0;
		$_SESSION['total_price'] = '0.00';
 	}

 	if(isset($_SESSION['cart'] [$new]))
 	{
 		$_SESSION['cart'] [$new]++;
 	}
 	else
 	{
 		$_SESSION['cart'] [$new] = 1;
 	}

 //	$_SESSION['total_price'] = calculate_price($_SESSION['cart'],$con);
 //	$_SESSION['items'] = calculate_items($_SESSION['cart']);
}

//if(isset($_POST['save']))
//{
//	foreach ($_SESSION['cart'] as $isbn => $qty) 
//{
//		if ($_POST[$isbn] == '0')
//		{
//			unset($_SESSION['cart'] [$isbn]);	
//		}
//		else
//		{	
//			$_SESSION['cart'] [$isbn] = $_POST[$isbn];
//		}	
//	}

//$_SESSION['total_price'] = calculate_price($_SESSION['cart'],$con);
//$_SESSION['items'] = calculate_items($_SESSION['cart']);

//}

//if ($_SESSION['cart'] && array_count_values($_SESSION['cart']))
//{
//	$mhead = '';
//}
//else
//{
//	$mhead = 'There are no items in your cart';
//}

//$target = 'index.php';


//function calculate_price($cart,$con)
//{	

//	$price = 0.0;
//	if(is_array($cart))
//	{
//		foreach ($cart as $isbn => $qty) 
//		{	
//			//$isbn = intval($isbn);
//			$qry1 ="SELECT price FROM books WHERE isbn =". $isbn;
//			$result1 = mysqli_query($con,$qry1);

//			if ($result1)
//			{
//				$item = mysql_fetch_array($result1);
//				$item_price=$item->price;
//				$price += $item_price * $qty;
//			} 
		
//		}
//	}
//	return $price;
//}

function calculate_items($cart)
{
	$items=0;
	if(is_array($cart))
	{
		$items=array_sum($cart);
	}
	return $items;
}

$qry1="SELECT catid FROM books WHERE isbn =".$new;

$rcatname = mysqli_query($con,$qry1);

$row = mysqli_fetch_array($rcatname);

?>
<body style="background-color:lavender;">
	
	<h1 style="background-color:skyblue;">Online Book Store</h1>
	<h2>Your Shopping Cart</h2>

<div class="container">	    
    <div class="row" style="margin-top:0%;padding:1%;">	

		<div class="span6" style="background-color:tan;">
			<table class="table-bordered">
				<tr>
					<th>Item</th>	
				    <!--<th>Price</th>-->
					<th>Quantity</th>
					<th>Total</th>		
				</tr>

				<?php
				foreach ($_SESSION['cart'] as $isbn => $qty) 
				{
					echo"<tr>";
					echo"<td>".$_SESSION['cart'] [$isbn]."</td>";	
					echo"<td></td>";	
					echo"<td></td>";	
					echo"</tr>";
				}	
				
				?>
			</table>	
	    </div>
	    <div class="span6">
	         
	    </div>
	</div>    
	<div class="row" style="margin-top:0%;padding:1%;">	    
	    <div class="span6" style="background-color:lavender;">
			<p><a href='<?php echo"show_cat.php?catid=".$row["catid"] ?>' style="padding:5%;">Continue Shopping</a>
			<a href="<?php echo'checkout.php';?>" style="padding:20%;">Go To Checkout</a></p>
	    </div>
	    <div class="span6">
	         
	    </div>
	</div>    
</div>
<body>
</html>

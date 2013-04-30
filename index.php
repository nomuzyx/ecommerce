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

?>
<body style="background-color:lavender;">
	
	<h1 style="background-color:skyblue;">Online Book Store</h1>
	<h2>Welcome to online book store.</h2>

<div class="container">	    
    <div class="row" style="margin-top:0%;padding:1%;">	

		<div class="span6" style="background-color:tan;">
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
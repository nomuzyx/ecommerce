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

?>

<body style="background-color:lavender;">
<div class="container">	   
	<div class="row" style="background-color:skyblue;">	
		<div class="span6">
			<h1>Online Book Store</h1>
		</div>	
		<div class="span6">
			<?php
				echo'<p><a href="login.php">Log Out</a>';
				echo"</p>";
			?>
		</div>	
	</div>	
	<h3>Change Password</h3>

    <div class="row" style="margin-top:0%;padding:0%;">	
		<div class="span12">
		<?php	

		?>	
	    </div>
	</div>  
</div>
<body>
</html>

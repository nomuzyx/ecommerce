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

function loginfunc($user,$pass,$con)
{
	$qry = "select * from users where username ='$user' and password = '$pass'";
	
	$result = mysqli_query($con,$qry);

	if(!$result) 
	{
		throw new Exception('Could not log you in.');
	}
		
	if ($result->num_rows > 0) 
	{
		return true;
	}	
	else
	{
		throw new Exception('Could not log you in.');
	} 
		
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
				echo'<p><a href="login.php">Log Out</a>';
				echo"</p>";
			?>
		</div>	
	</div>	
	<h3>Administration</h3>
    <div class="row" style="margin-top:0%;padding:0%;">	
		<div class="span12">
		<?php	
			if ($_POST['username'] && $_POST['password'])
			{
				$username = $_POST['username'];
				$password = $_POST['password'];
				try
				{
					if (loginfunc($username, $password,$con))
					{
						$_SESSION['valid_user'] = $username;
						
						echo'<p><a href="admin.php">Go To main site</a>';
						echo"</p>";
						echo'<p><a href="addcategory.php">Add a new category</a>';
						echo"</p>";
						echo'<p><a href="addbook.php">Add a new book</a>';
						echo"</p>";
						echo'<p><a href="passchan.php">Change admin password</a>';
						echo"</p>";
					}
			
				}	
				catch(Exception $e)
				{
					echo "Could not log you in.";
				}
			}
		?>	
	    </div>
	</div>  
</div>
<body>
</html>

<?php
include 'mysqlcon.php';
include 'admin_fns.php';
session_start();

if (!isset($_SESSION['valid_user'])) 
{
   header("Location: login.php");
   exit();
}

if (isset($_GET['logout'])) 
{
	session_destroy();
	header("Location: login.php");
}
?>

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
try
{
	if (!empty($_POST['oldpass']) && !empty($_POST['newpass']) && !empty($_POST['retypepass']))
	{
		$oldpass    = $_POST['oldpass'];
		$newpass    = $_POST['newpass'];
		$retypepass = $_POST['retypepass'];
		if ($newpass != $retypepass)
		{
			throw new Exception('Password entered were not the same.'.'Not changed.');	
		}

		if (strlen($newpass) < 8)
		{
			throw new Exception('New password must be atleast 8 character.'.'Try again.');	
		}
	
		change_password($_SESSION['valid_user'], $oldpass,$newpass,$con);
		echo"Password changed successfully.";
	}

}
catch(Exception $e)
{
	echo $e->getMessage();
}


?>

<body style="background-color:lavender;">
<div class="container">	   
	<div class="row" style="background-color:skyblue;">	
		<div class="span6">
			<h1>Online Book Store</h1>
		</div>	
		<div class="span6">
			<p><a href="passchan.php?logout=logout">Log Out</a></p>
		</div>
	</div>	
    <div class="row" style="margin-top:0%;padding:0%;">	
		<div class="span6">
			<form name="input" class="form-action" action="passchan.php" style="margin:10%;" method="post">
				<p><Strong>Change password</strong></p>
	    	 	<p><input type="password" size="30" name="oldpass" value="" placeholder="Old Password"></p>
	     	 	<p><input type="password" size="30" name="newpass" value="" placeholder="New Password"></p>
	     	 	<p><input type="password" size="30" name="retypepass" value="" placeholder="Repeat New Password"></p>
	     		<button class="btn btn-warning btn-small" type="submit">Change password</button>
	     		<hr/>    			
	     		<p><a href = "admin_view.php">Go To Admin Menu</p>
	     	</form>		
				
	    </div>
	    <div class="span6">
				
	    </div>
	</div>  
</div>
<body>
</html>

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

function change_password($user,$oldpass,$newpass,$con)
{
	loginfunc($user,$oldpass,$con);

	$qry = "update users set password = '$newpass' where username = '$user'";
	$result = mysqli_query($con,$qry);

	if (!$result)
	{
		throw new Exception('Password cound not be changed.');
	}
	else
	{
		return true;
	}

}

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
	//else
//	{
//		throw new Exception('You have not filled out the form completely.'.'Please try again.');	
//	}	
		

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
		
	</div>	
    <div class="row" style="margin-top:0%;padding:0%;">	
		<div class="span12">
			<div class="span6">
				<form name="input" class="form-action" action="passchan.php" style="margin:10%;" method="post">
					<p><Strong>Change password</strong></p>
	       		 	<p><input type="password" size="30" name="oldpass" value="" placeholder="Old Password"></p>
	       		 	<p><input type="password" size="30" name="newpass" value="" placeholder="New Password"></p>
	       		 	<p><input type="password" size="30" name="retypepass" value="" placeholder="Repeat New Password"></p>
	       			<button class="btn btn-warning btn-small" type="submit">Change password</button>
	       			<!--<a href="admin.php" name="">Change Password</a>-->
	       		</form>	
			</div>	
	    </div>
	</div>  
</div>
<body>
</html>

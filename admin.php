<?php
include 'mysqlcon.php';
session_start();

if (isset($_POST['submit'])) 
{
	$user = $_POST['username'];
	$pass = $_POST['password'];
   	if (empty($user)) 
   	{
		die('User name cannot be empty');
  	}
   	if (empty($pass)) 
   	{
		die('User password cannot be empty');
   	}

	$qry = "select * from users where username ='$user' and password = '$pass'";
	
	$result = mysqli_query($con,$qry);

	if ($result->num_rows > 0) 
	{
		$_SESSION['valid_user'] = $user;
		$_SESSION['password'] = $pass;
		header("Location: admin_view.php");
	}	
	else
	{
		throw new Exception('Could not log you in.');
	} 
}


?>


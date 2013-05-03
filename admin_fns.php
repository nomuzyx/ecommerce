<?php

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

?>
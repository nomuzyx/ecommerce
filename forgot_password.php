<?php
include 'mysqlcon.php';

$username = $_POST['username'];

try
{
	notify_password($username,"abcd1234",$con);
	echo'Your new password has been emailed to you.<br/>';
}
catch (Exception $e)
{
	//echo'Your password could not be reset - Please try again later.';
	echo $e->getMessage();
}
echo'<a href="login.php" name="">Login</a>';

function notify_password($username,$password,$con)
{
	$qry="select * from users where username='$username'";
	$result = mysqli_query($con,$qry);

	if (!$result)
	{
		throw new Exception('Could not find email address');
	}
	else
	{
		$row = mysqli_fetch_array($result);
		$email = $row['email'];
		$from = "From: support@affire.in \r\n";
		$mesg = "Your password has been changed to ".$password."\r\n"."Please change it next time you log in.\r\n";

		if (mail ($email,'login information',$mesg,$from))
			return true;
		else
			throw new Exception('Could not send email.');
	}
}

?>
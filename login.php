<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css\bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="css\bootstrap-responsive.min.css">

</head>

<body style="background-color:lavender;">

<div class="container">
	    
    <div class="row" style="margin-top:10%;padding:5%;">	    
		<div class="span4 offset3" style="background-color:tan;">
			<form name="input" class="form-action" action="admin.php" style="margin:10%;" method="post">
				<p><Strong>LOGIN</strong></p>
	        	<p><input type="text" size="30" name="username" value="" placeholder="Username"></p>
	       		<p><input type="password" size="30" name="password" value="" placeholder="Password"></p>
	       		<button class="btn btn-warning btn-small" name="submit" type="submit">Login</button>
	       		<a href="forgotpasswd.php" name="">Forgot Password</a>
	       	</form>	
	    </div>
	    <div class="span4">
	         
	    </div>
	</div>    
</div>
<body>
</html>
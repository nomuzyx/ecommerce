<?php
	include 'mysqlcon.php';
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
	<script src = "js/jquery.js"></script>
	<title>Add a book</title>
</head>
<?php
$qry="SELECT DISTINCT catname,catid FROM category ORDER BY catname";

$result = mysqli_query($con,$qry);

$option = "";

while($row = mysqli_fetch_array($result))
{
	$catid   = $row['catid'];
	$catname = $row['catname'];
	$option .='<option value="'.$catname.'">'.$catname.'</option>';
}	       		 			
?>

<body style="background-color:lavender;">
<div class="container">	   
	<div class="row" style="background-color:skyblue;">	
		<div class="span6">
			<h1>Online Book Store</h1>
		</div>	
		<div class="span6">
			<p><a href="insert_form.php?logout=logout">Log Out</a></p>
		</div>
	</div>	
    <div class="row" style="margin-top:0%;padding:0%;">	
		<div class="span7">
			<form name="input" class="form-action" action="insert_book.php" style="margin:10%;" method="post">
				<p><Strong>Add a book</strong></p>
	       	 	<p><input type="text" class="span6" name="isbn" value="" placeholder="ISBN"></p>
	       	 	<p><input type="text" class="span6" name="title" value="" placeholder="Book Title"></p>
	       	 	<p><input type="text" class="span6" name="author" value="" placeholder="Book Author"></p>
	       	 	<p><select name="catname">
	       	   		<OPTION VALUE="0">Category</OPTION>
	       		 	<?php echo($option); ?>
	       		</select></p>

	       		<p><input type="text" class="span2" name="price" value="" placeholder="Price"></p>
	       		<p>Description</p>
	       		<p><textarea rows="3" class = "span6" name="descrip"></textarea></p>
	       		<button class="btn btn-success btn-small" type="submit">Add Book</button>
	       		<hr/>
	       		<p><a href = "admin_view.php">Go To Admin Menu</p>
	       	</form>	
		</div>
		<div class="span5">
	    </div>
	</div>  
</div>
<body>
</html>

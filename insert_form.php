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
include 'mysqlcon.php';
session_start();

$qry="SELECT DISTINCT catname,catid FROM category ORDER BY catname";

$result = mysqli_query($con,$qry);

$option = "";

while($row = mysqli_fetch_array($result))
{
	$catid   = $row['catid'];
	$catname = $row['catname'];
	$option .='<option value=\"$catid\">'.$catname.'</option>';
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
				<form name="input" class="form-action" action="insert_book.php" style="margin:10%;" method="post">
					<p><Strong>Add a book</strong></p>
	       		 	<p><input type="text" class="span6" name="isbn" value="" placeholder="ISBN"></p>
	       		 	<p><input type="text" class="span6" name="title" value="" placeholder="Book Title"></p>
	       		 	<p><input type="text" class="span6" name="author" value="" placeholder="Book Author"></p>
	       		 	<p><select name="catid">
	       		 		 <OPTION VALUE="0">Category</OPTION>
	       		 		<?php echo($option); ?>
	       		 	</select></p>

	       		 	<p><input type="text" class="span2" name="price" value="" placeholder="Price"></p>
	       		 	<p>Description</p>
	       		 	<p><textarea rows="3" class = "span6" name="descrip"></textarea></p>
	       			<button class="btn btn-success btn-small" type="submit">Add Book</button>
	       			<!--<a href="admin.php" name="">Change Password</a>-->
	       		</form>	
			</div>	
	    </div>
	</div>  
</div>
<body>
</html>

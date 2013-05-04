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
	<title>Edit a book</title>
</head>

<?php

$isbn = $_GET['isbn'];
$qry="SELECT * FROM books where isbn =".$isbn;

$result = mysqli_query($con,$qry);

$row = mysqli_fetch_array($result);


$qry1="SELECT DISTINCT catname,catid FROM category ORDER BY catname";

$result1 = mysqli_query($con,$qry1);

$option = "";

while($row1 = mysqli_fetch_array($result1))
{
	$catid   = $row1['catid'];
	$catname = $row1['catname'];
	if ($row['catid'] == $catid)
	{
		$option .='<option value="'.$catname.'" selected="selected">'.$catname.'</option>';
	}
	else
	{
		$option .='<option value="'.$catname.'">'.$catname.'</option>';
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
			<p><a href="edit_book_form.php?logout=logout">Log Out</a></p>
			<?php
				if (isset($_SESSION['valid_user'])) 
				{
   					echo '<p>Assalamualaikum   '.$_SESSION['valid_user'].'</p>';
				}
			?>	
		</div>
	</div>	
    <div class="row" style="margin-top:0%;padding:0%;">	
		<div class="span7">
			<form name="input" class="form-action" action="edit_book.php" style="margin:10%;" method="post">
				<p><Strong>Edit a book</strong></p>
	       	 	<p><input type="text" class="span6" name="isbn" value='<?php echo $row["isbn"]; ?>' placeholder="ISBN" readonly	></p>
	       	 	<p><input type="text" class="span6" name="title" value='<?php echo $row["title"]; ?>' placeholder="Book Title"></p>
	       	 	<p><input type="text" class="span6" name="author" value='<?php echo $row['author']; ?>' placeholder="Book Author"></p>
	       	 	<p><select name="catname">
	       	   		<OPTION VALUE="0">Category</OPTION>
	       		 	<?php echo($option); ?>
	       		</select></p>

	       		<p><input type="text" class="span2" name="price" value='<?php echo $row["price"]; ?>' placeholder="Price"></p>
	       		<p>Description</p>
	       		<p><textarea rows="3" class = "span6" name="descrip" ><?php echo $row["descrip"]; ?></textarea></p>

	       		<?php
	       		if (isset($_SESSION['valid_user']))
				{
	       			echo'<p><button class="btn btn-success btn-small" type="submit">Update Book</button>';
	       			echo'&nbsp&nbsp&nbsp<a href=delete_book.php?isbn='.$row['isbn'].'&catid='.$row['catid'].'>Delete book</a></p>';
	       		}
	       		else
	       		{
	       			echo'<button class="btn btn-success btn-small" type="submit">Add Book</button>';	
	       		}	
	       		?>
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

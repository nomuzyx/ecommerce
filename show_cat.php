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
session_start();

include 'mysqlcon.php';

$catid = $_GET['catid'];

//if (isset($_SESSION['admin_user']))
//{
//	display_button('admin.php','admin-menu','Admin Menu');
//}

$qry="SELECT isbn,title,author FROM books WHERE catid =".$catid;

$result = mysqli_query($con,$qry);

$qry1="SELECT catname FROM category WHERE catid =".$catid;

$rcatname = mysqli_query($con,$qry1);

//$row = mysql_fetch_array($result);

$name = mysqli_fetch_array($rcatname);

?>
<body style="background-color:lavender;">
	
	<h1 style="background-color:skyblue;">Online Book Store</h1>
	<h2><?php echo $name["catname"]; ?></h2>

<div class="container">	    
    <div class="row" style="margin-top:0%;padding:1%;">	

		<div class="span6" style="background-color:tan;">
			<p>Please Choose a Book.</p>  
			<ul>
				<?php
				while($row = mysqli_fetch_array($result))
				{
					echo "<li>";
					echo'<a href=show_book.php?isbn=' . $row['isbn'] . '>'.$row['title'].'  '. $row['author'];
					echo"</a>";
  					echo "</li>";
				}
				?>
			</ul>	
	    </div>
	    <div class="span6">
	         
	    </div>
	</div>    
</div>
<body>
</html>

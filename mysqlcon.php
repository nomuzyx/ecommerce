<?php
class connectmysql
{
	public $convar;
	function __construct()
	{
		$this->convar = mysqli_connect("localhost","root","","ecommerce");
		// Check connection
		if (mysqli_connect_errno())
  		{
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}	
	}
	
}

$objcon = new connectmysql();

//$con = get_class_vars(get_class($objcon));
$convar="convar";

$con = $objcon->$convar;

//  $result = mysqli_query($con,"SELECT * FROM staff");
?>  
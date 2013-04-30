<?php
include 'mysqlcon.php';

function get_category()
{
	$query = 'select catid,catname from category';

	$result = mysqli_query($con,$query);

	if (!$result)
	{
		return false;
	}
	$num_cats = $result->num_rows;

	if (!$num_rows == 0)
	{
		return false;
	}
	return $result;
}

?>
<?php 
/*

!!INSERT STATEMENT!!

*implode - join array elements with a string
*array_keys - return all the keys or a subset of the keys of an array
*mysqli_query - performs a query on the database
*mysqli_error - returns a string description of the last error

> Be sure to escape/sanitize/use prepared statements if you get the ids from user

*/


// array containing data
$array = array(
	"name" => "John",
	"surname" => "Doe",
	"email" => "j.doe@intelligence.gov"
);

// build query...
$MySQL  = "INSERT INTO table";

// implode keys of $array...
$MySQL .= " ('".implode("', '", array_keys($array))."')";

// implode values of $array...
$MySQL .= " VALUES ('".implode("', '", $array)."') ";

// execute query...
$result = mysqli_query($MySQL) or die(mysqli_error());
?>
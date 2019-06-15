<?php 
/*

!!SORT MULTIPLE ARRAYS!!

*array_multisort - sort multiple or multi-dimensional arrays

*/


/*sort multiple arrays or an array with multiple dimensions*/
$colors = array('Red', 'White', 'Blue');
$cities = array('Boston', 'New York', 'Chicago');

array_multisort($colors, $cities);
print_r($colors);
print_r($cities);

/*
Array(
	[0] => Blue
	[1] => Red
	[2] => White
)

Array(
	[0] => Chicago
	[1] => Boston
	[2] => New York
)
*/


/*sort multiple dimensions within a single array, pass the specific array elements*/
$stuff = array(
	'colors' => array(
		'Red', 
		'White', 
		'Blue'
	),
	'cities' => array(
		'Boston', 
		'New York', 
		'Chicago'
	)
);

array_multisort($stuff['colors'], $stuff['cities']);
print_r($stuff);
/*
Array(
	[colors] => Array(
		[0] => Blue
		[1] => Red
		[2] => White
	)
	[cities] => Array(
		[0] => Chicago
		[1] => Boston
		[2] => New York
	)
)
*/
?>
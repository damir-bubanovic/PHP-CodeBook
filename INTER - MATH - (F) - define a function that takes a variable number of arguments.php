<?php 
/*

!!DEFINE A FUNCTION THAT TAKES VARIABLE NUMEBR OF ARGUMENTS!!

*count - count all elements in an array, or something in an object
*func_num_args - returns the number of arguments passed to the function
*func_get_arg - return an item from the argument list
*mean - not defined in PHP.net


*/


/*Pass the function a single array-typed argument and put your variable arguments inside the array*/
// find the "average" of a group of numbers
function mean($numbers) {
	// initialize to avoid warnings
	$sum = 0;
	// the number of elements in the array
	$size = count($numbers);
	// iterate through the array and add up the numbers
	for ($i = 0; $i < $size; $i++) {
		$sum += $numbers[$i];
	}
	// divide by the amount of numbers
	$average = $sum / $size;
	// return average
	return $average;
}

// $mean is 96.25
$mean = mean(array(96, 93, 98, 98));


/*Accessing function parameters without using the argument list*/
// find the "average" of a group of numbers
function mean() {
	// initialize to avoid warnings
	$sum = 0;
	// the arguments passed to the function
	$size = func_num_args();
	// iterate through the arguments and add up the numbers
	for ($i = 0; $i < $size; $i++) {
		$sum += func_get_arg($i);
	}
	// divide by the amount of numbers
	$average = $sum / $size;
	// return average
	return $average;
}

// $mean is 96.25
$mean = mean(96, 93, 98, 98);


/*Accessing function parameters without using the argument list*/
// find the "average" of a group of numbers
function mean() {
	// initialize to avoid warnings
	$sum = 0;
	// the arguments passed to the function
	$size = func_num_args();
	// iterate through the arguments and add up the numbers
	foreach (func_get_args() as $arg) {
		$sum += $arg;
	}
	// divide by the amount of numbers
	$average = $sum / $size;
	// return average
	return $average;
}

// $mean is 96.25
$mean = mean(96, 93, 98, 98);
?>
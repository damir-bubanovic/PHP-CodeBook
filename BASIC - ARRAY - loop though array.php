<?php 
/*

!!LOOP THROUGH ARRAY!!

*reset - set the internal pointer of an array to its first element
	> mixed reset ( array &$array )
	> reset() rewinds array's internal pointer to the first element and returns the value of the first array element
*array_map - applies the callback FUNCTION to the elements of the given arrays
	> array array_map ( callable $callback , array $array1 [, array $... ] )
*is_array - finds whether a variable is an array
	> bool is_array ( mixed $var )

*/


/*Cycle though an array and operate on all or some of the elements inside*/
foreach ($array as $value) {
	// Act on $value
}


/*get an array’s keys and values*/
foreach ($array as $key => $value) {
	// Act II
}
/*OR*/
for ($key = 0, $size = count($array); $key < $size; $key++) {
	// Act III
}
/*OR*/
reset($array); // reset internal pointer to beginning of array
while (list($key, $value) = each ($array)) {
	// Final Act
}
/*
ALERT
- If your first element is false, you don't know whether it was empty or not
*/
$a = array();
$b = array(false, true, true);
var_dump(reset($a) === reset($b)); //bool(true)


/*use a $size variable to hold the array’s size*/
for ($item = 0, $size = count($items); $item < $size; $item++) {
	// ...
}
/*OR - count backward*/
for ($item = count($items) - 1; $item >= 0; $item--) {
	// ...
}


/*use array_map() to hand off each element to a function for processing*/
$lc = array_map('strtolower', $words);


/*protect against calling foreach with a nonarray*/
if (is_array($items)) {
	// foreach loop code for array
} else {
	// code for scalar
}
?>
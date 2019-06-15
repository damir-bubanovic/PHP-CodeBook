<?php 
/*

!!FIND AVERAGE of ARRAY VALUES!!

TIPS & EXPLANATIONS:
*array_sum - calculate the sum of values in an array
	> number array_sum ( array $array )
*count - count all elements in an array, or something in an object
	> int count ( mixed $array_or_countable [, int $mode = COUNT_NORMAL ] )

*/

$foo = array(7, 24, 56, 12, 8);
$average_of_foo = array_sum($foo) / count($foo); 
print $average_of_foo;	// 21.4
?>
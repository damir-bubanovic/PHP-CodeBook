<?php 
/*

!!CHANGE ARRAY SIZE!!

*array_pad - pad array to the specified length with a value
	> array array_pad ( array $array , int $size , mixed $value )
		> $size -> value to pad if array is less than size
*array_splice - remove a portion of the array and replace it with something else
	> array array_splice ( array &$input , int $offset [, int $length = 0 [, mixed $replacement = array() ]] )
	> removes the elements designated by offset and length from the input array, and replaces them with the elements of the replacement array, if supplied

*/


/*make an array grow*/
$fruit = array('apple', 'banana', 'coconut');

$grow_fruit = array_pad($fruit, 5, '');
var_dump($grow_fruit);


/*reduce an array*/
/*removes all but the first two elements from $array*/
$small_fruit = array_splice($fruit, 2);
var_dump($small_fruit);


// make a four-element array with 'dates' to the right
$tropical = array('apple', 'banana', 'coconut');
$date_tropical = array_pad($tropical, 4, 'dates');
print_r($date_tropical);

// make a six-element array with 'zucchinis' to the left
$array = array_pad($tropical, -6, 'zucchini');
print_r($array);


// make a four-element array
$array = array('apple', 'banana', 'coconut', 'dates');
// shrink to three elements
array_splice($array, 3);
// remove last element, equivalent to array_pop()
array_splice($array, -1);
// only remaining fruits are apple and banana
print_r($array);
?>
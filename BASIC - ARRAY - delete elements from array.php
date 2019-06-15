<?php 
/*

!!DELETE ELEMENTS FROM ARRAY!!

*unset - unset (destroy) a given variable
	> void unset ( mixed $var [, mixed $... ] )
	> ALERT <
		If a globalized variable is unset() inside of a function, only the local variable is destroyed, 
		The variable in the calling environment will retain the same value as before unset() was called.
		If a variable that is PASSED BY REFERENCE is unset() inside of a function, only the local variable is destroyed, 
		The variable in the calling environment will retain the same value as before unset() was called.
		If a static variable is unset() inside of a function, unset() destroys the variable only in the context of the rest of a function, 
		Following calls will restore the previous value of a variable.
*array_splice - remove a portion of the array and replace it with something else
	> array array_splice ( array &$input , int $offset [, int $length = 0 [, mixed $replacement = array() ]] )
	> removes the elements designated by offset and length from the input array, and replaces them with the elements of the replacement array, if supplied
*array_values - return all the values of an array
	> array array_values ( array $array )
	> array_values() returns all the values from the array and indexes the array numerically

*/


/*delete one element*/
unset($array[3]);
unset($array['foo']);

/*delete multiple noncontiguous elements*/
unset($array[3], $array[5]);
unset($array['foo'], $array['bar']);

/*delete multiple contiguous elements*/
array_splice($array, $offset, $length);

/*compact the array into a densely filled numeric array*/
$animals = array_values($animals);

/*reindexes arrays to avoid leaving holes*/
// create a "numeric" array
$animals = array('ant', 'bee', 'cat', 'dog', 'elk', 'fox');
array_splice($animals, 2, 2);
print_r($animals);
/*useful if you’re using the array as a queue and want to remove items from the queue while still allowing random access.*/

/*remove the first or last element from an array, use array_shift() and array_pop()*/
?>
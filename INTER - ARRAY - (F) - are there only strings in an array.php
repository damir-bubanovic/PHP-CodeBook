<?php 
/*

!!ARE THERE ONLY STRINGS IN ARRAY!!

*array_sum - calculate the sum of values in an array (returns the sum of values in an array)
*array_map - applies the callback FUNCTION to the elements of the given arrays
*is_string - find whether the type of a variable is string
*count - count all elements in an array, or something in an object

*/


/*check if there are for example only strings in an array*/
function only_strings_in_array($array) {
    return array_sum(array_map('is_string', $array)) == count($array);
}

$array1 = array('one', 'two', 'three');
$array2 = array('foo', 'bar', array());
$array3 = array('foo', array(), 'bar');
$array4 = array(array(), 'foo', 'bar');

var_dump(
    only_strings_in_array($arr1),
    only_strings_in_array($arr2),
    only_strings_in_array($arr3),
    only_strings_in_array($arr4)
);


/*
This will give you the following result:
bool(true)
bool(false)
bool(false)
bool(false)
*/
?>
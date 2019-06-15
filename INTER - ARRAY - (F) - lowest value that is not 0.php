	<!--LOOK UP _BASIC - find lowest value.php-->

<?php 
/*

!!LOWEST VALUE THAT IS NOT 0!!

> like min(), but casts to int and ignores 0

*min - find lowest value
*array_diff - compares array1 against one or more other arrays and returns the values in array1 that are not present in any of the other arrays
*array_map - applies the callback FUNCTION to the elements of the given arrays
*intval - get the integer value of a variable

*/


function min_not_null(array $values) {
	return min(array_diff(array_map('intval', $values), array(0)));
}
?>
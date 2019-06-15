<?php 
/*

!!CHECK IF ELEMENT IS IN ARRAY!!

*in_array - checks if a value exists in an array
	> bool in_array ( mixed $needle , array $haystack [, bool $strict = FALSE ] )
	> ALERT <
		Use the strict checking option
		The default behavior of in_array() is to compare items using the == operator. 
		To use the strict equality check, ===, pass true as the third parameter to in_array()

*/


/*if an array contains a certain value*/
if (in_array($value, $array)) {
	// an element has $value as its value in array $array
}

/*check if an element of an array holds a value*/
$book_collection = array(
	'Emma', 
	'Pride and Prejudice', 
	'Northhanger Abbey'
);
$book = 'Sense and Sensibility';
if (in_array($book, $book_collection)) {
	print 'Own it.';
} else {
	print 'Need it.';
}

?>
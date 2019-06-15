<?php 
/*

!!CONVERT FROM NUMERIC ARRAY TO ASSOCIATIVE ARRAY!!

*array_flip - exchanges all keys with their associated values in an array
	> array array_flip ( array $array )

*/


/*create the associative array like to convert from a traditional one with integer keys*/
$book_collection = array(
	'Emma',
	'Pride and Prejudice',
	'Northhanger Abbey'
);

/*convert from numeric array to associative array*/
$book_collection = array_flip($book_collection);
$book = 'Sense and Sensibility';
if (isset($book_collection[$book])) {
	print 'Own it.';
} else {
	print 'Need it.';
}

?>
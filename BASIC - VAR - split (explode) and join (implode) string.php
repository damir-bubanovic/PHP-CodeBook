<?php 
/*

!!Split (EXPLODE) string->array & Join (IMPLODE) array->string!!

*explode - split a string by its substrings
	> array explode ( string $delimiter , string $string [, int $limit = PHP_INT_MAX ] )
		> returns an array of strings created by splitting the string parameter on boundaries formed by the delimiter
		> $delimeter -> ' ', or the thing that seperates substrings
		> $limit -> -1 (removes last word), 1 (seperate only first word)
	> ALERT <
		If you split an empty string, you get back a one-element array with 0 as the key and an empty string for the value,
		to resolve this use array_filter() without callback. If the callback function is not supplied, array_filter() will 
		remove all the entries of input that are equal to FALSE
*implode - join array elements with a string
	> string implode ( string $glue , array $pieces )
		> returns a string containing a string representation of all the array elements in the same order, with the glue string between each element
		> $glue -> npr. '@'
		> array with one or no elements works just fine

*/


/*explode*/
$cats = 'Cats and dogs are not enemies!';

$subCats = explode(' ', $cats);
print $subCats[3] . '<br />'; // are

var_dump(explode(' ', $cats)) . '<br />';
var_dump(explode(' ', $cats, -1)) . '<br />';
var_dump(explode(' ', $cats, 1)) . '<br />';


$dogs = '';

$subDogs = explode(' ', $dogs);
var_dump($subDogs) . '<br />';


$chairs = 'rustic|one legged|broken|chinese';

var_dump(explode('|', $chairs));


/*Use preg_split() if you need a Perl-compatible regular expression to describe the separator:*/
$words = preg_split('/\d\. /','my day: 1. get up 2. get dressed 3. eat toast');
$lines = preg_split('/[\n\r]+/',$_POST['textarea']);

$math = "3 + 2 / 7 - 9";
$stack = preg_split('/ *([+\-\/*]) */',$math,-1,PREG_SPLIT_DELIM_CAPTURE);
print_r($stack);

/*Use the /i flag to preg_split() for case-insensitive separator matching:*/
$words = preg_split('/ x /i','31 inches x 22 inches X 9 inches');


/*implode*/
$myStuff = array('chairs', 'counch', 'TV', 'radio', 'bear');

$sayIt = implode(' and ', $myStuff);
print 'I have ' . $sayIt . '... and lot more, baby!';
// I have chairs and counch and TV and radio and bear... and lot more, baby!

?>
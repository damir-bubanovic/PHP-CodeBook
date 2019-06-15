<?php 
/*

!!LENGTH OF STRING!!

*strlen - get string length
	> int strlen ( string $string )
	> return  length of the string on success, and 0 if the string is empty
> ALERT <
	strlen() returns NULL when executed on arrays
	
*/


$str = 'abcdef';
print strlen($str); // 6

$str = ' ab cd ';
print strlen($str); // 7

/*determine the character count of a UTF8 string*/
$length = strlen(utf8_decode($string));



/*ADVANCED*/
/*IS VALUE 0, NULL or EMPTY*/
$foo = null;
$len = strlen(null);
$bar = '';

print "Length: " . strlen($foo) . "<br>";	// Length: 0
print "Length: $len <br>";					// Length: 0
print "Length: " . strlen(null) . "<br>";	// Length: 0


if (strlen($foo) == 0 && !is_null($foo)) {
	echo '!is_null(): $foo is truly an empty string <br>';
} else {
	echo '!is_null(): $foo is probably null <br>';
}	// !is_null(): $foo is probably null 

if (strlen($foo) == 0 && isset($foo)) {
	echo 'isset(): $foo is truly an empty string <br>';
} else {
	echo 'isset(): $foo is probably null <br>';
}	// isset(): $foo is probably null

if (strlen($bar) == 0 && !is_null($bar)) {
	echo '!is_null(): $bar is truly an empty string <br>';
} else {
	echo '!is_null(): $foo is probably null <br>';
}	// !is_null(): $bar is truly an empty string 

if (strlen($bar) == 0 && isset($bar)) {
	echo 'isset(): $bar is truly an empty string <br>';
} else {
	echo 'isset(): $foo is probably null <br>';
}	// isset(): $bar is truly an empty string 

/*you need either is_null() or isset() in addition to strlen() if you care whether or not the original value was null*/
?>
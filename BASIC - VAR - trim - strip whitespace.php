<?php 
/*

!!TRIM WHITESPACE!!

> ALERT < 
	Var i String moraju biti unutar " " da bi funkcioniralo!!! Ne znam zašto

*trim - strip whitespace (or other characters) from the beginning and end of a string
	> string trim ( string $str [, string $character_mask = " \t\n\r\0\x0B" ] )
	> without the $character_mask, trim() will strip these characters
		+ " " (ASCII 32 (0x20)), an ordinary space.
		+ "\t" (ASCII 9 (0x09)), a tab.
		+ "\n" (ASCII 10 (0x0A)), a new line (line feed).
		+ "\r" (ASCII 13 (0x0D)), a carriage return.
		+ "\0" (ASCII 0 (0x00)), the NUL-byte.
		+ "\x0B" (ASCII 11 (0x0B)), a vertical tab.
*array_map - applies the callback to the elements of the given arrays
	> array array_map ( callable $callback , array $array1 [, array $... ] )
	> array_map() returns an array containing all the elements of array1 after applying the callback FUNCTION to each one ( u našem slučaju trim() )
*array_walk - apply a user supplied function to every member of an array
	> bool array_walk ( array &$array , callable $callback [, mixed $userdata = NULL ] )
	> applies the user-defined callback function to each element of the array array
	> $callback - typically, callback takes on two parameters. The array parameter's value being the first, and the key/index second
*ltrim - strip whitespace (or other characters) from the beginning of a string
	> string ltrim ( string $str [, string $character_mask ] )
	> $character_mask - specify the characters you want to strip
	> without the $character_mask, trim() will strip these characters ..... (look up)
*rtrim - strip whitespace (or other characters) from the end of a string
	> string rtrim ( string $str [, string $character_mask ] )
	> $character_mask - specify the characters you want to strip
	> without the $character_mask, trim() will strip these characters ..... (look up)

*/


/*trim*/
$text = "\t\tThese are a few words :) ... ";
var_dump($text) . '<br />';		// string '		These are a few words :) ... ' (length=31)

$trimText = trim($text);
var_dump($trimText);			// string 'These are a few words :) ...' (length=28)


$binary = "\x09Example string\x0A";
var_dump($binary) . '<br />';		// string '	Example string   ' (length=16)

$trimBinary = trim($binary, "\x00..\x1F");
var_dump($trimBinary) . '<br />';	// string 'Example string' (length=14)



/*Trim array values*/
$cats = array('  Tabitha', ' Snugglepuss ', 'Blackie     ');
$trimmed_array = array_map('trim',$cats);
var_dump($trimmed_array);

/*OR*/

function trim_value_array(&$value) {
	$value = trim($value);
}
array_walk($cats, 'trim_value_array');
var_dump($cats);
/*
array (size=3)
  0 => string 'Tabitha' (length=7)
  1 => string 'Snugglepuss' (length=11)
  2 => string 'Blackie' (length=7)
*/

?>
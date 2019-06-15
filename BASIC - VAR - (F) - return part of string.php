	<!--LOOK UP _BASIC - return part of string.php-->

<?php 
/*

!!RETURN PART OF STRING!!

*strstr - find the first occurrence of a string
	> string strstr ( string $haystack , mixed $needle [, bool $before_needle = false ] )
	> returns part of haystack string starting from and including the first occurrence of needle to the end of haystack
	> ALERT <
		strstr() is not a way to avoid type-checking with strpos(),
		strstr() is far more memory-intensive than strpos(), especially with longer strings as your $haystack
*strpos - find the position of the first occurrence of a substring in a string
	> mixed strpos ( string $haystack , mixed $needle [, int $offset = 0 ] )
	> ALERT <
		This function may return Boolean FALSE, but may also return a non-Boolean value which evaluates to FALSE
		To know that a substring is absent, you must use: === FALSE
		To know that a substring is present, you must use: !== FALSE
		To know that a substring is at the start of the string: === 0
*strlen - get string length
	> int strlen ( string $string )
	> ALERT <
		strlen() returns NULL when executed on arrays

*/


function afterChar($thatChar, $inString) {
	/*If character exists in string*/
	if(strpos($inString, $thatChar) !== false) {
		return substr($inString, (strpos($inString, $thatChar) + 1), strlen($inString));
	} else {
		return 'No such character in string!';
	}
};

function beforeChar($thatChar, $inString) {
	/*If character exists in string*/
	if(strpos($inString, $thatChar) !== false) {
		return substr($inString, 0, - (strlen($inString) - strpos($inString, $thatChar)));
	} else {
		return 'No such character in string!';
	}
};

function betweenChar($thatChar, $specChar, $inString) {
	/*If character exists in string*/
	if(strpos($inString, $thatChar) !== false) {
		return beforeChar($specChar, afterChar($thatChar, $inString));
	} else {
		return 'No such character in string!';
	}
};

/*$thatChar = @, $inString = marko.velikovic@yahoo.com, $specChar = .*/
print afterChar('@', 'marko.velikovic@yahoo.com');	// yahoo.com
print beforeChar('@', 'marko.velikovic@yahoo.com');	// marko.velikovic
print betweenChar('@', '.', 'marko.velikovic@yahoo.com');	// yahoo
?>
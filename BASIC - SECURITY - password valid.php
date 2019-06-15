<?php
/*

!!PASSWORD VALID!!

*strlen - get string length
	> int strlen ( string $string )
*preg_match - perform a regular expression match
	> int preg_match ( string $pattern , string $subject [, array &$matches [, int $flags = 0 [, int $offset = 0 ]]] )

> SUGGESTION <
	Mayby wrap this code in function

*/


$passWord = "damir";
	
/*Error Entries*/
$noLength = "Password not long enough! Minimum 9 characters!";
$noUppLow = "Please use upper & lower case characters!";
$noNum = "Please use numbers!";
	

if(strlen($passWord) > 8) {
	if(preg_match("~[A-Z]~", $passWord) && preg_match("~[a-z]~", $passWord)) {
		if(preg_match("~[0-9]~", $passWord)) {
			print "Password valid!";
		} else {
			print $noNum;
		}
	} else {
		print $noUppLow;
	}
} else {
	print $noLength;
}

?>
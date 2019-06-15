<?php 
/*

!!SIMPLE PASSWORD GENERATOR!!

> Better way for password generator is using password hash
	> Below functions is for SHITS & GIGGLES

*substr - return part of a string
	> string substr ( string $string , int $start [, int $length ] )
	> returns the portion of string specified by the start and length parameters
*str_shuffle - randomly shuffles a string
	> string str_shuffle ( string $str )
	
*/


function random_password($chars = 8) {
	$letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	return substr(str_shuffle($letters), 0, $chars);
}
print random_password();	// 8B27XJck


/*A little advanced version*/
function generatePassword($numAlpha=8, $numNonAlpha=4) {
	$listAlpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$listNonAlpha = ',;:!?.$/*-+&@_+;./*&?$-!,';
	return str_shuffle(
		substr(str_shuffle($listAlpha), 0, $numAlpha) .
		substr(str_shuffle($listNonAlpha), 0, $numNonAlpha)
	);
}
print generatePassword();	// Lc*WUy&8PD!,
?>
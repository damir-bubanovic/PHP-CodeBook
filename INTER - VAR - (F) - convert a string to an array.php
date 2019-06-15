<?php
/*

!!CONVERT STRING TO ARRAY!!

> ALERT < 
	Imaš eplode() i str_split() - možda stara funkcija

*strlen - get string length
*substr - return part of a string

*/


function string_split($string, $string_length) {
	if(strlen($string) > $string_length || !$string_length) {
    	do {
        	$c = strlen($string);
            $parts[] = substr($string, 0, $string_length);
            $string = substr($string, $string_length);
        } while($string !== false);
    } else {
    	$parts = array($string);
    }
	return $parts;
}

print_r(string_split('All the pokemons bow to your overloar PIKACHU!', 4));

/*
Array( 
	[0] => All 
	[1] => the 
	[2] => poke 
	[3] => mons 
	[4] => bow 
	[5] => to 
	[6] => your 
	[7] => ove 
	[8] => rloa 
	[9] => r PI 
	[10] => KACH 
	[11] => U! 
)
*/
?>
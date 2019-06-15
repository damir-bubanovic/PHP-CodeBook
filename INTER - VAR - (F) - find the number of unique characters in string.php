<?php 
/*

!!FIND THE NUMBER OF UNIQUE CHARACTERS IN STRING!!

*strtolower - make a string lowercase
*str_replace - replace all occurrences of the search string with the replacement string
*count_chars - return information about characters used in a string

*/


function uniChar($string) {
	$two= strtolower(str_replace(' ', '', $string));
	$res = count(count_chars($two, 1));
	return $res;
}

print uniChar("bob") . '<br />'; // 2
print uniChar("Invisibility") . '<br />'; //8
print uniChar("The quick brown fox slyly jumped over the lazy dog") . '<br />'; //26
?>
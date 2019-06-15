<?php
/*

!!COUNT NUMBER OF CHARACTERS IN A STRING!!

*mb_strlen - get string length
*mb_substr - get part of string
*array_key_exists - checks if the given key or index exists in the array
*UTF-8 - is a character encoding capable of encoding all possible characters, or code points, in Unicode

*/

function mb_count_chars($input) {
	
	$l = mb_strlen($input, 'UTF-8');
	$unique = array();
	
	for($i = 0; $i < $l; $i++) {
		$char = mb_substr($input, $i, 1, 'UTF-8');
		if(!array_key_exists($char, $unique)) {
			$unique[$char] = 0;
		}
	}
	return $unique;
}


$input = "Puppys like to make new friend with other puppies";
print_r( mb_count_chars($input) ); 

/*
Array ( 
	[P] => 1 
	[u] => 2 
	[p] => 5 
	[y] => 1 
	[s] => 2 
	[ ] => 8 
	[l] => 1 
	[i] => 4 
	[k] => 2 
	[e] => 6 
	[t] => 3 
	[o] => 2 
	[m] => 1 
	[a] => 1 
	[n] => 2 
	[w] => 2 
	[f] => 1 
	[r] => 2 
	[d] => 1 
	[h] => 2 
)
*/

?>
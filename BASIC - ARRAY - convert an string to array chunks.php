<?php 
/*

!!CONVERT AN STRING TO ARRAY CHUNKS!!

*str_split - Convert an string to an array
	> array str_split ( string $string [, int $split_length = 1 ] )
		> $split_limit -> size of the chunks (if not specified chunk is 1 character long)

*/

$myCity = 'My home city is Zagreb';
var_dump(str_split($myCity, 3));

/*
array (size=8)
  0 => string 'My ' (length=3)
  1 => string 'hom' (length=3)
  2 => string 'e c' (length=3)
  3 => string 'ity' (length=3)
  4 => string ' is' (length=3)
  5 => string ' Za' (length=3)
  6 => string 'gre' (length=3)
  7 => string 'b' (length=1)
*/
?>
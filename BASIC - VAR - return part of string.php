<?php 
/*

!!RETURN PART OF STRING!!

*substr - return part of a string
	> string substr ( string $string , int $start [, int $length ] )
	> returns the portion of string specified by the start and length parameters

*mb_substr - get part of string
	> string mb_substr ( string $str , int $start [, int $length = NULL [, string $encoding = mb_internal_encoding() ]] )

*/


print substr('abcdef', 1);     // bcdef
print substr('abcdef', 1, 3);  // bcd
print substr('abcdef', 0, 4);  // abcd
print substr('abcdef', 0, 8);  // abcdef
print substr('abcdef', -1, 1); // f


// Accessing single characters in a string
$string = 'abcdef';
print $string[0];                 // a
print $string[3];                 // d
print $string[strlen($string)-1]; // f


$kitty = 'MonsterCat';
print substr($kitty, 0, 7) . '<br />';	// Monster

$picFile = 'Marinko.jpg';
print substr($picFile, 0, (strlen($picFile) - 4)) . '<br />';	// Marinko

$fruit = 'Apple';
print $fruit . '<br />';
/*Last 2 letters*/
print substr($fruit, -2);	// le

$furniture = 'Chairs';
print substr($furniture, -1, strlen($furniture));	// s


/*Return substring of UTF-8 characters*/
$utf8string = "cakeæøå";
print substr($utf8string,0,5);	        	// output cake#
print mb_substr($utf8string,0,5,'UTF-8');	 //output cakeæ

?>
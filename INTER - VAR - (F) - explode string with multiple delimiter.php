<?php 
/*

!!EXPLODE STRING WITH MULTIPLE DELIMITER!!

*str_replace - replace all occurrences of the search string with the replacement string
*explode - returns an array of strings, each of which is a substring of string formed by splitting it on boundaries formed by the string delimiter.
	> ALERT < 
		be careful when using explode() on big strings, as it can also explode your memory usage

*/


/*$delimiters has to be array, $string has to be array*/
function multiexplode($delimiters, $string) {
    
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return $launch;
}

$text = "here is a sample: this text, and this will be exploded. this also | this one too :)";
$exploded = multiexplode(array(",",".","|",":"),$text);

print_r($exploded);

/*
Array (
	[0] => here is a sample
    [1] =>  this text
    [2] =>  and this will be exploded
    [3] =>  this also 
    [4] =>  this one too 
    [5] => )
)
*/

?>
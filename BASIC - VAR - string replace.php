<?php 
/*

!!STRING REPLACE!!

*str_replace - replace all occurrences of the search string with the replacement string
	> mixed str_replace ( mixed $search , mixed $replace , mixed $subject [, int &$count ] )
	> returns a string or an array with all occurrences of search in subject replaced with the given replace value.
	> ALERT <
		Because str_replace() replaces left to right, it might replace a previously inserted value when doing multiple replacements

*/

$bodytag = str_replace('%body%', 'black', "<body text='%body%'");	// <body text='black'>


$vowels = array('a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', );
$onlyconsonants = str_replace($vowels, '', 'Hello World of PHP');	// Hll Wrld f PHP


$phrase  = "You should eat fruits, vegetables, and fiber every day.";
$healthy = array("fruits", "vegetables", "fiber");
$yummy   = array("pizza", "beer", "ice cream");

$newphrase = str_replace($healthy, $yummy, $phrase);	// You should eat pizza, beer, and ice cream every day


$str = str_replace("ll", "", "good golly miss molly!", $count);
print $count;	// 2


/*ALERT - PROBLEMS*/
// Order of replacement
$str     = "Line 1\nLine 2\rLine 3\r\nLine 4\n";
$order   = array("\r\n", "\n", "\r");
$replace = '<br />';

// Processes \r\n's first so they aren't converted twice.
$newstr = str_replace($order, $replace, $str);

// Outputs F because A is replaced with B, then B is replaced with C, and so on...
// Finally E is replaced with F, because of left to right replacements.
$search  = array('A', 'B', 'C', 'D', 'E');
$replace = array('B', 'C', 'D', 'E', 'F');
$subject = 'A';
echo str_replace($search, $replace, $subject);

// Outputs: apearpearle pear
// For the same reason mentioned above
$letters = array('a', 'p');
$fruit   = array('apple', 'pear');
$text    = 'a p';
$output  = str_replace($letters, $fruit, $text);
echo $output;

?>
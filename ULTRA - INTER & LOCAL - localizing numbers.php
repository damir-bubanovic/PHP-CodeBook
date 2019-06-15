<?php 
/*

!!INTER & LOCAL - LOCALIZING NUMBERS!!

> want to display numbers in a locale-specific format

> Look up  - DecimalFormat pattern characters

*/


/*Use the number argument type with MessageFormatter*/
$message = '{0, number} / {1, number} = {2, number}';
$args = array(5327, 98, 5327/98);
$us = new MessageFormatter('en_US', $message);
$fr = new MessageFormatter('fr_FR', $message);

print $us->format($args) . "\n";
print $fr->format($args) . "\n";
/*
OUTPUT:
5,327 / 98 = 54.357
5 327 / 98 = 54,357
*/



/*The characters used as the thousands separator
and decimal point are locale-specific*/
/*there are easy shortcuts for displaying numbers as 
currency amounts and percentage amounts*/
$message = '{0,number,currency}, {0,number,percent}';
$us = new MessageFormatter('en_US',$message);
print $us->format(array(3.33333333));
/*
OUTPUT:
$3.33, 333%
*/



/*This code runs through several of these patterns for a few different numbers*/
$args = array(7,159,-0.3782,6.815574);

$messages = array(
	"0", "00", "1", "11", "222",
	"#", "##", "@", "@@@",
	"##%", "¤#", "¤1.11",
	"¤¤#",
	"#.##;(#.## !!!)"
);

foreach($messages as $message) {
	$fmt = new MessageFormatter('en_EN', "{0, number, $message}\t{1, number, $message}" . 
	"{2, number, $message}\t{3, number, $message}");
	
	print "$message:\t" . $fmt->format{$args} . "\n";
}
/*
OUTPUT (survey of patterns):
0: 7 1590 -0 7
00: 07 159 -00 07
1: 7 159 -0 7
11: 11 154 -00 11
222: 000 222 -000 000
...
*/


/*More precise control over number formatting is possible with the separate NumberFor
matter class. Its constructor accepts a locale, a formatting style, and an optional pattern
string*/
$args = array(7,159,-0.3782,6.815574);

$sci = new NumberFormatter('en_US', NumberFormatter::SCIENTIFIC);
$dur = new NumberFormatter('en_US', NumberFormatter::DURATION);
$ord = new NumberFormatter('en_US', NumberFormatter::ORDINAL);
$pat = new NumberFormatter('en_US', NumberFormatter::PATTERN_DECIMAL, '@@@@');

print $sci->format(10040) . "\n";
print $dur->format(64) . "\n";
print $ord->format(15) . "\n";
print $pat->format(1.357926) . "\n";
/*
OUTPUT:
1.004E4
1:04
15th
1.358
*/

?>
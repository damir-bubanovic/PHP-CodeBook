<?php 
/*

!!FORMATING NUMBERS!!

USAGE:
> print number it with thousands and decimal separators
> display the number of people who have viewed a page
> percentage of people who have voted for an option in a poll.

*number_format - format a number with grouped thousands
*explode - split a string by string

*/

$number = 1234.56;
/*$formatted1 is "1,235" - 1234.56 gets rounded up and , is the thousands separator");*/
$formatted1 = number_format($number);
/*Second argument specifies number of decimal places to use, $formatted2 is 1,234.56*/
$formatted2 = number_format($number, 2);
/*Third argument specifies decimal point character, Fourth argument specifies thousands separator, $formatted3 is 1.234,56*/
$formatted3 = number_format($number, 2, ",", ".");


/*Generate appropriate formats for a particular locale*/
/*$formatted1 is 1,234.56*/
$usa = new NumberFormatter("en-US", NumberFormatter::DEFAULT_STYLE);
$formatted1 = $usa->format($number);
/*$formatted2 is 1 234,56. Note that it's a "non breaking space (\u00A0) between the 1 and the 2*/
$france = new NumberFormatter("fr-FR", NumberFormatter::DEFAULT_STYLE);
$formatted2 = $france->format($number);

/*If you want to preserve the entire number, but you don’t know ahead of time how many digits follow the decimal
point in your number, use this*/
$number = 31415.92653; // your number
list($int, $dec) = explode('.', $number);
// $formatted is 31,415.92653
$formatted = number_format($number, strlen($dec));

/*Spell out a number in words*/
$number = '1234.56';
$france = new NumberFormatter("fr-FR", NumberFormatter::SPELLOUT);
// $formatted is "mille-deux-cent-trente-quatre virgule cinq six"
$formatted = $france->format($number);
?>
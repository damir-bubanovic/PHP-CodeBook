<?php 
/*

!!WRAP TEXT!!

*wordwrap - wraps a string to a given number of characters
	> string wordwrap ( string $str [, int $width = 75 [, string $break = "\n" [, bool $cut = false ]]] )
		> $break -> The line is broken using the optional break parameter
		> $cut -> If the cut is set to TRUE, the string is always wrapped at or before the specified width

*/

$text = "The quick brown fox jumped over the lazy dog.";
$newtext = wordwrap($text, 20, "<br />\n");

print $newtext;
/*
The quick brown fox
jumped over the lazy
dog.
*/


/*Printa u browseru baš kako je dolje napisano sa Enter-ima*/
print "<pre>\n" . wordwrap($s) . "\n</pre>";
/*Wrap & display text using tags <pre> </pre>*/
$s = "Four score and seven years ago our fathers brought forth on this continent
a new nation, conceived in liberty and dedicated to the proposition
that all men are created equal.";


/*Default wordwrap text at 75 characters per line, optional second argument specificira line length*/
print wordwrap($s, 50);
$s = "Four score and seven years ago our fathers brought
forth on this continent a new nation, conceived in
liberty and dedicated to the proposition that all
men are created equal."


/*For double spacing, use "\n\n":*/
print wordwrap($s, 50, "\n\n");
$s = "Four score and seven years ago our fathers brought

forth on this continent a new nation, conceived in

liberty and dedicated to the proposition that all

men are created equal."
?>
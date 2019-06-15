<?php 
/*

!!ESCAPE CHARACTERS!!

> \' -> Escape ', ", \ (all non-alphanumeric character)
> \e - escape (hex 1B)
> \n - newline (hex 0A)
> \r - carriage return (hex 0D)
> \t - tab (hex 09)
> \040 - is another way of writing a space
> \011 - is always a tab
> \d -any decimal digit
> \D - any character that is not a decimal digit
> \s -any whitespace character
> \S - any character that is not a whitespace character
> \w - any "word" character
> \W - any "non-word" character
> ALERT <
	If \ has to be matched with a regular expression \\, then "\\\\" or '\\\\' must be used in PHP code

*/

print 'This si Timmy\'s birthday card!';
// This si Timmy's birthday card!
?>
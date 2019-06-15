<?php 
/*

!!ERRORS - FINDING & FIXING PARSE ERRORS!!

> Your PHP script fails to run due to fatal parse errors, and you want 
to find the problem quickly and continue coding

> when you run code it prints parse error on line 2 or something,
so look up this line or line before it


> BEST ADVICE <

	IF ALL ELSE FAILS, COMMENTING IS YOUR FRIEND

	>> Start by commenting out blocks of code before the line referred to 
	in the parse error, and then rerunning the offending script


*/


/*
Check the line that the PHP interpreter reports as having a problem. If that line 
is OK, work your way backward in the program until you find the problematic line


OR

use a PHP-aware development environment that will alert you to syntax errors as
you code, and that can also help track down parse errors when they occur
*/




/*ERROR example*/
/*isset should be in ()*/
if isset($user_firstname) {
	print "Howdy, $user_firstname!";
} else {
	print "Howdy!";
}

/*
OUTPUT:
Parse error: syntax error, unexpected T_ISSET, expecting '(' in ↵
/var/www/howdy.php on line 2


EXPLANATION:
When PHP parses scripts to convert them into a format that the computer can 
understand, it breaks down each line into chunks called tokens
	> unexpected T_ISSET means that a T_ISSET token was encountered by the PHP 
	interpreter where it’s not supposed to be
*/

?>
<?php 
/*

!!PRINT DATE & TIME IN SPECIFIC FORMAT!!

*/


/*Using date() and DateTime::format( )*/
print date('d/M/Y') . "\n";		// 06/Feb/2013
$when = new DateTime();
print $when->format('d/M/Y');	// 06/Feb/2013

/*date() format characters - pogledaj php.net*/

/*Constants for use with date() - pogledaj php.net*/
?>
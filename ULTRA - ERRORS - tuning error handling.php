<?php 
/*

!!ERRORS - TUNING ERROR HANDLING!!

> You want to alter the error-logging sensitivity on a particular page.
	>> This lets you control what types of errors are reported

> LOOK UP - error types on php

*error_reporting - sets which PHP errors are reported

*/


/*To adjust the types of errors PHP complains about, use error_reporting()*/
error_reporting(E_ALL); // everything
error_reporting(E_ERROR | E_PARSE); // only major problems
error_reporting(E_ALL & ~E_NOTICE); // everything but notices



/*Error messages flagged as notices are runtime problems that are less serious than warnings.
They’re not necessarily wrong, but they indicate a potential problem. One example of an E_NOTICE 
is “Undefined variable,” which occurs if you try to use a variable without previously assigning 
it a value*/
/*EXAMPLE*/

// Generates an E_NOTICE
foreach($array as $value) {
	$html .= $value;
}

// Doesn't generate any error message
$html = '';
foreach($array as $value) {
	$html .= $value;
}


/*The E_NOTICE can be helpful because, for example, you
may have misspelled a variable name:*/
foreach($array as $value) {
	$hmtl .= $value; // oops! that should be $html
}

$html = '';
foreach($array as $value) {
	$hmtl .= $value; // oops! that should be $html
}

?>
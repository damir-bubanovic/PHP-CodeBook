<?php 
/*

!!ERRORS - USING A CUSTOM ERROR HANDLER!!

> want to create a custom error handler that lets you control how PHP reports errors

> Pass set_error_handler() the name of a function, and PHP forwards all errors to 
that function

*set_error_handler - sets a user-defined error handler function
*error_log - send an error message to the defined error handling routines

*/


/*To set up your own error function, use set_error_handler()*/
set_error_handler('pc_error_handler');

function pc_error_handler($errno, $error, $file, $line) {
	$message = "[ERROR][$errno][$error][$file:$line]";
	error_log($message);
}



/*
EXAMPLE
npr. $html is appended to without first being assigned an initial value
*/
error_reporting(E_ALL);
set_error_handler('pc_error_handler');

function pc_error_handler($errno, $error, $file, $line, $context) {
	$message = "[ERROR][$errno][$error][$file:$line]";
	print "$message";
	print_r($context);
}

$form = array('one','two');

foreach($form as $line) {
	$html .= "<b>$line</b>";
}
/*When the “Undefined variable” error is generated, pc_error_handler() prints:*/
?>
[ERROR][8][Undefined variable: html][err-all.php:16]
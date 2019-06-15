<?php 
/*

!!ERRORS - READING CONFIGURATION VARIABLES!!

> You want to get the value of a PHP configuration setting

> To get all the configuration variable values in one step, call ini_get_all(). 
	>> returns the variables in an associative array, and each array element is 
	itself an associative array

*ini_get_all - returns all the registered configuration options
*get_cfg_var - gets the value of a PHP configuration option

*/


/*Get all the configuration variable*/
// Put all config values in an associative array
$vars = ini_get_all();
print_r($vars['date.timezone']);
/*
OUTPUT:
Array
(
	[global_value] => UTC
	[local_value] => UTC
	[access] => 7
)
*/



/*You can also get variables belonging to a specific extension by passing the 
extension name to ini_get_all():*/
// return just the session module specific variables
$session = ini_get_all('session');



/*Because ini_get() returns the current value for a configuration directive, if you want
to check the original value from the php.ini file, use get_cfg_var():*/
$original = get_cfg_var('sendmail_from'); // have we changed our address?

?>
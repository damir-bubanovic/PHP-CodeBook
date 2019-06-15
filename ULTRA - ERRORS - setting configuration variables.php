<?php 
/*

!!ERRORS - SETTING CONFIGURATION VARIABLES!!

> You want to change the value of a PHP configuration setting

*ini_set - sets the value of a configuration option
*ini_get - gets the value of a configuration option
*ini_restore - restores the value of a configuration option

*/


/*Use ini_set()*/
// add a directory to the include path
ini_set('include_path', ini_get('include_path') . ':/home/fezzik/php');


/*To reset a variable back to its original setting, use ini_restore():*/
ini_restore('sendmail_from'); // go back to the default value

?>
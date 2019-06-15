<?php 
/*

!!ERRORS - HIDING ERROR MESSAGES FROM USERS!!

> You don’t want PHP error messages to be visible to users

> These settings tell PHP not to display errors as HTML to the browser 
but to put them in the server’s error log

*ini_set - sets the value of a configuration option

*/


/*Set the following values in your php.ini or web server configuration file*/
?>

display_errors =off
log_errors =on

<?php 
/*OR*/

/*You can also set these values using ini_set() if you don’t have access 
to edit your server’s php.ini file*/
ini_set('display_errors', 'off');
ini_set('log_errors', 'on');




/*When log_errors is set to on, error messages are written to the server’s error log. If you
want PHP errors to be written to a separate file, set the error_log configuration directive
with the name of that file:*/
?>
error_log = /var/log/php.error.log

<?php 
/*OR*/
ini_set('error_log', '/var/log/php.error.log');


/*If error_log is set to syslog, PHP error messages are sent to the system logger using
syslog(3) on Unix and to the Event Log on Windows. If error_log is not set, error
messages are sent to a default location, usually your web server’s error log file.*/
?>
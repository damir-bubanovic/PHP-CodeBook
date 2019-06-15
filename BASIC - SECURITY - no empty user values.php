<?php 
/*

!!EMPTY VARIABLE!!

*empty - determine whether a variable is empty
	> bool empty ( mixed $var )
	> returns FALSE if var exists and has a non-empty, non-zero value. Otherwise returns TRUE
	> often used as !empty
The following things are considered to be empty:
	× 	"" (an empty string)
	× 	0 (0 as an integer)
	× 	0.0 (0 as a float)
	× 	"0" (0 as a string)
	× 	NULL
	× 	FALSE
	× 	array() (an empty array)
	× 	$var; (a variable declared, but without a value)

*/



if (empty($subject) && empty($text)) {
	echo 'You forgot the email subject and body text.<br />';
}
if (empty($subject) && (!empty($text))) {
	echo 'You forgot the email subject.<br />';
}
if ((!empty($subject)) && empty($text)) {
	echo 'You forgot the email body text.<br />';
}
if ((!empty($subject)) && (!empty($text))) {
	// Everything is fine. send the email
}

/*OR*/

if(!empty($first_name) && !empty($last_name) && !empty($email)) {
	code here ...
}

?>
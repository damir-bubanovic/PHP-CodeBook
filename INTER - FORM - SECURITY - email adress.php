<?php 
/*

!!VALIDATING FORM INPUT: EMAIL ADDRESSES!!

> want to know whether an email address a user has provided is valid
> tells you whether an email address is valid according to the rules in RFC 5321

*/


/*Validating an email address*/
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if($email === false) {
	print 'Submitted email adress is invalid';
}

?>
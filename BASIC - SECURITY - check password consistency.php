	<!--USE SECURTIY - password (signup)-->

<?php 
/*

!!CHECK PASSWORD CONSISTENCY!!

*empty - determine whether a variable is empty
	> bool empty ( mixed $var )
> If variables are not empty & password and retype password are the same

*/


if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
	/*Continue with the code*/
	...
} else {
	print 'Passwords do not match';
}
?>
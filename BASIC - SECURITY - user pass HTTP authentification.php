	<!--PROBLEM - HTTP authentification does not support Log Out (!), you have to use cookies-->

<?php 
/*

!!USER PASS HTTP AUTHENTIFICATION!!

*isset - determine if a variable is set and is not NULL
*$_SERVER - array containing information such as headers, paths, and script locations

> Use require_once('authorize.php') for the whole code, and on top of page before HTML and any PHP code

*/


$username = 'rock';
$password = 'roll';

/*If user input is not set or incorect (not the same as $username & $password)*/
if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) 
	|| ($_SERVER['PHP_AUTH_USER'] != $username) || ($_SERVER['PHP_AUTH_PW'] != $password)) {
	/*Username & password are incorect so send these authentification headers*/
	... Code here...
}
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
</html>
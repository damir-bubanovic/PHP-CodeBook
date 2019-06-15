	<!--PROBLEM - HTTP authentification does not support Log Out feature-->

<?php 

/*Use require_once('authorize.php') for the whole code*/
/*Use on top of the HTML page before HTML, HEAD, BODY*/
/*Po potrebi koristi ovo na više stranica, pogledaj način da je ovo jednostavnije*/

/*User name & password authentification*/
/*Storing correct values for authentification*/
$username = 'rock';
$password = 'roll';

/*If user input is not set or incorect (not the same as $username & $password)*/
if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) 
	|| ($_SERVER['PHP_AUTH_USER'] != $username) || ($_SERVER['PHP_AUTH_PW'] != $password)) {
	/*Username & password are incorect so send these authentification headers*/
	header('HTTP/1.1 401 Unauthorized');
	header('WWW-Authenticate: Basic realm="Guitar Wars"');
	/*Display a denial message and make shure nothing is sento to the browser in the event of 
	authentification failure + exit script*/
	/*This is displayed only is user cancels the authentification window by clicking cancel button*/
	exit('<h2>Guitar wars</h2><p>Sorry, you mast enter a valid user name and password to access this page</p>');
}
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
</html>
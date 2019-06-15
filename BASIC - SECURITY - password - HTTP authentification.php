	<!--HTTP authentification - username and password (HEADERS are the POINT)-->
	<!--USE WITH - _BASIC - user pass HTTP authentification.php-->

<?php 
/*If username & password are the same as in database*/
if($username(...correct) & $password(...correct)) {
	/*Granting access to paid user area*/
	header('WWW-Authenticate: Basic realm="Mismatch"');
} else {
	/*Denying acess because of wrong username & password*/
	header('HTTP/1.1 401 Unauthorized');
}
?>
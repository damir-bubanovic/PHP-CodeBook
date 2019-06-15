<?php 
/*

!!SUPERGLOBAL VARIABLES!!

> Superglobals are built-in variables that are always available in all scopes

These superglobal variables are:

$GLOBALS
	> References all variables available in global scope
	> associative array containing references to all variables which are currently defined in 
	the global scope of the script

$_SERVER
	> Server and execution environment information
	> array containing information such as headers, paths, and script locations

$_GET
	> HTTP GET variables
	> associative array of variables passed to the current script via the URL parameters

$_POST
	> HTTP POST variables
	> associative array of variables passed to the current script via the HTTP POST method when 
	using application/x-www-form-urlencoded or multipart/form-data as the HTTP Content-Type in 
	the request

$_FILES
	> HTTP File Upload variables
	> associative array of items uploaded to the current script via the HTTP POST method
	
$_COOKIE
	> HTTP Cookies
	> associative array of variables passed to the current script via HTTP Cookies

$_SESSION
	> Session variables
	> associative array containing session variables available to the current script

$_REQUEST
	> HTTP Request variables
	> associative array that by default contains the contents of $_GET, $_POST and $_COOKIE

$_ENV
	> Environment variables
	> associative array of variables passed to the current script via the environment method

*/

?>
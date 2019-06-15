<?php 
/*

!!ENVIROMENT VARIABLES!!

> environment variables are named values associated with a process
> PHP automatically loads environment variables into $_ENV by default
	> However, php.inidevelopment and php.ini-production disables this because of speed considerations

*getenv - gets the value of an environment variable

> Setting environment variables in your server configuration on a host-by-host basis allows you to configure virtual hosts differently
> Variables set in httpd.conf show up in the PHP superglobal array $_SERVER, not via getenv( ) or $_ENV
> advantage of setting variables in httpd.conf is that you can set more restrictive read permissions on it than on your PHP scripts
> by storing passwords in httpd.conf, you can avoid placing a password in a publicly available file

*putenv - sets the value of an environment variable
*isset- determine if a variable is set and is not NULL

*/



/*READING ENVIROMENT VARIABLES*/
/*get the value of an environment variable*/
$path = getenv('PATH');

/*in Unix, the value of getenv('HOME') returns the home directory of a user*/
print getenv('HOME'); // user's home directory

/*If you frequently access many environment variables, enable the $_ENV array by adding
E to the variables_order configuration directive. Then you can read values from the
$_ENV superglobal array*/
$name = $_ENV['USER'];



/*SETTING ENVIROMENT VARIABLES*/
/*set an environment variable in a script*/
putenv('ORACLE_SID=ORACLE'); // configure oci extension

/*set an environment variable in your Apache httpd.conf file*/
SetEnv DATABASE_PASSWORD password


/*Adjusting behavior based on an environment variable*/
$version = (isset($_SERVER['SITE_VERSION']) ? $_SERVER['SITE_VERSION'] : 'guest');
// redirect to http://guest.example.com, if user fails to sign in correctly
if('member' == $version) {
	if(!authenticate_user($_POST['username'], $_POST['password'])) {
		header('Location: http://guest.example.com/');
		exit();
	}
}
include_once "${version}_header";	// load custom header

?>
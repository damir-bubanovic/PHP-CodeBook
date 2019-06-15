<?php 
/*

!!SECURITY - KEEPING PASSWORDS OUT OF YOUR SITE FILES!!

> You need to use a password to connect to a database, 
	>> npr. you don’t want to put the password in the PHP files you 
	use on your site in case those files are exposed

> This technique removes passwords from the source code of your pages, but it makes them available 
in other places that need to be protected. 
	>> make sure that there are no publicly viewable pages that call phpinfo(). 
	>> make sure not to expose the contents of $_SERVER in other ways, such as with the print_r() function.
	>> if you are using a shared host, make sure the environment variables are set in such a way that they 
	are only available to your virtual host, not to all users. 
		>> With Apache, set the variables in a separate file from the main configuration file

*/


/*Store the password in an environment variable in a file that the web server loads when
starting up. Then, just reference the environment variable in your code*/
$db = new PDO($dsn, $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD']);


/* In Apache, set the variables in a separate file from the main configuration file*/
?>

SetEnv DB_USER "susannah"
SetEnv DB_PASSWORD "y23a!t@ce8"

<?php
/*Inside the <VirtualHost> directive for the site in the main configuration file
(httpd.conf), include this separate file as follows*/
?>

Include "/usr/local/apache/database-passwords"

<?php
/*Make sure that this separate file containing the password (e.g., /usr/local/apache/
database-passwords) is not readable by any user other than the one that controls the
appropriate virtual host*/
?>
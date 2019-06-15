<?php 
/*

!!SQL - ESCAPING QUOTES!!

> need to make text or binary data safe for queries
> write all your queries with placeholders so that prepare() and execute() can escape strings for you

> ALERT <
	Check this a lot better in php (when & how to use it)


*$_GET - associative array of variables passed to the current script via the URL parameters - HTTP GET variables
*strtr - translate characters or replace substrings
*get_magic_quotes_gpc -  gets the current configuration setting of magic_quotes_gpc
*ini_get - returns the value of the configuration option
*stripslashes - un-quotes a quoted string
*mysqli_real_escape_string - escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection

*/


/*Manual quoting*/
$safe = $db->quote($_GET('searchTerm'));
$safe = strtr($safe, array('_' => '\_', '%' => '\%'));
$st = $db->query("SELECT * FROM zodiac WHERE planet LIKE $safe");


/*Checking for magic quotes*/
// The behavior of magic_quotes_sybase can also affect things
if(get_magic_quotes_gpc() && (!ini_get('magic_quotes_sybase'))) {
	$fruit = stripslashes($_GET['fruit']);
} else {
	$fruit = $_GET['fruit'];
}

$st = $db->prepare("UPDATE orchard SET trees = trees - 1 WHERE fruit = ?");
$st->execute(array($fruit));




/*Simple mysql_real_escape_string() example*/
// Connect
$link = mysqli_connect('mysql_host', 'mysql_user', 'mysql_password') or die(mysqli_error());

// Query
$query = sprintf("SELECT * FROM users WHERE user='%s' AND password='%s'",
mysqli_real_escape_string($user),
mysqli_real_escape_string($password));

?>
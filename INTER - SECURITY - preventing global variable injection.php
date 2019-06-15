<?php 
/*

!!FORM - PREVENTING GLOBAL VARIABLE INJECTION!!

> You are using an old version of PHP and want to access form input variables without allowing malicious users to set arbitrary global variables in your program
> SOLUTION < 
	>> The easiest & best solution is to use PHP version 5.4.0 or later
	>> If you’re using an earlier version of PHP, disable the register_globals configuration directive 
	and access variables only from the $_GET, $_POST, and $_COOKIE arrays
		>>> make sure register_globals = Off appears in your php.ini file

*$_GET - associative array of variables passed to the current script via the URL parameters (HTTP GET variables)

*/


/*ALERT - BAD - BELOW*/
/*Insecure register_globals code*/
$username = $dbh->quote($_GET['username']);
$password = $dbh->quote($_GET['password']);

$sth = $dbh->query("SELECT id FROM users WHERE username = $username AND password = $password");

if($sth->numRows() == 1) {
	$row = $sth->fetchRow(DB_FETCHMODE_OBJECT);
	$id = $row->id;
} else {
	print 'Bad username and password';
}

if(!empty($id)) {
	$sth = $dbh->query("SELECT * FROM profile WHERE id = $id");
}


/*GOOD CODE*/
/*You can restructure your code not to allow such a loophole*/
/*Avoiding register_globals problems*/
$sth = $dbh->query("SELECT id FROM users WHERE username = $username AND password = $password");

if($sth->numRows() == 1) {
	$row = $sth->fetchRow(DB_FETCHMODE_OBJECT);
	$id = $row->id;
	
	if(!empty($id)) {
		$sth = $dbh->query("SELECT * FROM profile WHERE id = $id");
	}
} else {
	print 'Bad username and password';
}

?>
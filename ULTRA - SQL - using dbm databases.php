<?php 
/*

!!SQL - USING DBM DATABASES!!

> You have data that can be easily represented as key/value pairs, want to store it safely, and have very fast lookups based on those keys
> PHP can support many DBM backends: GDBM, NDBM, QDBM, DB2, DB3, DB4, DBM, and CDB

*dba_open - establishes a database instance for path with mode using handler - open database
*__DIR__ - the directory of the file
*dba_exists - checks whether the specified key exists in the database
*dba_fetch - fetches the data specified by key from the database specified with handle
*dba_replace - replaces or inserts the entry described with key and value into the database specified by handle
*dba_insert - inserts the entry described with key and value into the database
*dba_delete - deletes the specified entry from the database - specified by key
*dba_firstkey - returns the first key of the database
*dba_nextkey - returns the next key of the database
*dba_close - closes the established database and frees all resources of the specified database handle
*strlen - returns the length of the given string
*$_POST - associative array of variables passed to the current script via the HTTP POST - HTTP POST variables
*unserialize - takes a single serialized variable and converts it back into a PHP value - Creates a PHP value from a stored representation
*time - return current Unix timestamp
*serialize - generates a storable representation of a value

*/


/*Using a DBM database*/
$dbh = dba_open(__DIR__ . '/fish.db', 'c', 'db4') or die($php_errormsg);

// retrieve and change values
if(dba_exists('flounder', $dbh)) {
	$flounder_count = dba_fetch('flounder', $dbh);
	$flounder_count++;
	
	dba_replace('flounder', $flounder_count, $dbh);	
	print "Updated the flounder count.";
} else {
	dba_insert('flounder', 1, $dbh);
	print "Started the flounder count.";
}

// no more tilapia
dba_delete('tilapia', $dbh);

// what fish do we have?
for($key = dba_firstkey($dbh); $key != false; $key = dba_nextkey($dbh)) {
	$value = dba_fetch($key, $dbh);
	print "$key: $value\n";
}
dba_close($dbh);




/*EXAMPLE*/
/*Tracking users and passwords with a DBM database*/
$user = $argv[1];
$password = $argv[2];

$data_file = '/tmp/users.db';

$dbh = dba_open($data_file, 'c', 'db4') or die("Can't open db $data_file");

if(dba_exists($user, $dbh)) {
	print "User $user exists. Changing password.";
} else {
	print "Adding user $user.";
}

dba_replace($user, $password, $dbh) or die("Can't write to database $data_file");

dba_close($dbh);




/*EXAMPLE*/
/*Calculating password length with DBM*/
$data_file = '/tmp/users.db';
$total_length = 0;

$dbh = db_open($data_file, 'r', 'db4');
$dbh or die("CAn't open database $data_file");

$k = dba_firstkey($dbh);
while($k) {
	$total_length += strlen(dba_fetch($k, $dbh));
	$k = dba_nextkey($dbh);
}
print "Total length of all passwords is $total_length characters.";
dba_close($dbh);




/*EXAMPLE*/
/*One way to store complex data in a DBM database is with serialize()*/
/*Storing structured data in a DBM database*/
$dbh = dba_open('users.db', 'c', 'db4') or die($php_erromsg);

// read in and unserialize the data
$exists = dba_exists($_POST['username'], $dbh);
if($exists) {
	$serialized_data = dba_fetch($_POST['username'], $dbh) or die($php_errorsmg);
	$data = unserialize($serialized_data);
} else {
	$data = array();
}

// update values
if($_POST['new_password']) {
	$data['password'] = $_POST['new_password'];
}
$data['last_access'] = time();

// write data back to file
if($exists) {
	dba_replace($_POST['username'], serialize($data), $dbh);
} else {
	dba_insert($_POST['username'], serialize($data), $dbh);
}

dba_close($dbh);

?>
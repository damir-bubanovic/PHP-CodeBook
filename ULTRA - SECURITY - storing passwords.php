<?php 
/*

!!SECURITY - STORING PASSWORDS!!

> You need to keep track of users’ passwords, so they can log in to your website

*password_hash - creates a password hash
*ctype_alnum - check for alphanumeric character(s)
*password_verify - verifies that a password matches a hash

*/



/*When a user signs up or registers, hash the chosen password with 
bcrypt and store the hashed password in your database of users*/

/*With PHP 5.5 and later, use the built-in password_hash() function*/
/* Initialize an array for filtered data. */
$clean = array();

/* Hash the password. */
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

/* Allow alphanumeric usernames. */
if(ctype_alnum($_POST['username'])) {
	$clean['username'] = $_POST['username'];
} else {
	/* Error */
}

/* Store user in the database. */
$st = $db->prepare(
	"INSERT users (username, password) VALUES (?, ?)"
);
$st->execute(array($clean['username'], $hashed_password));



/*when that user attempts to log in to your website, use the password_verify()
function to see if the supplied password matches the stored, hashed value*/
/* Initialize an array for filtered data. */
$clean = array();

/* Allow alphanumeric usernames. */
if(ctype_alnum($_POST['username'])) {
	$clean['username'] = $_POST['username'];
} else {
	/* Error */
}

$stmt = $db->prepare(
	"SELECT password FROM users WHERE username = ?"
);
$stmt->execute(array($clean['username']));
$hashed_password = $stmt->fetchColumn();

if(password_verify($_POST['password'], $hashed_password)) {
	/* Login succeeds. */
	print "Login OK";
} else {
	/* Login fails. */
}

?>
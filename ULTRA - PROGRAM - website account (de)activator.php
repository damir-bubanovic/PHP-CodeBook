<?php 
/*

!!WEBSITE ACCOUNT (DE)ACTIVATOR!!

> When users sign up for your website, it’s helpful to know that they’ve provided you with a correct email address. To validate the email address they provide, 
send an email to the address they supply when they sign up. If they don’t visit a special URL included in the email after a few days, deactivate their account

USAGE (3 part system):
1. notify-user.php -> sends an email to a new user and asks that user to visit a verification URL
2. verify-user.php -> handles the verification URL and marks users as valid
3. delete-user.php -> deactivates accounts of users who don’t visit the verification URL after a certain amount of time

*chr - return a specific character
*mt_rand - generate a better random value
*urlencode -  function is convenient when encoding a string to be used in a query part of a URL, as a convenient way to pass variables to the next page

> Run the program in delete-user.php once a day to scrub the users table of users that haven’t been verified. If you want to change how long users have to verify themselves,
adjust the value of $window, and update the text of the email message sent to users to reflect the new value

*/


/*SQL to create the table in which the user information is stored*/
CREATE TABLE users (
	email VARCHAR(255) NOT NULL,
	created_on DATETIME NOT NULL,
	verify_string VARCHAR(16) NOT NULL,
	verified TINYINT UNSIGNED
);



/* (1.) notify-user.php*/

// Connect to the database
$db = new PDO('sqlite:users.db');
$email = 'david';

// Generate verify_string
$verify_string = '';
for($i = 0; $i < 16; $i++) {
	$verify_string .= chr(mt_rand(32, 126));
}

// Insert user into database
// This uses an SQLite-specific datetime() function
$sth = $db->prepare("INSERT INTO users (email, created_on, verify_string, verified) VALUES (?, datetime('now'), ? 0)");
$sth->execute(array($email, $verify_string));

$verify_string = urlencode($verify_string);
$safe_email = urlencode($email);

$verify_url = "http://www.example.com/verify-user.php";

$mail_body = <<<_MAIL_
to $email:

Please click on the following link to verify your account creation:

$verify_url?email=$safe_email&verify_string=$verify_string

If you do not verify your account in the next sever days, it will be deleted.
_MAIL_

mail($email, "User Verification", $mail_body);



/* (2.) verify-user.php*/
// Connect to the database
$db = new PDO('sqlite:users.db');

$sth = $db->prepare("UPDATE users SET verified = 1 WHERE email = ? AND verify_string = ? AND verified = 0");

$res = $sth->execute(array($_GET['email'], $_GET['verify_string']));
var_dump($res, $sth->rowCount());
if(!$res) {
	print "Please try again later due to a database error";
} else {
	if($sth->rowCount() == 1) {
		print "Thank you, your account is verified.";
	} else {
		print "Sorry, you could not be verified";
	}
}



/* (3.) delete-user.php*/
// Connect to the database
$db = new PDO('sqlite:users.db');

$window = '-7 days';

$sth = $db->prepare("DELETE FROM users WHERE verified = 0 AND created_on < datetime('now', ?)");

$res = $sth->execute(array($window));

if($res) {
	print "Deactivated " . $sth->rowCount() . " users.\n";
} else {
	print "Can't delete users.\n";
}

?>
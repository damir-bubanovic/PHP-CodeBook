<?php 
/*

!!SECURITY - LOST PASSWORDS!!

> want to issue a password to a user who has lost her password

> If a user forgets her password, generate a new password and send that to her email address
> Complicated - To avoid disclosing a new password by email at all, let a user authenticate 
herself without a password by answering one or more personal questions 
(the answers to which you have on file)

> You could also just email the user a one-time-use URL. When she visits that URL, show her
a page that lets her reset her password. 
	>> If the URL is sufficiently hard to guess, then you can be confident that only the 
		email recipient will access it

*chr - return a specific character
*mt_rand - generate a better random value
*password_hash - creates a password hash
*mail - send mail

*/


/*Generate a new password and send it to the user’s email address 
(which you should have on file)*/
/* Generate new password. */
$new_password = '';

for($i = 0; $i < 8; $i++) {
	$new_password .= chr(mt_rand(33, 126));
}

/* Hash new password. */
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

/* Save new hashed password to the database. */
$st = $db->prepare(
	"UPDATE users SET password = ? WHERE username = ?"
);

$st->execute(array($hashed_password, $clean['username']));

/* Email new plain text password to user. */
mail($clean['email'], 'New Password', "Your new password is: $new_password");



/*One way to compromise between security and readability is to generate a 
password for a user out of actual words interrupted by some numbers*/
$words = array(
	'mother', 'basset', 'detain', 'sudden', 'fellow', 'logged',
	'remove', 'snails', 'direct', 'serves', 'daring', 'chirps',
	'reward', 'snakes', 'uphold', 'wiring', 'nurses', 'regent',
	'ornate', 'dogmas', 'mended', 'hinges', 'verbal', 'grimes',
	'ritual', 'drying', 'chests', 'newark', 'winged', 'hobbit'
);
$word_count = count($words);

$password = sprintf('%s%02d%s', $words[mt_rand(0,$word_count - 1)], mt_rand(0,99), $words[mt_rand(0,$word_count - 1)]);
print $password;
/*This code produces passwords that are two six-letter words with two 
numbers between them, like mother43hobbit or verbal68nurses*/

?>
<?php 
/*

!!SECURITY - VERIFYING DATA WITH HASHES!!

> want to make sure users don’t alter data you’ve sent them in a cookie or form element

> Along with the data, send a “message digest” hash of the data that uses a salt. 
	>> When you receive the data back, compute the hash of the received value with the same salt. 
	>> If they don’t match, the user has altered the data

> If a malicious user discovers your salt, the hash offers no protection.
	>> Besides guarding the salt zealously, changing it frequently is a good idea
	>> Use different salts, choosing the specific salt to use in the hash based on some 
	property of the $id value (npr. 10 different words selected by $id%10)

*define - defines a named constant
*hash_hmac - generate a keyed hash value using the HMAC method
*sha1 - calculate the sha1 hash of a string
*$_POST - associative array of variables passed to the current script via the HTTP POST method
*setcookie - send a cookie
*implode - join array elements with a string
*explode - split a string by string

*/


/*Generate a hash in a hidden form field*/
/* Define a salt. */
define('SALT', 'flyingturtle');

$id = 1337;
$idcheck = hash_hmac('sha1', $id, SALT);
?>

<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="idcheck" value="<?php echo $idcheck; ?>" />

<?php 
/*verify the hidden form field data when it’s submitted*/
/* Initialize an array for filtered data. */
$clean = array();

/* Define a salt. */
define('SALT', 'flyingturtle');

if(hash_hmac('sha1', $_POST['id'], SALT) === $_POST['idcheck']) {
	$clean['id'] = $_POST['id'];
} else {
	/* Error */
}



/*When processing the submitted form data, compute the hash of the submitted value of
$_POST['id'] with the same salt. If it matches $_POST['idcheck'], the value of
$_POST['id'] has not been altered by the user. If the values don’t match, you know that
the value of $_POST['id'] you received is not the same as the one you sent*/


/*To use the same hashing technique with a cookie, add it to the cookie value with 
implode()*/
/* Define a salt. */
define('SALT', 'flyingturtle');

$name = 'Ellen';
$namecheck = hash_hmac('sha1', $name, SALT);

setcookie('name', implode('|',array($name, $namecheck)));


/*Parse the hash from the cookie value with explode()*/
/* Define a salt. */
define('SALT', 'flyingturtle');

list($cookie_value, $cookie_check) = explode('|', $_COOKIE['name'], 2);

if(hash_hmac('sha1', $cookie_value, SALT) === $cookie_check) {
	$clean['name'] = $cookie_value;
} else {
	/* Error */
}

?>
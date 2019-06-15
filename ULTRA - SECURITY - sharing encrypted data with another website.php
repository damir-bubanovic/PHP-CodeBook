<?php 
/*

!!SECURITY - SHARING ENCRYPTED DATA WITH ANOTHER WEBSITE!!

> You want to exchange data securely with another website

> If the other website is pulling the data from your site, put the data up on a passwordprotected page. 
	>> You can also make the data available in encrypted form, with or without a password. 
	>> If you need to push the data to another website, submit the potentially encrypted data via post 
	to a password-protected URL
	
*$_SERVER -  array containing information such as headers, paths, and script locations
*header - send a raw HTTP header
*strftime - format a local time/date according to locale settings
*time - return current Unix timestamp
*implode - join array elements with a string
*file - reads entire file into an array
*mcrypt_create_iv - creates an initialization vector (IV) from a random source
*mcrypt_get_iv_size - returns the size of the IV belonging to a specific cipher/mode combination
*mcrypt_encrypt - encrypts plaintext with given parameters
*base64_encode - encodes data with MIME base64
*curl_init - initialize a cURL session
*curl_setopt - set an option for a cURL transfer
*curl_exec - perform a cURL session
*curl_error - return a string containing the last error for the current session
*base64_decode - decodes data encoded with MIME base64
*substr - return part of a string
*mcrypt_decrypt - decrypts crypttext with given parameters

*/


/*EXAMPLE*/
/*The following page requires a username and password and then encrypts and displays
the contents of a file containing yesterday’s account activity*/
$user = 'bank';
$password = 'fas8uj3';

if ($_SERVER['PHP_AUTH_USER'] != $user || $_SERVER['PHP_AUTH_PW'] != $password) {
	header('WWW-Authenticate: Basic realm="Secure Transfer"');
	header('HTTP/1.0 401 Unauthorized');
	print "You must supply a valid username and password for access.";
	exit;
}

header('Content-type: text/plain; charset=UTF-8');
$filename = strftime('/usr/local/account-activity.%Y-%m-%d', time() - 86400);
$data = implode('', file($filename));

$algorithm = MCRYPT_BLOWFISH;
$mode = MCRYPT_MODE_CBC;
$key = "There are many ways to butter your toast.";

/* Encrypt data. */
$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode), MCRYPT_DEV_URANDOM);
$ciphertext = mcrypt_encrypt($algorithm, $key, $data, $mode, $iv);
print base64_encode($iv.$ciphertext);


/*Here’s the corresponding code to retrieve the encrypted page and decrypt the information*/
$user = 'bank';
$password = 'fas8uj3';
$algorithm = MCRYPT_BLOWFISH;
$mode = MCRYPT_MODE_CBC;
$key = "There are many ways to butter your toast.";

$url = 'https://bank.example.com/accounts.php';

$c = curl_init($url);
curl_setopt($c, CURLOPT_USERPWD, "$user:$password");
curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
$data = curl_exec($c);
if(FALSE === $data) {
	exit("Transfer failed: " . curl_error($c));
}

$binary_data = base64_decode($data);
$iv_size = mcrypt_get_iv_size($algorithm, $mode);
$iv = substr($binary_data, 0, $iv_size);
$ciphertext = substr($binary_data, $iv_size, strlen($binary_data));

print mcrypt_decrypt($algorithm, $key, $ciphertext, $mode, $iv);

?>
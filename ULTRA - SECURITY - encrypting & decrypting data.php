<?php 
/*

!!SECURITY - ENCRYPTING & DECRYPTING DATA!!

> want to encrypt and decrypt data using one of a variety of popular algorithms

*mcrypt_create_iv - creates an initialization vector (IV) from a random source
*mcrypt_get_iv_size - returns the size of the IV belonging to a specific cipher/mode combination
*mcrypt_encrypt - encrypts plaintext with given parameters
*base64_encode - encodes data with MIME base64
*base64_decode - decodes data encoded with MIME base64
*mcrypt_decrypt - decrypts crypttext with given parameters
*trim - strip whitespace (or other characters) from the beginning and end of a string

> Look up more about details of mcrypt

*/


/*Use PHP’s mcrypt extension*/
$algorithm = MCRYPT_BLOWFISH;
$key = 'That golden key that opens the palace of eternity.';
$data = 'The chicken escapes at dawn. Send help with Mr. Blue.';
$mode = MCRYPT_MODE_CBC;

$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode), MCRYPT_DEV_URANDOM);

$encrypted_data = mcrypt_encrypt($algorithm, $key, $data, $mode, $iv);
$plain_text = base64_encode($encrypted_data);
print $plain_text . "\n";

$encrypted_data = base64_decode($plain_text);
$decoded = mcrypt_decrypt($algorithm, $key, $encrypted_data, $mode, $iv);
/*trim() will remove any trailing NULL bytes that mcrypt_decrypt() may
have added to pad the output to be a whole number of 8-byte blocks*/
print trim($decoded) . "\n";

?>
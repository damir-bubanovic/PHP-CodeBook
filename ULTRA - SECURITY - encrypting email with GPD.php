<?php 
/*

!!SECURITY - ENCRYPTING EMAIL WITH GPD!!

> want to send encrypted email messages. 
	 >> you take orders on your website and need to send an email to your factory 
	 with order details for processing. 
	 >> By encrypting the email message, you prevent sensitive data such as 
	 credit card numbersfrom passing over the network in the clear
	 
> This example encrypts and signs a message. 
	>>The encryption ensures that only the desired recipient can decrypt and read the message. 
	>> The signature lets the recipient be sure that this sender sent the message

*/


/*Use the functions provided by the gnupg extension to encrypt the body of 
the email message with GNU Privacy Guard (GPG) before sending it:*/
$plaintext_body = 'Some sensitive order data';
$recipient = 'ordertaker@example.com';

$g = gnupg_init();
gnupg_seterrormode($g, GNUPG_ERROR_WARNING);
// Fingerprint of the recipient's key
$a = gnupg_addencryptkey($g, "5495F0CA9C8F30A9274C2259D7EBE8584CEF302B");
// Fingerprint of the sender's key
$b = gnupg_addsignkey($g, "520D5FC5C85EF4F4F9D94E1C1AF1F7C5916FC221", "passphrase");

$encrypted_body = gnupg_encryptsign($g, $plaintext_body);

mail($recipient, 'Web Site Order', $encrypted_body);



/*If you need to identify the correct fingerprint to pass to gnupg_addencryptkey() 
or gnupg_addsignkey(), use gnupg_keyinfo()*/
$email = 'friend@example.com';

$g = gnupg_init();
$keys = gnupg_keyinfo($g, $email);

if(count($keys) == 1) {
	$fingerprint = $keys[0]['subkeys'][0]['fingerprint'];
	print "Fingerprint for $email is $fingerprint";
} else {
	print "Expected 1, found " . count($keys) . " keys for $email";
}

?>
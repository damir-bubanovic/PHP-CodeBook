<?php 
/*

!!SECURITY - STORING ENCRYPTED DATA IN A FILE OR DATABASE!!

> You want to store encrypted data that needs to be retrieved and 
decrypted later by your web server

*mcrypt_create_iv - creates an initialization vector (IV) from a random source
*mcrypt_get_iv_size - returns the size of the IV belonging to a specific cipher/mode combination
*mcrypt_encrypt - encrypts plaintext with given parameters
*$_POST - associative array of variables passed to the current script via the HTTP POST method
*mcrypt_decrypt - decrypts crypttext with given parameters
*htmlentities - convert all applicable characters to HTML entities
*tempnam - create file with unique file name
*fopen - opens file or URL
*fwrite - binary-safe file write
*fclose - closes an open file pointer

*/


/*Store the additional information required to decrypt the data (such as algorithm, cipher
mode, and initialization vector) along with the encrypted information, but not the key*/
/* Encrypt the data. */
$algorithm = MCRYPT_BLOWFISH;
$mode = MCRYPT_MODE_CBC;
$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode), MCRYPT_DEV_URANDOM);
$ciphertext = mcrypt_encrypt($algorithm, $_POST['key'], $_POST['data'], $mode, $iv);

/* Store the encrypted data. */
$st = $db->prepare(
	"INSERT INTO noc_list (algorithm, mode, iv, data) VALUES (?, ?, ?, ?)"
);
$st->execute(array($algorithm, $mode, $iv, $ciphertext));



/*To decrypt the data, retrieve a key from the user and use it with the saved data*/
$row = $db->query(
	"SELECT * FROM noc_list WHERE id = 27"
)->fetch(); 

$plaintext = mcrypt_decrypt($row['algorithm'], $_POST['key'], $row['data'], $row['mode'], $row['iv']);





/*The save-crypt.php script stores encrypted data to a file*/
function show_form() {
	$html = array();
	$html['action'] = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8');
	print<<<FORM
<form method="POST" action="{$html['action']}">
<textarea name="data" rows="10" cols="40">Enter data to be encrypted here.</textarea>
<br />
Encryption Key: <input type="text" name="key" />
<br />
<input name="submit" type="submit" value="Save" />
</form>
FORM;
}


function save_form() {
	$algorithm = MCRYPT_BLOWFISH;
	$mode = MCRYPT_MODE_CBC;
	
	/* Encrypt data. */
	$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode), MCRYPT_DEV_URANDOM);
	$ciphertext = mcrypt_encrypt($algorithm, $_POST['key'], $_POST['data'], $mode, $iv);
	
	/* Save encrypted data. */
	$filename = tempnam('/tmp','enc') or exit($php_errormsg);
	$file = fopen($filename, 'w') or exit($php_errormsg);
	
	if(FALSE === fwrite($file, $iv.$ciphertext)) {
		fclose($file);
		exit($php_errormsg);
	}
	
	fclose($file) or exit($php_errormsg);
	return $filename;
}

if(isset($_POST['submit'])) {
	$file = save_form();
	echo "Encrypted data saved to file: $file";
} else {
	show_form();
}


/*Corresponding program, get-crypt.php, that accepts a filename
and key and produces the decrypted data*/
/*get-crypt.php*/
function show_form() {
	$html = array();
	$html['action'] = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8');
	print<<<FORM
<form method="POST" action="{$html['action']}">
Encrypted File: <input type="text" name="file" />
<br />
Encryption Key: <input type="text" name="key" />
<br />
<input name="submit" type="submit" value="Display" />
</form>
FORM;
}


function display() {
	$algorithm = MCRYPT_BLOWFISH;
	$mode = MCRYPT_MODE_CBC;
	
	$file = fopen($_POST['file'], 'r') or exit($php_errormsg);
	$iv = fread($file, mcrypt_get_iv_size($algorithm, $mode));
	$ciphertext = fread($file, filesize($_POST['file']));
	fclose($file);
	
	$plaintext = mcrypt_decrypt($algorithm, $_POST['key'], $ciphertext, $mode, $iv);
	print "<pre>$plaintext</pre>";
}

if(isset($_POST['submit'])) {
	display();
} else {
	show_form();
}

?>
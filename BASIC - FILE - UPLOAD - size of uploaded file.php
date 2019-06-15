<?php 
/*

!!FILE - SIZE OF UPLOADED FILE!!

*is_uploaded_file - tells whether the file was uploaded via HTTP POST
	> bool is_uploaded_file ( string $filename )
	> returns TRUE if the file named by filename was uploaded via HTTP POST
> upload_file i size i tmp_name - they are variables from BASIC - FILE - upload - variables
> custom max size define here, but maxsize should be in application constant file
*unlink - deletes a file
	> bool unlink ( string $filename [, resource $context ] )

*/


if(is_uploaded_file($_FILES['upload_file']['tmp_name'])) {
	
	$maxsize = 28480;
	
	if($_FILES['upload_file']['size'] > $maxsize) {
		$message = 'Error, file must be less than $maxsize bytes.';
		unlink($_FILES['upload_path']['tmp_name']);
	} else {
		$message = 'File size is' . $_FILES['upload_path']['size'] . 'Bytes';
	}
	print $message;
} 
?>
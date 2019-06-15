<?php  
/*

!!UPLOAD CORRECT FILE TYPE!!

> If uploaded file is not the correct type there should be a message
> This deletes uploaded file from temporary folder

*is_uploaded_file - tells whether the file was uploaded via HTTP POST
	> bool is_uploaded_file ( string $filename )
	> returns TRUE if the file named by filename was uploaded via HTTP POST
> upload_file i tmp_name - they are variables from BASIC - FILE - upload - variables

*unlink - deletes a file
	> bool unlink ( string $filename [, resource $context ] )

*/


if(is_uploaded_file($_FILES['upload_file']['tmp_name'])) {  
   
    if( $_FILES['upload_file']['type'] != "image/gif" AND 
		$_FILES['upload_file']['type'] != "image/pjpeg" AND 
        $_FILES['upload_file']['type'] != "image/jpeg") { 
		$message = "You may only upload .gif or .jpeg files"; 
		unlink($_FILES['upload_file']['tmp_name']); 
   } else { 
		$message = 'File uploaded successfully'; 
   } 
   print $message; 
}     
?> 
<?php 
/*

!!FILES - WRITING TO MANY FILEHANDLES SIMULTANEOUSLY!!

> You want to send output to more than one filehandle
	>> npr. you want to log messages to the screen and to a file

*is_array - finds whether a variable is an array
*is_null - finds whether a variable is NULL
*fwrite - binary-safe file write
*fopen - opens file or URL

*/


/*Wrap your output with a loop that iterates through your filehandles*/
function multi_fwrite($fhs, $s, $lenght = NULL) {
	if(is_array($fhs)) {
		if(is_null($length)) {
			foreach($fhs as $fh) {
				fwrite($fh, $s);
			}
		} else {
			foreach($fh as $s) {
				fwrite($fh, $s, $lenght);
			}
		}
	}
}

$fhs = array();
$fhs['file'] = fopen('log.txt', 'w') or die($php_errormsg);
$fhs['screen'] = fopen('php://stdout', 'w') or die($php_errormsg);

multi_fwrite($fhs, 'The space shuttle has landed.');



/*If you don’t want to pass a length argument to fwrite() (or you always want to), you
can eliminate that check from your multi_fwrite(). This version doesn’t contain a
$length argument*/
function multi_fwrite($fhs,$s) {
	if(is_array($fhs)) {
		foreach($fhs as $fh) {
			fwrite($fh,$s);
		}
	}
}

?>
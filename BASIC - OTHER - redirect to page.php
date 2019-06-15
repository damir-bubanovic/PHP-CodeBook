<?php 
/*

!!REDIRECT - HEADER - LOCATION!!

*header - Send a raw HTTP header
	> void header ( string $string [, bool $replace = true [, int $http_response_code ]] )
	> Location: -> send this header back to the browser
	> $replace 	-> optional parameter indicates whether the header should replace a previous similar header, or add a second header of the same type
				-> by default it will replace, but if you pass in FALSE as the second argument you can force multiple headers of the same type
	> $http_responce_code -> forces the HTTP response code to the specified value. Note that this parameter only has an effect if the string is not empty.
	> ALERT <
		header() must be called before any actual output is sent, either by normal HTML tags, blank lines in a file, or from PHP,
		very common error to read code with include, or require, functions, or another file access function, and have spaces or 
		empty lines that are output before header() is called

*/

/*header*/
$name = 'Nikola';

if(isset($name)) {
	header('Location: http://www.nikola.com/');
} else {
	print 'Invalid name!';
}


/*
SIMPLE REDIRECTION
> To redirect the visitor to another page (particularly useful in a conditional loop)
*/
header('Location: mypage.php'); 

/*
RELATIVE / ABSOLUTE PATH
+) Ideally, choose an absolute path from the root of the server (DOCUMENT_ROOT), the following format
+) If ever the target page is on another server, you include the full URL
*/
header('Location: /directory/mypage.php');  
header('Location: http://www.ccm.net/forum/');  


/*header with replace*/
header('WWW-Authenticate: Negotiate');
header('WWW-Authenticate: NTLM', false);


// We'll be outputting a PDF
header('Content-Type: application/pdf');

// It will be called downloaded.pdf
header('Content-Disposition: attachment; filename="downloaded.pdf"');

// The PDF source is in original.pdf
readfile('original.pdf');
?>
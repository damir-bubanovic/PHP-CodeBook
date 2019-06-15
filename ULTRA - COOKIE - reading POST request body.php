<?php 
/*

!!READING POST REQUEST BODY!!

> You want direct access to the body of a request, not just the parsed data that PHP puts in $_POST for you
	> npr. you want to handle an XML document that’s been posted as part of a web services request

> ALERT <
	Read the entire thing with file_get_contents(), or if you’re expecting a large request body, read it in chunks with fread().

*file_get_contents - reads entire file into a string
*fread - binary-safe file read - reads up to length bytes from the file pointer referenced by handle

*/

$body = file_get_contents('php://input');	// Read from the php://input stream
?>
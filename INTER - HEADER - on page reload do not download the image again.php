<?php 
/*

!!HEADER - ON PAGE RELOAD DO NOT DOWNLOAD THE IMAGE AGAIN!!

> When using PHP to output an image, it won't be cached by the client so if you don't 
want them to download the image each time they reload the page, you will need to emulate 
part of the HTTP protocol

*header - send a raw HTTP header
*strtotime - parse about any English textual datetime description into a Unix timestamp
*filemtime - gets file modification time
*gmdate - format a GMT/UTC date/time
*filesize - gets file size
*file_get_contents - reads entire file into a string

*/

// Test image.
$fn = '/test/foo.png';

// Getting headers sent by the client.
$headers = apache_request_headers(); 

// Checking if the client is validating his cache and if it is current.
if (isset($headers['If-Modified-Since']) && (strtotime($headers['If-Modified-Since']) == filemtime($fn))) {
	// Client's cache IS current, so we just respond '304 Not Modified'.
	header('Last-Modified: '. gmdate('D, d M Y H:i:s', filemtime($fn)). ' GMT', true, 304);
} else {
	// Image not cached or cache outdated, we respond '200 OK' and output the image.
	header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($fn)).' GMT', true, 200);
	header('Content-Length: '.filesize($fn));
	header('Content-Type: image/png');
	print file_get_contents($fn);
}

?>
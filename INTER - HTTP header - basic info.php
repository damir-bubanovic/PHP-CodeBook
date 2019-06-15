<?php 
/*

!!HTTP HEADER!!


*$_SERVER - server and execution environment information - array containing information such as headers, paths, and script locations
*getallheaders - fetches all HTTP headers from the current request
*http_response_code - Get or Set the HTTP response code

> ALERT < 
	https://en.wikipedia.org/wiki/List_of_HTTP_status_codes

*/




/*READ AN HTTP REQUEST HEADER*/
/*For a single header, look in the $_SERVER superglobal array*/
print $_SERVER['HTTP_USER_AGENT'];

/*For all headers, call getallheaders()*/
$headers = getallheaders();
print $headers['User-Agent'];




/*WRITE AN HTTP REQUEST HEADER*/
/*Call the header() function*/
header('Content-Type: image/png');
// Tell 'em its a PNG

/*header() function lets you explicitly set these values when there’s no way for the server to compute them or you want to modify the default behavior*/
/*change the content type within the script itself*/
header('Content-Type: application/json');

/*If you set the same header multiple times, only the final value is sent. Change this by passing true as the second value to the function*/
header('WWW-Authenticate: Basic realm="http://server.example.com/"');
header('WWW-Authenticate: OAuth realm="http://server.example.com/"', true);




/*SENDING A SPECIFIC HTTP STATUS CODE*/
/*npr. you want to indicate that the user is unauthorized to view the page or the page is not found*/
http_response_code(401);
exit(); // Always use exit at end of that http header script to prevent content from being accidentally added later on

?>
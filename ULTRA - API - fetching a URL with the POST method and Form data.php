<?php 
/*

!!API - FETCHING A URL WITH THE POST METHOD AND FORM DATA!!

> want to submit a document using the POST method, passing data formatted as an HTML form

> Sending a POST method request requires different handling of any form arguments. 
	>> In a GET request, these arguments are in the query string, but in a POST request, they go
	in the request body. 
	>> Additionally, the request needs a Content-Length header that tells the server the size of 
	the content to expect in the request body

*stream_context_create - creates and returns a stream context with any options supplied in options preset
*file_get_contents - reads entire file into a string
*curl_init - initialize a cURL session
*curl_setopt - set an option for a cURL transfer
*curl_exec - perform a cURL session
*curl_close - close a cURL session

*/


/*Set the method and content stream context options when using the http stream*/
$url = 'http://www.example.com/submit.php';
// The submitted form data, encoded as query-string-style, name-value pairs
$body = 'monkey=uncle&amp;rhino=aunt';

$options = array(
	'method'	=>	'POST',
	'content'   =>	$body,
	'header'    =>	'Content-type: application/x-www-form-urlencoded'
);

// Create the stream context
$context = stream_context_create(array('http' => $options));

// Pass the context to file_get_contents()
print file_get_contents($url, false, $context);



/*With cURL, set the CURLOPT_POST and CURLOPT_POSTFIELDS options*/
$url = 'http://www.example.com/submit.php';
// The submitted form data, encoded as query-string-style, name-value pairs
$body = 'monkey=uncle&rhino=aunt';

$c = curl_init($url);
curl_setopt($c, CURLOPT_POST, true);
curl_setopt($c, CURLOPT_POSTFIELDS, $body);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);



/*Using HTTP_Request2, pass HTTP_Request2::METHOD_POST to setMethod() and chain
calls to addPostParameter() for each name/value pair in the data to submit*/
require 'HTTP/Request2.php';

$url = 'http://www.example.com/submit.php';

$r = new HTTP_Request2($url);
$r->setMethod(HTTP_Request2::METHOD_POST)->addPostParameter('monkey', 'uncle')->addPostParameter('rhino','aunt');

$page = $r->send()->getBody();

?>
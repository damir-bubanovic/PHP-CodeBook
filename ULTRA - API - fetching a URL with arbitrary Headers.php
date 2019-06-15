<?php 
/*

!!API - FETCHING A URL WITH ARBITRARY HEADERS!!

> want to retrieve a URL that requires specific headers to be sent with the request for the page

*stream_context_create - creates and returns a stream context with any options supplied in options preset
*file_get_contents - reads entire file into a string
*curl_init - initialize a cURL session
*curl_setopt - set an option for a cURL transfer
*curl_exec - perform a cURL session
*curl_close - close a cURL session

*/


/*Set the header stream context option when using the http stream. The header value must 
be a single string. Separate multiple headers with a carriage return and newline
(\r\n inside a double-quoted string).*/
$url = 'http://www.example.com/special-header.php';
$header = "X-Factor: 12\r\nMy-Header: Bob";
$options = array('header' => $header);

// Create the stream context
$context = stream_context_create(array('http' => $options));

// Pass the context to file_get_contents()
print file_get_contents($url, false, $context);



/*With cURL, set the CURLOPT_HTTPHEADER option to an array of headers to send*/
$c = curl_init('http://www.example.com/special-header.php');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_HTTPHEADER, array('X-Factor: 12', 'My-Header: Bob'));

$page = curl_exec($c);
curl_close($c);



/*With HTTP_Request2, use the setHeader() method*/
require 'HTTP/Request2.php';

$r = new HTTP_Request2('http://www.example.com/special-header.php');
$r->setHeader(array('X-Factor' => 12, 'My-Header', 'Bob'));

$page = $r->send()->getBody();
print $page;



/*cURL has special options for setting the Referer and User-Agent 
request headers CURLOPT_REFERER and CURLOPT_USERAGENT*/
$c = curl_init('http://www.example.com/submit.php');

curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_REFERER, 'http://www.example.com/form.php');
curl_setopt($c, CURLOPT_USERAGENT, 'cURL via PHP');

$page = curl_exec($c);
curl_close($c);

?>
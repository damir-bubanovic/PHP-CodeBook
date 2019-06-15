<?php 
/*

!!API - FETCHING A URL WITH A TIMEOUT!!

> want to fetch a remote URL, but don’t want to wait around too long if the remote server is busy or slow

> Limiting the amount of time that PHP waits to connect to a remote server is a good idea if using data 
from remote sources is part of your page construction process

> ALERT <
	Although setting connection and read timeouts can improve performance, it can alsolead to garbled responses. 
		>> Your script could read just a partial response before a timeout expires. 
		>> If you’ve set timeouts, be sure to validate the entire response that you’ve received.
	Alternatively, in situations where fast page generation is crucial, retrieve external data in a separate process 
	and write it to a local cache. This way, your pages can use the cache without fear of timeouts or partial responses.

*ini_set - sets the value of the given configuration option
*file_get_contents - reads entire file into a string
*curl_init - initialize a cURL session
*curl_setopt - set an option for a cURL transfer
*curl_exec - perform a cURL session
*curl_close - close a cURL session
*fopen - opens file or URL
*stream_set_timeout - set timeout period on a stream
*file_get_contents - reads entire file into a string

*/


/*With the http stream, set the default_socket_timeout configuration option*/
/*This waits up to 15 seconds to establish the connection with the remote server*/
ini_set('default_socket_timeout', 15);
$page = file_get_contents('http://slow.example.com/');


/*With cURL, set the CURLOPT_CONNECTTIMEOUT option*/
$c = curl_init('http://slow.example.com/');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 15);
$page = curl_exec($c);
curl_close($c);


/*With HTTP_Request2, set the timeout element in a parameter array passed to the HTTP_Request2 constructor*/
require_once 'HTTP/Request2.php';

$r = new HTTP_Request2('http://slow.example.com/');
$r->setConfig(array('connect_timeout' => 15));

$page = $r->send()->getBody();




/*If you’re truly concerned about speedy responses, additionally set a limit on how long PHP waits to receive data 
from the already connected socket*/

/*For a stream connection, use the stream_set_timeout() function*/
/*This example limits the read timeout to 20 seconds*/
$url = 'http://slow.example.com';
$stream = fopen($url, 'r');
stream_set_timeout($stream, 20);
$response_body = stream_get_contents($stream);


/*With cURL, set the CURLOPT_TIMEOUT to the maximum amount of time curl_exec() should operate*/
curl_setopt($c, CURLOPT_TIMEOUT, 35);


/*With HTTP_Request2, add a timeout value to the configuration array*/
require_once 'HTTP/Request2.php';

$r = new HTTP_Request2('http://slow.example.com/');
$r->setConfig(array('timeout' => 20));

$page = $r->send()->getBody();

?>
<?php 
/*

!!API - DEBUGGING THE RAW HTTP EXCHANGE!!

> want to analyze the HTTP request a browser makes to your server and the corresponding HTTP response
	>> npr. your server doesn’t supply the expected response to a particular request so you want to see 
	exactly what the components of the request are

> for simple requests, connect to the web server with Telnet and type in the request headers

> GREAT TIP <
	Netcat Program  - great for this task
	http://netcat.sourceforge.net/
	
*fopen - opens file or URL
*stream_get_meta_data - retrieves header/meta data from streams/file pointers
*stream_get_contents - reads remainder of a stream into a string
*curl_init - initialize a cURL session
*curl_setopt - set an option for a cURL transfer
*curl_exec - perform a cURL session
*curl_close - close a cURL session
*fclose - closes an open file pointer
*is_null - finds whether a variable is NULL
*preg_match - perform a regular expression match
*rtrim - strip whitespace (or other characters) from the end of a string
*strlen - returns the length of the given string
*count - count all elements in an array, or something in an object

*/


/*A sample exchange looks like*/
?>

POST /submit.php HTTP/1.1
User-Agent: PEAR HTTP_Request2 class ( http://pear.php.net/ )
Content-Type: application/x-www-form-urlencoded
Connection: close
Host: www.example.com
Content-Length: 12

monkey=uncle

<?php
/*Pasting text into Telnet can get tedious, and it’s even harder to make requests with the POST method that way*/

/*If you make a request with HTTP_Request2, you can retrieve the response headers and the response body with the 
getResponseHeader() and getResponseBody() methods*/
require 'HTTP/Request2.php';

$r = new HTTP_Request2.php('http://www.example.com/submit.php');
$r = new HTTP_Request2('http://localhost/submit.php');
$r->setMethod(HTTP_Request2::METHOD_POST)->addPostParameter('monkey', 'uncle');

$response = $r->send();
$response_headers = $response->getHeader();
$response_body = $response->getBody();



/*To retrieve a specific response header, pass the header name to getResponseHeader()*/

/*The header name must be all lowercase. Without an argument, getResponseHeader() returns an array containing 
all the response headers. HTTP_Request2 saves the outgoing request. Access it by calling the getLastEvent() method*/
require 'HTTP/Request2.php';

$r = new HTTP_Request2('http://www.example.com/submit.php');
$r = new HTTP_Request2('http://localhost/submit.php');
$r->setMethod(HTTP_Request2::METHOD_POST)->addPostParameter('monkey', 'uncle');

$response = $r->send();
print_r($r->getLastEvent());

/*That request is something like*/
?>

POST /submit.php HTTP/1.1
User-Agent: PEAR HTTP_Request2 class ( http://pear.php.net/ )
Content-Type: application/x-www-form-urlencoded
Connection: close
Host: www.example.com
Content-Length: 12

monkey=uncle

<?php

/*Accessing response headers with the http stream*/
$url = 'http://www.example.com/submit.php';
$stream = fopen($url, 'r');
$metadata = stream_get_meta_data($stream);

// The headers are stored in the 'wrapper_data'
foreach($metadata['wrapper_data'] as $header) {
	print $header . "\n";
}

// The body can be retrieved with
// stream_get_contents()
$response_body = stream_get_contents($stream);

/*It prints something like*/
?>

HTTP/1.1 200 OK
Date: Sun, 07 May 2014 18:24:37 GMT
Server: Apache/2.2.2 (Unix)
Last-Modified: Sun, 07 May 2014 01:58:12 GMT
ETag: "1348011-7-16167502"
Accept-Ranges: bytes
Content-Length: 7
Connection: close
Content-Type: text/plain

<?php

/*With cURL, include response headers in the output from curl_exec() by setting the CURLOPT_HEADER option*/
$c = curl_init('http://www.example.com/submit.php');
curl_setopt($c, CURLOPT_HEADER, true);
curl_setopt($c, CURLOPT_POST, true);
curl_setopt($c, CURLOPT_POSTFIELDS, 'monkey=uncle&amp;rhino=aunt');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$response_headers_and_page = curl_exec($c);
curl_close($c);


/*To write the response headers directly to a file, open a filehandle with fopen() 
and set CURLOPT_WRITEHEADER to that filehandle*/
$fh = fopen('/tmp/curl-response-headers.txt','w') or die($php_errormsg);
$c = curl_init('http://www.example.com/submit.php');
curl_setopt($c, CURLOPT_POST, true);
curl_setopt($c, CURLOPT_POSTFIELDS, 'monkey=uncle&amp;rhino=aunt');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_WRITEHEADER, $fh);
$page = curl_exec($c);
curl_close($c);
fclose($fh) or die($php_errormsg);


/*cURL’s CURLOPT_VERBOSE option causes curl_exec() and curl_close() to print out
debugging information to standard error, including the contents of the request*/
$c = curl_init('http://www.example.com/submit.php');
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_POST, true);
curl_setopt($c, CURLOPT_POSTFIELDS, 'monkey=uncle&amp;rhino=aunt');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);

/*It prints something like*/
?>

* Connected to www.example.com (10.1.1.1)
> POST /submit.php HTTP/1.1
Host: www.example.com
Pragma: no-cache
Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, */*
Content-Length: 23
Content-Type: application/x-www-form-urlencoded
monkey=uncle&rhino=aunt* Connection #0 left intact
* Closing connection #0

<?php
/*Because cURL prints the debugging information to standard error and not standard output, it can’t be captured 
with output buffering. 
	> You can, however, open a filehandle for writing and set CURLOUT_STDERR to that filehandle to divert the 
	debugging information to a file*/

$fh = fopen('/tmp/curl.out','w') or die($php_errormsg);
$c = curl_init('http://www.example.com/submit.php');
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_POST, true);
curl_setopt($c, CURLOPT_POSTFIELDS, 'monkey=uncle&amp;rhino=aunt');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_STDERR, $fh);
$page = curl_exec($c);
curl_close($c);
fclose($fh) or die($php_errormsg);



/*Another way to access response headers with cURL is to write a header function*/
class HeaderSaver {
	
	public $headers = array();
	public $code = null;
	
	
	public function header($curl, $data) {
		
		if(is_null($this->code) && preg_match('@^HTTP/\d\.\d (\d+) @',$data,$matches)) {
			$this->code = $matches[1];
		} else {
			// Remove the trailing newline
			$trimmed = rtrim($data);
			
			if(strlen($trimmed)) {
				
				// If this line begins with a space or tab, it's a continuation of the previous header
				if(($trimmed[0]) == '' || ($trimmed[0]) == "\t") {
					// Collapse the leading whitespace into one space
					$trimmed = preg_replace('@^[ \t]+@', ' ', $trimmed);
					$this->headers[count($this->headers) - 1] .= $trimmed;
				} else {
					// Otherwise, it's a new header
					$this->headers[] = $trimmed;
				}
			}
		}
		return strlen($data);
	}
}


$h = new HeaderSaver();
$c = curl_init('http://www.example.com/plankton.php');

// Register the header function
curl_setopt($c, CURLOPT_HEADERFUNCTION, array($h,'header'));
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);

// Now $h is populated with data
print 'The response code was: ' . $h->code . "\n";
print "The response headers were: \n";
foreach ($h->headers as $header) {
	print " $header\n";
}

?>
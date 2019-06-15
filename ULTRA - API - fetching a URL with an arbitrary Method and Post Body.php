<?php 
/*

!!API - FETCHING A URL WITH AN ARBITRARY METHOD AND POST BODY!!

> want to request a URL using any method, such as POST, PUT, or DELETE. Your
POST or PUT request may contain formatted data, such as JSON or XML.

*stream_context_create - creates and returns a stream context with any options supplied in options preset
*file_get_contents - reads entire file into a string
*curl_init - initialize a cURL session
*curl_setopt - set an option for a cURL transfer
*curl_exec - perform a cURL session
*curl_close - close a cURL session
*fopen - opens file or URL
*filesize - gets the size for the given file

*/


/*Set the method, header, and content stream context options when using the http stream*/
$url = 'http://www.example.com/meals/123';
$header = "Content-Type: application/json";

// The request body, in JSON
$body = '[{
	"type": "appetizer",
	"dish": "Chicken Soup"
	}, {
	"type": "main course",
	"dish": "Fried Monkey Brains"
}]';

$options = array(
	'method'	=>	'put',
	'header'	=>	$header,
	'content'   =>	$body
);

// Create the stream context
$context = stream_context_create(array('http' => $options));
// Pass the context to file_get_contents()
print file_get_contents($ulr, false, $context);



/*With cURL, set the CURLOPT_CUSTOMREQUEST option to the method name. To include a request 
body, set CURLOPT_HTTPHEADER to the Content-Type and CURLOPT_POST FIELDS to the body*/
$url = 'http://www.example.com/meals/123';

// The request body, in JSON
$body = '[{
	"type": "appetizer",
	"dish": "Chicken Soup"
	}, {
	"type": "main course",
	"dish": "Fried Monkey Brains"
}]';

$c = curl_init($url);

curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($c, CURLOPT_POSTFIELDS, $body);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);



/*In HTTP_Request2, call setMethod() with a method constant, setHeader() with 
the Content-Type, and setBody() with the contents of the request body*/
require 'HTTP/Request2.php';

$url = 'http://www.example.com/meals/123';

// The request body, in JSON
$body = '[{
	"type": "appetizer",
	"dish": "Chicken Soup"
	}, {
	"type": "main course",
	"dish": "Fried Monkey Brains"
}]';

$r = new HTTP_Request2($url);
$r->setMethod(HTTP_Request2::METHOD_PUT);
$r->setHeader('Content-Type', 'application/json');
$r->setBody($body);

$page = $r->send()->getBody();



/*In many REST-style APIs, you need to use more than just GET and POST to modify
resources, you also need to use PUT and DELETE*/

/*The PUT method is often used for creating or modifying the contents of a specific
resource. cURL has three special options to help with this: CURLOPT_PUT, CURLOPT_IN
FILE, and CURLOPT_INFILESIZE. To upload a file with PUT and cURL, set CUR
LOPT_PUT to true, CURLOPT_INFILE to a filehandle opened to the file that should be
uploaded, and CURLOPT_INFILESIZE to the size of that file.*/

/*Uploading a file with cURL and PUT*/
$url = 'http://www.example.com/upload.php';

$filename = '/usr/local/data/pictures/piggy.jpg';
$fp = fopen($filename,'r');

$c = curl_init($url);
curl_setopt($c, CURLOPT_PUT, true);
curl_setopt($c, CURLOPT_INFILE, $fp);
curl_setopt($c, CURLOPT_INFILESIZE, filesize($filename));
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
print $page;
curl_close($c);

?>
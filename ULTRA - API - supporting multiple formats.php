<?php
/*

!!API - SUPPORTING MULTIPLE FORMATS!!

> want to support multiple formats, such as JSON and XML

*explode - returns an array of strings, each of which is a substring of string formed by splitting it on boundaries formed by the string delimiter
*$_SERVER - array containing information such as headers, paths, and script locations - server and execution environment information
*array_shift - shift an element off the beginning of array
*array_pop - pop the element off the end of array
*strrpos - find the numeric position of the last occurrence of needle in the haystack string
*substr - returns the portion of string specified by the start and length parameters
*join - join array elements with a string (!USE implode instead!)
*json_encode - returns a string containing the JSON representation of value
*$_GET - associative array of variables passed to the current script via the URL parameters

*/


/*Use file extensions*/

http://api.example.com/people/rasmus.json
http://api.example.com/people/rasmus.xml

// Break apart URL
$request = explode('/', $_SERVER['PATH_INFO']);


// Extract the root resource and type
$resource = array_shift($request);
$file = array_pop($request);
$dot = strrpos($file, ".");

if($doc == false) {	// note: three equal signs
	$request[] = $file;
	$type = 'json';	// default value
} else {
	$request[] = substr($file, 0, $dot);
	$type = substr($file, $dot + 1);
}


/*OR*/


/*support the Accept HTTP header, to allow requests to http://api.example.com/people/rasmus*/
GET /people/rasmus HTTP/1.1
Host: api.example.com
Accept: application/json,text/html

require_once 'HTTP".php';

$http = new HTTP2;

$supportedTypes = array(
	'application/json',
	'text/xml'
);

$type = $http->negotiateMimeType($supportedTypes, false);

if($type == false) {
	http_response_code(406);	// Not Acceptable
	$error_body = 'Choose one of: ' . join(',', $supportedTypes);
	print json_encode($error_body);
} else {
	// format response based on $type
}


/*OR*/


/*If all else fails, read a query parameter*/
http://api.example.com/people/rasmus?format=json
http://api.example.com/people/rasmus?format=xml

$type = $_GET['format'];



/*When your RESTful API supports multiple formats, such as JSON and XML, there 
are a few ways to allow developers to signal which format they want to use*/

/*
1) 
One option is to use file extensions, such as 
	http://api.example.com/people/rasmus.json & 
	http://api.example.com/people/rasmus.xml. 
Because these aren’t real files, this requires some parsing of $_SERVER['PATH_INFO']
*/

// Break apart URL
$request = explode('/', $_SERVER['PATH_INFO']);

// Extract the root resource and type
$resource = array_shift($request);
$file = array_pop($request);
$dot = strrpos($file, '.');

if($dot === false) { // note: three equal signs
	$request[] = $file;
	$type = 'json'; // default value
} else {
	$request[] = substr($file, 0, $dot);
	$type = substr($file, $dot + 1);
}
// $type is json, xml, etc.

/*
You pull off the file segment of the URL and search for the trailing ".“. If it’s not there, fall 
back to a default value. If it is, then extract the resource name and type using substr()

The downside to using file extensions is that clients can only request one specific representation
type. If they ask for a JSON version and you don’t support that, then there’s no way for them to 
signal an acceptable alternative format in the same request

Multiple representations for a resource can live at a single location, such as http://api.example.com/people/rasmus. 
In this case, clients can specify a list of formats in their preferred order. Then you can negotiate with the client 
to return the resource in the best mutually agreeable format

In this case, the client passes a request like so, using the Accept HTTP header to signal its preferences
*/
?>

GET /people/rasmus HTTP/1.1
Host: api.example.com
Accept: application/json,text/html

<?php 
/*Unfortunately, proper parsing of the Accept header isn’t easy. So, use a library, such as PEAR’s HTTP2*/
require_once 'HTTP2.php';

$http = new HTTP2;
$supportedTypes = array(
	'application/json',
	'text/xml'
);

$type = $http->negotiateMimeType($supportedTypes, false);

if($type === false) {
	http_response_code(406); // Not Acceptable
	$error_body = 'Choose one of: ' . join(',', $supportedTypes);
	print json_encode($error_body);
} else {
	// format response based on $type
}

/*This lets you specify that you support JSON and XML and uses the $http->negotiateMimeType() function to 
return the client’s most preferred format from the list you support*/

/*As a last result, you can accept the format as a query parameter*/
$type = $_GET['format'];

?>
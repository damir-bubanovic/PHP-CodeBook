<?php
/*

!!API - CREATING A RESOURCE!!

> want to let people add a new resource to the system

> Accept requests using POST. Read the POST body. 
	>> Return success and the location of the new resource

*$_SERVER - array containing information such as headers, paths, and script locations
*file_get_contents - reads entire file into a string
*strtolower - make a string lowercase
*json_decode - takes a JSON encoded string and converts it into a PHP variable
*json_encode - returns a string containing the JSON representation of value
*header - send a raw HTTP header
*explode - returns an array of strings, each of which is a substring of string formed by splitting it on boundaries formed by the string delimiter
*substr - returns the portion of string specified by the start and length parameters
*array_shift - shift an element off the beginning of array
*simplexml_load_string - interprets a string of XML into an object

*/

/*OUTPUT*/
?>
POST /v1/jobs HTTP/1.1
Host: api.example.com
Content-Type: application/json
Content-Length: 49
{
"position": {
"title": "PHP Developer"
}
}
<?php

/*Use this PHP code*/
if($_SERVER["REQUEST_METHOD"] == 'POST') {
	$body = file_get_contents('php://input');
	
	switch(strtolower($_SERVER['HTTP_CONTENT_TYPE'])) {
		case "application/json":
			$job = json_decode($body);
			break;
		case "text/xml":
			// parsing here
			break;
	}
	
	// Validate input
	// Create new Resource
	$id = create($job);	// Returns id of 456
	$json = json_encode(array('id' => $id));
	
	http_response_code(201);	// Created	
	$site = 'https://api.example.com';	
	header("Location: $site/" . $_SERVER['REQUEST_URI'] . "/$id");
	header('Content-Type: application/json');
	print $json;
}



/*OUTPUT*/
/*If the client is allowed to specify (and knows) the ID, use PUT instead - code below*/
?>

HTTP/1.1 201 Created
Location: https://api.example.com/jobs/456
Content-Type: application/json
Content-Length: 15
{
"id": 456
}



PUT /v1/jobs/456 HTTP/1.1
Host: api.example.com
Content-Type: application/json
Content-Length: 49
{
"position": {
"title": "PHP Developer"
}
}

<?php 
/*Use this PHP code*/
if ($_SERVER["REQUEST_METHOD"] == 'PUT') {
	$body = file_get_contents('php://input');
	
	switch(strtolower($_SERVER['HTTP_CONTENT_TYPE'])) {
		case "application/json":
			$job = json_decode($body);
			break;
		case "text/xml":
			// parsing here
		break;
	}
	
	// Validate input
	// Create new Resource
	$request = explode('/', substr($_SERVER['PATH_INFO'], 1));
	$resource = array_shift($request);
	$id = create($job, $request[0]); // Uses id from request
	$json = json_encode(array('id' => $id));
	
	http_response_code(201); // Created
	$site = 'https://api.example.com';
	header("Location: $site/" . $_SERVER['REQUEST_URI'] );
	print $json;
}



/*The standard way to add new records is by HTTP POSTing to a parent (or collection) resource. 
	> npr. to add a new job to the system, POST the data to /v1/jobs 
	(in contrast to a specific resource such as /v1/jobs/123)*/

/*It’s the job of the server to parse the data, validate it, and assign an ID for the newly recreated record*/
if($_SEERVER["REQUEST_METHOD"] == 'POST') {
	$body = file_get_contents('php://input');
	
	switch(strtolower($_SERVER['HTTP_CONTENT_TYPE'])) {
		case "application/json":
			$job = json_decode($body);
			break;
		case "text/xml":
			$job = simplexml_load_string($body);
			break;
	}
	
	// Validate input
	// Create new Resource
	$id = create($job);	// Return id
}

/*PHP automatically parses standard HTML form data into $_POST. However, for most REST APIs, 
the POST body is in JSON (or XML or another format)*/

/*
This requires you to read and parse the data yourself. The raw POST body is available
using the special stream php://input; slurp it into a variable using file_get_contents().

Next, check the Content-Type HTTP header to learn what data format was sent. You
do this via the $_SERVER['HTTP_CONTENT_TYPE'] superglobal variable. You may only
support one format, such as JSON, but you should still confirm that the client is using
that format.

Based on the Content-Type, use the appropriate function, such as json_decode() or
simplexml_load_string(), to deserialize the data to PHP.

Now you can perform the necessary business logic to validate the input, add the resource,
and generate a unique ID for that record
*/


/*If everything goes OK, signal success and return the location of the new resource*/
http_response_code(201); // Created
$site = 'https://api.example.com';
header("Location: $site/" . $_SERVER['REQUEST_URI'] . "/$id");
print $json;


/*
A status code of 201 signifies a resource has been created, which is preferable over the
more generic 200 (OK). Additionally, it’s a best practice to return the location, either
via the Location HTTP header or in the body. The first is more RESTful, but some
clients find it easier to parse the results in a body than from a header. The Location
HTTP must be an absolute URL.

If there’s a problem with how the request was sent, return a status code in the 4xx range.
Whenever possible, you should return a message explaining how the client can fix her
request.
	> npr. if a required field is missing or the document is otherwise well-formed but has 
	an incorrect schema, return 422 (Unprocessable Entity)
*/

http_response_code(422); // Unprocessable Entity
$error_body = [
	"error" => "12",
	"message" => "Missing required field: job title"
];

print json_encode($error_body);

/*
If you cannot find a specific error code for the problem, then a response code of 400
(Bad Request) is always OK

If your system cannot definitively say whether a request is or isn’t OK, return 202 (Accepted).
This is the appropriate way to passive-agressively signal your noncommittal
behavior.

*/


/*
When the client knows the ID associated with the new record (instead of having you
assign one), have them PUT directly to the location (instead of to the parent resource)
*/

?>

PUT /v1/jobs/123 HTTP/1.1
Host: api.example.com
Content-Type: application/json
Content-Length: 49
{
"position": {
"title": "PHP Developer"
}
}

<?php 
if ($_SERVER["REQUEST_METHOD"] == 'PUT') {
	$body = file_get_contents('php://input');
	
	switch(strtolower($_SERVER['HTTP_CONTENT_TYPE'])) {
		case "application/json":
			$job = json_decode($body);
			break;
	case "text/xml":
			// parsing here
			break;
	}
	
	// Validate input
	// Create new Resource
	$request = explode('/', substr($_SERVER['PATH_INFO'], 1));
	$resource = array_shift($request);
	$id = create($job, $request[0]); // Uses id from request
	$json = json_encode(array('id' => $id));
	
	http_response_code(201); // Created
	$site = 'https://api.example.com';
	header("Location: $site/" . $_SERVER['REQUEST_URI'] . "/$id");
	print $json;
}

?>
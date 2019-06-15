<?php
/*

!!API - INDICATING ERRORS & FAILURES!!

> want to indicate that a failure occurred

*$_SERVER - array containing information such as headers, paths, and script locations - Server and execution environment information
*json_encode - returns a string containing the JSON representation of value

*/


/*Return a 4xx status code for client failures. Provide a message with more information*/
http_response_code(401);	// Unauthorized

$error_body = [
	"error" => "Unauthorized",
	"code" => 1,
	"message" => "Only authenticated users can read " . $_SERVER['REQUEST_URI'],
	"url" => "http://developer.example.com/error/1"
];

print json_encode($error_body);


/*Return a 5xx status code for server failures. Provide a message with more information*/
http_response_code(503); // Site down

$error_body = [
	"error" => "Down for maintenance",
	"code" => 2,
	"message" => "Check back in two hours.",
	"url" => "http://developer.example.com/error/2"
];

print json_encode($error_body);


/*
Helpful and informative error messages are a blessing to consumers of your APIs.
	> A good error message is specific, and explains what’s wrong and how (if possible) to fix the problem.

	> For RESTful servers, this divides into two pieces: 
		1) the HTTP status code 
		2) the error message returned in the response body. 

HTTP status codes are divided into two large buckets.
1) The 4xx family of codes indicate client-side failures, such as invalid authentication credentials
(401), being forbidden to access the resource (403), or the resource is no longer available (410).
	> these are problems that can be fixed by the client, 
		+) by providing the right information (such as valid authentication credentials)
		+) modifying the request (only asking for resources it’s allowed to request)
		+) or stopping the request entirely (if it’s gone, it’s gone).
2) The 5xx family of codes are server-side errors. (It’s not you, it’s me.) 
	> npr. the service is down (503) or an unexpected error due to a bug in the code (500).
	> These are problems entirely outside of the client’s control and can only be fixed by the API provider. 
	> They cannot be fixed by modifying the request. 
		>> Instead, they need to wait until 
			+) server has fixed the bug
			+) finished maintenance
			+) regained the ability to handle traffic
*/

/*
HTTP status codes used in errors

Status code 	Meaning 				Description
400 			Bad Request 			Bad syntax or other generic error
401 			Unauthorized 			Must provide valid authentication
403 			Forbidden 				Not allowed to access the resource for reasons other than invalid authentication
404 			Not Found 				Resource doesn’t exist (but may in the future)
405 			Method Not Allowed 		Cannot call that method on this resource
410 			Gone 					The resource no longer exists and never will again
429 			Too Many Requests 		Past your quota or rate limit
500 			Internal Server Error 	Generic server error
503 			Service Unavailable 	Server is overloaded or down for maintenance

However, a code by itself is rarely sufficient to fully explain the error. 
	> You should provide an error message in the response, ideally in the same format as the request itself
	(such as JSON or XML)

*/


/*Error message example*/

$http_error_code = 401;
$error_body = [
    "error" => "Unauthorized",
    "code" => 1,
    "message" => "Only authenticated users can read " . $_SERVER['REQUEST_URI'],
    "url" => "http://developer.example.com/error/1"
];

http_response_code($http_error_code); // Unauthorized
print json_encode($error_body);

?>
<?php
/*

!!API - EDITING A RESOURCE!!

> want to let people update a resource

> Accept requests using PUT. Read the POST body. Return success

*$_SERVER - array containing information such as headers, paths, and script locations
*file_get_contents - reads entire file into a string
*strtolower - make a string lowercase
*json_decode - takes a JSON encoded string and converts it into a PHP variable
*explode - returns an array of strings, each of which is a substring of string formed by splitting it on boundaries formed by the string delimiter
*substr - returns the portion of string specified by the start and length parameters
*array_shift - shift an element off the beginning of array

*/


/*PUT request*/
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
if($_SERVER["REQUEST_METHOD"] == 'PUT') {
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
	// Modify the Resource
	$request = explode('/', substr($_SERVER['PATH_INFO'], 1));
	$resource = array_shift($request);
	$id = update($job, $request[0]);	// Uses id from request
	http_response_code(204);	// No Content
}


/*To generate this output*/
?>

HTTP/1.1 204 No Content

<?php 
/*
To update a resource, accept PUT requests. The resource provided in the POST body replaces the current resource

PUT requests are not safe, but they are idempotent because the resource being PUT entirely replaces the current 
entity. Unfortunately, this means that even updating a onecharacter typo requires you to transmit the entire resource

Some sites allow partial updates using PUT. 
	> npr. this request keeps the resource as is, except for updating the postal code
*/
?>

PUT /v1/jobs/123 HTTP/1.1
Host: api.example.com
Content-Type: application/json
Content-Length: 43
{
"location" {
"postalCode": 94043
}
}

<?php 
/*
This makes it hard to disambiguate between when you want to delete a field versus intentionally not providing it. 
The PATCH method is a proposed standard for partial updates, so you can differentiate your behavior based on a 
PUT or a PATCH
*/
?>
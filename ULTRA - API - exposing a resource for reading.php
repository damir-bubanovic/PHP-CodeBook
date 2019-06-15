<?php
/*

!!API - EXPOSING A RESOURCE FOR READING!!

> want to let people read a resource

> Read requests using GET. Return structured results, using formats such as JSON, XML, or HTML. 
Don’t modify any resources

*json_encode - returns the JSON representation of a value

*/


/*Use this PHP code*/
// Assume this was pulled from a database or other data store
$job[123] = [
	'id'		  =>	123,
	'position'	=>	[
							'title' => 'PHP Developer',
						],
];

$json = json_encode($job[123]);

// Resource exists 200: OK
http_response_code(200);

// And it's being sent back as JSON
header('Content-Type: applicaton/json');
print $json;


/*
> The most common type of REST request is reading data

> Reads in REST correspond with HTTP GET requests. This is the same HTTP method used by your web browser
to read an HTML page, so when you write PHP scripts you’re almost always handling GET requests
> This makes serving up a REST resource for reading straightforward
1. Check that the HTTP method is GET
2. Parse the URL to determine the specific resource and, optionally, key
3. Retrieve the necessary information, probably from a database
4. Format the data into the proper structure
5. Send the data back, along with the necessary HTTP headers

> Once you’ve fetched the data, the next step is formatting it for output. It’s common to use JSON or XML 
(or both), but any structured format is perfectly fine. That could be HTML or YAML or even CSV

*/

/*This example takes a record and converts it to JSON:*/
// Assume this was pulled from a database or other data store
$job[123] = [
	'id' => 123,
	'position' => [
					'title' => 'PHP Developer',
				  ],
];

$json = json_encode($job[123]);

/*After you have the response body, the other step is sending the appropriate HTTP headers*/
// Resource exists 200: OK
http_response_code(200);

// And it's being sent back as JSON
header('Content-Type: text/json');


/*Last, send the data itself:*/
print $json;


/*If there is no Job 123 in the system, tell the caller this wasn’t found using status code 404*/
// Resource exists 404: Not Found
http_response_code(404);

?>
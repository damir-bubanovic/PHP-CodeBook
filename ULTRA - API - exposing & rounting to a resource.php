<?php
/*

!!API - EXPOSING & ROUNTING TO A RESOURCE!!

> want to provide access to a resource and handle requests according to the HTTP method

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		callable without an instance of the object created

*$_SERVER - array containing information such as headers, paths, and script locations - server and execution environment information
*explode - returns an array of strings, each of which is a substring of string formed by splitting it on boundaries formed by the string delimiter
*strtolower - make a string lowercase
*array_shift - shift an element off the beginning of array
*array_key_exists - checks if the given key or index exists in the array
*method_exists - checks if the class method exists in the given object
*call_user_func - call the callback given by the first parameter

*/


/*Use the $_SERVER['REQUEST_METHOD'] variable to route the request*/
$request = explode('/', $_SERVER['PATH_INFO']);

$method = strtolower($_SERVER['REQUEST_METHOD']);

switch($method) {
	case 'get':
		// handle a GET request
		break;
	case 'post':
		// handle a POST request
		break;
	case 'put':
		// handle a PUT request
		break;
	case 'delete':
		// handle a DELETE request
		break;
	default:
		// unimplemented method
		http_response_code(405);
}


/*

When processing a request for a RESTful resource needt to know:
	+) the requested resource 
	+) action the client wants to take

However, it’s rare to have a one-to-one mapping between resources and the PHP script that processes them. 
	> npr. a resource for books could use a book’s ISBN as the key. 
		>> So, PHP Cookbook is at /v1/books.php/9781449363758, Learning PHP 5 is at /v1/ books.php/9780596005603, and so on.

	> But it’s not a good idea to have individual files at each of those locations. 
		>> Instead, use a single books.php file, which uses the ISBN as a parameter. 
			>>> In many scripts, you’d pass the ISBN as a query parameter, such as /v1/books.php?isbn=9781449363758, and read
			this in your PHP code at $_GET['isbn'].
			>>> However, with REST, you use slashes to identify each resource. And you cannot use the standard PHP superglobals 
			with a URL such as /v1/books.php/9781449363758. 
				>>>> Instead parse the path into its components by breaking the $_SERVER['PATH_INFO'] apart on

*/
$request = explode('/', $_SERVER['PATH_INFO']);

/*
Next, route the request based on the HTTP method, so you can handle GETs, PUTs, POSTs, and DELETEs in different functions. 
For this, use $_SERVER['REQUEST_METHOD']
*/

$method = strtolower($_SERVER['REQUEST_METHOD']);

switch($method) {
	case 'get':
		// handle a GET request
		get_book($request);
		break;
	case 'post':
		// handle a POST request
		post_book($request);
		break;
	case 'put':
		// handle a PUT request
		put_book($request);
		break;
	case 'delete':
	// handle a DELETE request
		delete_book($request);
		break;
	default:
		// unimplemented method
		http_response_code(405);
}



/*You may find it convenient to map the RESTful resources you expose to PHP classes*/
class books {
	
	static public function get($request) {
		// handle a GET request
	}
	
	static public function post($request) {
		// handle a POST request
	}
	
	/*other methods ... */
}

/*Then you can modify the router to be a single index.php to process all resources, 
instead of separate files for each resource*/

// break apart URL and extract the root resource
$request = explode('/', $_SERVER['PATH_INFO']);
$resource = array_shift($request);

// only process valid resources
$resources = array(
	'books'	=>	true,
	'music'	=>	true
);

if(!array_key_exists($resource, $resources)) {
	http_response_code(404);
	exit;
}


// route the request to the appropriate function based on method
$method = strtolower($_SERVER["REQUEST_METHOD"]);

switch($method) {
	case 'get':
	case 'post':
	case 'put':
	case 'delete':
		// any other methods you want to support, such as HEAD
		if(method_exists($resource, $method)) {
			call_user_func(array($resource, $method), $request);
			break;
		}
		// fall through
	default:
		http_response_code(405);
}

/*
1) you break apart the URL on /. 
2) pop off the first element to extract the resource, such as books or albums.
3) make sure that resource is a legitimate one to call. 
	> npr. asking for /v1/movies/fletch generates a 404 error, because that resource doesn’t exist.
4) check if the class with the same name as the resource has a class method that matches the HTTP method. 
	> If so, you use call_user_func() to invoke the method, If not, you return a response code of 405

> You also only handle the get(), post(), put(), and delete() methods, so people cannot invoke other 
class methods

*/

?>
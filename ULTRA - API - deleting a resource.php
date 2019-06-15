<?php
/*

!!API - DELETING A RESOURCE!!

> want to let people delete a resource

> Accept requests using DELETE. Return success

*/


/*For a DELETE request to http://api.example.com/v1/jobs/123*/
?>

DELETE /v1/jobs/123 HTTP/1.1
Host: api.example.com

<?php 
/*Use this PHP code*/
if($_SERVER["REQUEST_METHOD"] == 'DELETE') {
	
	// Delete the Resource
	$request = explode('/', substr($_SERVER['PATH_INFO'], 1));
	$resource = array_shift($request);
	$success = delete($request[0]); // Uses id from request
	
	http_response_code(204); // No Content
}

/*Generate this output*/
?>

HTTP/1.1 204 No Content

<?php 
/*
To delete a resource, accept the DELETE method. If the request is successful, return 204 (No Content). 
	> You can return 200, but 204 is preferable when you don’t return an HTTP body. 
		>> This allows the client to definitely know nothing was lost.

If the resource doesn’t exist (either because it never existed or someone deleted it first), return 404 (Not Found). 
	> If the resource is never coming back (versus it never existed or is temporarily deleted, but could be re-created),
	return 410 (Gone). 
		>> This is often used when the entire parent resource has been deprecated, such as if you stopped supporting
		the ability to handle jobs.

DELETE requests are not safe, but they are idempotent because deleting the same resource multiple times is the same 
as deleting it once. It’s gone
*/

?>
<?php 
/*

!!RESPONDING TO AN AJAX REQUEST!!

> You’re using JavaScript to make in-page requests with XMLHTTPRequest and need to send data in reply to one of those requests

> Set an appropriate Content-Type header and then emit properly formatted data

> JSON is a particularly useful format for these sorts of responses, because it’s super easy to deal with the JSON-formatted 
data from within JavaScript

*header - send a raw HTTP header
*json_encode - returns a string containing the JSON representation of value
*gmdate - identical to the date() function except that the time returned is Greenwich Mean Time (GMT)

*/


/*Sending an XML response*/
?>

<?php header('Content-Type: text/xml'); ?>
<menu>
<dish type="appetizer">Chicken Soup</dish>
<dish type="main course">Fried Monkey Brains</dish>
</menu>

<?php 
/*Sending a JSON response*/
$menu = array();
$menu[] = array(
	'type'	=>	'appetizer',
	'dish'	=>	'Chicken Soup'
);
$menu[] = array(
	'type'    =>    'main course',
	'dish'    =>    'Fried Monkey Brains'
);

header('Content_Type: application/json');
print json_encode($menu);

/*This encodes a two-element JavaScript array of hashes. The json_encode() function is
an easy way to turn PHP data structures (scalars, arrays, and objects) into JSON strings*/
/*and vice versa. This function and the complementary json_decode() function turn
PHP data structures to JSON strings and back again*/



/*Different browsers have a creative variety of caching strategies when it comes to requests made
from within JavaScript. If your responses are sending dynamic data (which they usually are), you 
probably don’t want them to be cached. 
	> The two tools in your anti-caching toolbox are headers and URL poisoning*/
/*Anti-caching headers*/
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
// Add some IE-specific options
header("Cache-Control: post-check=0, pre-check=0", false);
// For HTTP/1.0
header("Pragma: no-cache");

/*The other anti-caching tool, URL poisoning, requires cooperation from the JavaScript
that is making the request. It adds a name/value pair to the query string of each request
it makes using an arbitrary value. This makes the request URL different each time the
request is made, preventing any misbehaving caches from getting in the way. The Java‐
Script Math.random() function is useful for generating these values*/

?>
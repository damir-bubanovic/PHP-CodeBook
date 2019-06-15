<?php 
/*

!!INTEGRATING WITH JAVASCRIPT!!

> want part of your page to update with server-side data without reloading the whole page. 
npr. you want to populate a list with search results

> Use a JavaScript toolkit such as jQuery to wire up the client side of things so that a
particular user action (such as clicking a button) fires off a request to the server. Write
appropriate PHP code to generate a response containing the right data. Then, use your
JavaScript toolkit to put the results in the page correctly

*$_GET - associative array of variables passed to the current script via the URL parameters
*count - count all elements in an array, or something in an object
*header - send a raw HTTP header
*gmdate - identical to the date() function except that the time returned is Greenwich Mean Time (GMT)
*json_encode - returns a string containing the JSON representation of value

*/


/*This shows a simple HTML document that loads jQuery and the code in*/
/*Basic HTML for JavaScript integration*/
?>

<!-- Load jQuery -->
<script type="text/javascript"
src="//code.jquery.com/jquery-1.9.1.min.js"></script>
<!-- Load our JavaScript -->
<script type="text/javascript" src="search.js"></script>
<!-- Some input elements -->
<input type="text" id="q" />
<input type="button" id="go" value="Search"/>
<hr/>
<!-- Where the output goes -->
<div id="output"></div>

<?php 
/*This is the JavaScript glue that sends a request off to the server
when the Search button is clicked and makes sure the results end up on the page in the
right place when they come back*/
/*JavaScript integration glue*/
?>

// When the page loads, run this code
$(document).ready(function() {
	// Call the search() function when the 'go' button is clicked
	$("#go").click(search);
});

function search() {
    // What's in the text box?
    var q = $("#q").val();
    // Send request to the server
    // The first argument should be to wherever you save the search page
    // The second argument sends a query string parameter
    // The third argument is the function to run with the results
    $.get('/search.php', { 'q': q }, showResults);
}

// Handle the results
function showResults(data) {
    var html = '';
    // If we got some results...
    if (data.length > 0) {
    html = '<ul>';
    // Build a list of them
    for (var i in data) {
        var escaped = $('<div/>').text(data[i]).html();
        html += '<li>' + escaped + '</li>';
    }
    html += '</ul>';
    } else {
    html = 'No results.';
    }
    // Put the result HTML in the page
    $("#output").html(html);
}

<?php 
/*This is the PHP code that does the searching and sends back a JSON-formatted response*/
/*PHP to generate a response for JavaScript*/
$results = array();
$q = isset($_GET['q']) ? $_GET['q'] : '';

// Connect to the database
$db = new PDO('sqlite:/tmp/zodiac.db');

// Do the query
$st = $db->prepare("SELECT symbol FROM zodiac WHERE planet LIKE ?");
$st->execute(array($q . '%'));

// Build an array of results
while($row = $st->fetch()) {
	$results[] = $row['symbol'];
}
if(count($results) == 0) {
	$results[] = 'No results';
}


// Splorp out all the anti-caching stuff
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");

// Add some IE-specific options
header("Cache-Control: post-check=0, pre-check=0", false);

// For HTTP/1.0
header("Pragma: no-cache");

// The response is JSON
header('Content-Type: application/json');

// Output the JSON data
print json_encode($results);

?>
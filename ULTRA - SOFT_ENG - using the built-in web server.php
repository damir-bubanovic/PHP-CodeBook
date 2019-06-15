<?php 
/*

!!SOFT_ENG - USING THE BUILT-IN WEB SERVER!!

> You want to use PHP’s built-in web server to quickly spin up a test or simple website

*explode - split a string by string
*$_SERVER - array containing information such as headers, paths, and script locations
*preg_match - perform a regular expression match
*header - send a raw HTTP header
*urlencode -  URL-encodes string
*file_get_contents - reads entire file into a string
*trim - strip whitespace (or other characters) from the beginning and end of a string
*htmlentities - convert all applicable characters to HTML entities

*/


/*run the command-line PHP program with an -S argument giving a hostname and a port to 
listen on and you’ve got an instant PHP-enabled web server serving up the directory you 
started it in*/
?>

% php -S localhost:9876

<?php 
/*To use a different document root directory, provide that with a -t argument when
starting PHP.*/
?>

% php -S localhost:9876 -t /var/www

<?php
/*For more indirect mapping between request URLs and responses, specify a file containing
PHP to do request routing as an additional argument:*/
?>

% php -S localhost:9876 router.php



<?php
/*Before looking for a path that matches a request URL, PHP executes the code in router.
php. PHP will only attempt to look for a matching path if that code returns false. This 
lets you do arbitrary response generation*/

/*Built-in web server request router*/
$parts = explode('/', $_SERVER['REQUEST_URI']);

// Expecting a request URI such as /USD/ISK, so make
// sure there are at least two parts and they are
// each three letters
if(!(isset($parts[1]) && preg_match('/[a-z]{3}/i', $parts[1]) && isset($parts[2]) && preg_match('/[a-z]{3}/i', $parts[2]))) {
	header('Bad Request', true, 400);
	print "Bad Request";
	exit();
}

$quotes = 'http://download.finance.yahoo.com/d/quotes.csv?f=nl1&s=%s%s=X,%s%s=X';
$url = sprintf($quotes, urlencode($parts[1]), urlencode($parts[2]), urlencode($parts[2]), urlencode($parts[1]));


$response = file_get_contents($url);
$lines = explode("\n", trim($response));

foreach($lines as $line) {
	list($label, $rate) = str_getcsv($line);
	print "<b>" . htmlentities($label) . "</b>: " . htmlentities($rate) . "<br/>";
}

?>
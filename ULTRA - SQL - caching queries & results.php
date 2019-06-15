<?php 
/*

!!SQL - CACHING QUERIES AND RESULTS!!

> don’t want to rerun potentially expensive database queries when the results haven’t changed
> Use PEAR’s Cache_Lite package
	>> It makes it simple to cache arbitrary data. 
	>> In this case, cache the results of a SELECT query and use the text of the query as a cache key
	
> Cache_Lite is a generic, lightweight mechanism for caching arbitrary information
	>> Look more about it

*$_GET - associative array of variables passed to the current script via the URL parameters - HTTP GET variables
*md5 - calculate the md5 hash of a string
*implode - join array elements with a string

*/


/*Caching query results*/
require_once 'Cache/lite.php';

$opts = array(
	// Where to put the cached data
	'cacheDir'				  =>	'/tmp/',
	// Let us store arrays in the cache
	'automaticSerialization'	=>	true,
	// How long stuff lives in the cache - ten minutes
	'lifeTime'				  =>	600
);

// Create the cache
$cache = new Cache_Lite($opts);

// Connect to the database
$db = new PDO('sqlite:/tmp/zodiac.db');

// Define our query and its parameters
$sql = "SELECT * FROM zodiac WHERE planet = ?";
$params = array($GET['planet']);

// Get the unique cache key
$key = cache_key($sql, $params);

// Try to get results from the cache
$results = $cache->get($key);

if($results === false) {
	// No results found, so do the query and put the results in the cache
	$st = $db->prepare($sql);
	$st->execute($params);
	$results = $st->fetchAll();
	$cache->save($results);
}

// Whether from the cache or not, $results has our data
foreach($results as $result) {
	print "$result[id]: $result[planet], $result[sign] <br />\n";
}

function cache_key($sql, $params) {
	return md5($sql . implode('|', array_keys($params)) . implode('|', $params));
}

?>
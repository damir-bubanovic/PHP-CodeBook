<?php 
/*

!!PROGRAM: FINDING FRESH LINKS!!

> program that produces a list of links and their last-modified time. If the server on which a URL 
lives doesn’t provide a last-modified time, the program reports the URL’s last-modified time as the 
time the URL was requested. If the program can’t retrieve the URL successfully, it prints out the
status code it got when it tried to retrieve the URL. 

*error_reporting - sets which PHP errors are reported
*isset - determine if a variable is set and is not NULL
*$_SERVER - array containing information such as headers, paths, and script locations - Server and execution environment information
*list - assign variables as if they were an array
*strlen - returns the length of the given string
*tidy_repair_string - repair a string using an optionally provided configuration file
*parse_url - parse a URL and return its components
*strlen - returns the length of the given string
*preg_replace - perform a regular expression search and replace
*preg_match - perform a regular expression match
*flush - flush system output buffer
*list - assign variables as if they were an array
*trim - strip whitespace (or other characters) from the beginning and end of a string
*curl_init - initialize a cURL session
*curl_setopt - set an option for a cURL transfer
*curl_exec - perform a cURL session
*curl_getinfo - get information regarding a specific transfer

*/


/*Run the program by passing it a URL to scan for links*/
?>

http://oreilly.com: OK; Last Modified: Fri, 24 May 2013 18:09:11 GMT
https://members.oreilly.com: MOVED: https://members.oreilly.com/account/login
http://shop.oreilly.com/basket.do: OK
http://shop.oreilly.com: OK
http://radar.oreilly.com: OK; Last Modified: Fri, 24 May 2013 20:40:56 GMT
http://animals.oreilly.com: OK; Last Modified: Fri, 24 May 2013 20:40:18 GMT

<?php 
/*The program to find fresh links is conceptually almost identical to the program to find
stale links. It uses the same techniques to pull links out of a page and the same code to
retrieve URLs*/
/*fresh-links.php*/
error_reporting(E_ALL);

if(!isset($_SERVER['argv'][1])) {
	die("No URL provided.\n");
}

$url = $_SERVER['argv'][1];

// Load the page
list($page, $pageInfo) = load_with_curl($url);
if(!strlen($page)) {
	die("No page retreived from $url");
}

// Convert to XML for easy parsing
$opts = array(
	'output-xhtml'	  =>	true,
	'numeric-entities'  =>	true
);
$xml = tidy_repair_string($page, $opts);
$doc = new DOMDocument();
$doc->loadXML($xml);

$xpath = new DOMXPath($doc);
$xpath->registerNamespace('xhtml','http://www.w3.org/1999/xhtml');


// Compute the Base URL for relative links
$baseURL = '';
// Check if there is a <base href=""/> in the page
$nodeList = $xpath->query('//xhtml:base/@href');

if($nodeList->length == 1) {
	$baseURL = $nodeList->item(0)->nodeValue;
} else {
	// No <base href=""/>, so build the Base URL from $url
	$URLParts = parse_url($pageInfo['url']);
	
	if(!(isset($URLParts['path']) && strlen($URLParts['path']))) {
		$basePath = '';
	} else {
		preg_replace('#/[^/]*$#','',$URLParts['path']);
	}
	
	if(isset($URLParts['username']) || isset($URLParts['password'])) {
		$auth = isset($URLParts['username']) ? $URLParts['username'] : '';
		$auth .= ':';
		$auth .= isset($URLParts['password']) ? $URLParts['password'] : '';
		$auth .= '@';
	} else {
		$auth = '';
	}
	
	$baseURL = $URLParts['scheme'] . '://' . $auth . $URLParts['host'] . $basePath;
}


// Keep track of the links we visit so we don't visit each more than once
$seenLinks = array();

// Grab all links
$links = $xpath->query('//xhtml:a/@href');

foreach($links as $node) {
	$link = $node->nodeValue;
	
	// Resolve relative links
	if(!preg_match('#^(http|https|mailto):#', $link)) {
		if(((strlen($link) == 0)) || ($link[0] != '/')) {
			$link = '/' . $link;
		}
		$link = $baseURL . $link;
	}
	
	// Skip this link if we've seen it already
	if(isset($seenLinks[$link])) {
		continue;
	}
	
	// Mark this link as seen
	$seenLinks[$link] = true;
	// Print the link we're visiting
	print $link . ': ';
	flush();
	
	list($linkHeaders, $linkInfo) = load_with_curl($link, 'HEAD');
	// Decide what to do based on the response code
	// 2xx response codes mean the page is OK
	if(($linkInfo['http_code'] >= 200) && ($linkInfo['http_code'] < 300)) {
		$status = 'OK';
	} else if(($linkInfo['http_code'] >= 300) && ($linkInfo['http_code'] < 400)) {
		// 3xx response codes mean redirection
		$status = 'MOVED';
		
		if(preg_match('/^Location: (.*)$/m',$linkHeaders,$match)) {
			$status .= ': ' . trim($match[1]);
		}
	} else {
		// Other response codes mean errors
		$status = "ERROR: {$linkInfo['http_code']}";
	}
	
	if (preg_match('/^Last-Modified: (.*)$/mi', $linkHeaders, $match)) {
		$status .= "; Last Modified: " . trim($match[1]);
	}

	// Print what we know about the link
	print "$status\n";
}


function load_with_curl($url, $method = 'GET') {
	$c = curl_init($url);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	
	if ($method == 'GET') {
		curl_setopt($c,CURLOPT_FOLLOWLOCATION, true);
	} else if ($method == 'HEAD') {
		curl_setopt($c, CURLOPT_NOBODY, true);
		curl_setopt($c, CURLOPT_HEADER, true);
	}
	
	$response = curl_exec($c);
	return array($response, curl_getinfo($c));
}

?>
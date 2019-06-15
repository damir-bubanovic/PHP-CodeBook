<?php 
/*

!!API - FETCHING A URL WITH THE GET METHOD!!

> want to retrieve the contents of a URL. For example, you want to include part of one site in another site’s content

*file_get_contents - reads entire file into a string
*curl_init - initialize a cURL session
*curl_setopt - set an option for a cURL transfer
*curl_exec - perform a cURL session
*curl_close - close a cURL session
*simplexml_load_file - interprets an XML file into an object
*htmlentities - convert all applicable characters to HTML entities
*http_build_query - generate URL-encoded query string
*file_get_contents - reads entire file into a string
*stream_context_create - creates and returns a stream context with any options supplied in options preset
*fopen - opens file or URL
*__construct - this function creates an object (function to do something)
*strlen - returns the length of the given string

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

*/


/*> Provide the URL to file_get_contents()*/
$page = file_get_contents('http://www.example.com/robots.txt');

/*OR*/

/*Use the cURL extension*/
$c = curl_init('http://www.example.com/robots.txt');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

$page = curl_exec($c);
curl_close($c);

/*OR*/

/*Use the HTTP_Request2 class from PEAR*/
require_once 'HTTP/Request2.php';

$r = new HTTP_REQUEST2('http://www.example.com/robots.txt');
$page = $r->send()->getBody();



/*file_get_contents(), like all PHP file-handling functions, uses PHP’s streams feature.
This means that it can handle local files as well as a variety of network resources, including
HTTP URLs
	> ALERT < 
		There’s a catch, though—the allow_url_fopen configuration setting must be turned on (which it usually is)
*/
$url = 'http://rss.news.yahoo.com/rss/oddlyenough';
$rss = simplexml_load_file($url);

print '<u>';
foreach($rss->channel->item as $item) {
	print '<li><a href="' . htmlentities($item->link) . '">' . htmlentities($item->title) . '</a></li>';
}
print '</ul>';



/*To retrieve a page that includes query string variables, use http_build_query() to create
the query string. It accepts an array of key/value pairs and returns a single string
with everything properly escaped*/
$vars = array(
	'page'	=>	4,
	'search'  =>	'this & that',
);

$gs = http_build_query($vars);
$url = 'http://www.example.com/search.php?' . $qs;
$page = file_get_contents($url);



/*To retrieve a protected page, put the username and password in the URL*/
$url = 'http://david:hax0r@www.example.com/secrets.php';
$page = file_get_contents($url);

/*OR with cURL*/
$c = curl_init('http://www.example.com/secrets.php');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_USERPWD, 'david:hax0r');
$page = curl_exec($c);
curl_close($c);

/*OR with HTTP_Request2*/
require 'HTTP/Request2.php';

$r = new HTTP_Request2('http://www.example.com/secrets.php');
$r->setAuth('david', 'hax0r', HTTP_Request2::AUTH_DIGEST);
$page = $r->send()->getBody();


/*PHP’s http stream wrapper automatically follows redirects 
> specifying options about how the stream is retrieved 
	>> max_redirects, the maximum number of redirects to follow*/
$url = 'http://www.example.com/redirector.php';
// Define the options
$options = array('max_redirects' => 1);
// Create a context with options for the http stream
$context = stream_context_create(array('http' => $options));
/*Pass the options to file_get_contents. The second argument is whether to use the include path, 
which we don't want here*/
print file_get_contents($url, false, $context);

/*The max_redirects stream wrapper option really indicates not how many redirects
should be followed, but the maximum number of requests that should be made when
following the redirect chain*/


/*cURL only follows redirects when the CURLOPT_FOLLOWLOCATION option is set*/
$c = curl_init('http://www.example.com/redirector.php');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
$page = curl_exec($c);
curl_close($c);

/*To set a maximum number of redirects that cURL should follow, set CURLOPT_FOLLOWLOCATION to true 
and then set the CURLOPT_MAXREDIRS option to that maximum number*/


/*HTTP_Request2 follows if the follow_redirects parameter is set to true*/
require 'HTTP/Request2.php';

$r = new HTTP_Request2('http://www.example.com/redirector.php');
$r->setConfig(array(
	'follow_redirects'	=>	true,
	'may_redirects'	   =>	1
));

$page = $r->send()->getBody();
print $page;


/*cURL can do a few different things with the page it retrieves*/
/*To write the retrieved page to a file, open a file handle for writing with fopen() and set the 
CURLOPT_FILE option to that file handle. This example uses cURL to copy a remote web page to a local file*/
$fh = fopen('local-copy-of-files.html', 'w') or die($php_errormsg);
$c = curl_init('http://www.example.com/files.html');

curl_setopt($c, CURLOPT_FILE, $fh);
curl_exec($c);
curl_close($c);


/*This example uses a cURL write function to save page contents in a database*/
class PageSaver {
	protected $db;
	protected $page = '';
	
	
	public function __construct() {
		$this->db = new PDO('sqlite:./pages.db');
	}
	
	
	public function write($curl, $data) {
		$this->page .= $data;
		return strlen($data);
	}
	
	
	public function save($curl) {
		$info = curl_getinfo($curl);
		$st = $this->db->prepare("INSERT INTO pages (url, page) VALUES ($,$)");
		$st->execute(array($info['url'], $this->page));
	}
}

// Create the saver instance
$pageSaver = new PageSaver();
// Create the cURL resources
$c = curl_init('http://www.example.com/');
// Set the write function
curl_setopt($c, CURLOPT_WRITEFUNCTION, array($pageSaver, 'write'));
// Execute the request
curl_exec($c);
// Save the accumulated data
$pageSaver->save($c);

?>
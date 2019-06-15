<?php 
/*

!!API - FETCHING A URL WITH COOKIES!!

> want to retrieve a page that requires a cookie to be sent with the request for the page

> Cookies are sent to the server in the Cookie request header. Although in practice just
another HTTP header, due to their importance, both the cURL extension and the HTTP_Request2 
package have specific functions to set cookies

*curl_init - initialize a cURL session
*curl_setopt - set an option for a cURL transfer
*curl_exec - perform a cURL session
*curl_close - close a cURL session
*tempnam - create file with unique file name
*unlink - deletes a file

*/


/*Use the CURLOPT_COOKIE option with cURL*/
$c = curl_init('http://www.example.com/needs-cookies.php');

curl_setopt($c, CURLOPT_COOKIE, 'user=ellen; activity=swimming');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);


/*With HTTP_Request2, use the addCookie() method*/
require 'HTTP/Request2.php';

$r = new HTTP_Request2('http://www.example.com/needs-cookies.php');
$r->addCookie('user', 'ellen');
$r->addCookie('activity', 'swimming');

$page = $r->send()->getBody();
echo $page;



/*To request a page that sets cookies and then make subsequent requests that include those newly 
set cookies, use cURL’s “cookie jar” feature. On the first request, set CURLOPT_COOKIEJAR to the 
name of a file in which to store the cookies

On subsequent requests, set CURLOPT_COOKIEFILE to the same filename, and cURL reads the cookies from 
the file and sends them along with the request. 
	> This is especially useful for a sequence of requests in which the first request logs in to a site 
	that sets session or authentication cookies, and then the rest of the requests need to include those 
	cookies to be valid*/

// A temporary file to hold the cookies
$cookie_jar = tempnam('/tmp', 'cookie');

// log in
$c = curl_init('https://bank.example.com/login.php?user=donald&password=b1g$');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_COOKIEJAR, $cookie_jar);

$page = curl_exec($c);
curl_close($c);

// retrieve account balance
$c = curl_init('http://bank.example.com/balance.php?account=checking');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_COOKIEFILE, $cookie_jar);

$page = curl_exec($c);
curl_close($c);

// make a deposit
$c = curl_init('http://bank.example.com/deposit.php');
curl_setopt($c, CURLOPT_POST, true);
curl_setopt($c, CURLOPT_POSTFIELDS, 'account=checking&amount=122.44');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_COOKIEFILE, $cookie_jar);

$page = curl_exec($c);
curl_close($c);

// remove the cookie jar
unlink($cookie_jar) or die("Can't unlink $cookie_jar");

/*Be careful where you store the cookie jar. It needs to be in a place your web server has write 
access to, but if other users can read the file, they may be able to poach the authentication
credentials stored in the cookies*/



/*HTTP_Request2 offers a similar cookie-tracking feature. You need to invoke the
setCookieJar() method to enable it. Then, if you make multiple requests with the same
HTTP_Request2 object, cookies are automatically preserved from one request to the next*/
require 'HTTP/Request2.php';

$r = new HTTP_Request2;
$r->setCookieJar(true);

// log in
$r->setUrl('https://bank.example.com/login.php?user=donald&password=b1gmoney$');
$page = $r->send()->getBody();

// retrieve account balance
$r->setUrl('http://bank.example.com/balance.php?account=checking');
$page = $r->send()->getBody();

// make a deposit
$r->setUrl('http://bank.example.com/deposit.php');
$r->setMethod(HTTP_Request2::METHOD_POST)->addPostParameter('account', 'checking')->addPostParameter('amount','122.44');

$page = $r->send()->getBody();

?>
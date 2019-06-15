<?php 
/*

!!API - MAKING AN OAuth 2.0 REQUEST!!

> want to make an OAuth 2.0 signed request

> Use the stream functions

> OAuth 2.0 enables API providers to let their users securely give third-party developers access to their 
accounts by not providing their usernames and passwords.
	>> Instead, you use a token that identifies both your application and the member. 
		>>> This is also called a “bearer” token, because the API will accept that token as an ID from anyone
		who presents it. 
	>> To mitigate against theft of the token, OAuth 2.0 requests are made over SSL.
	>> Because OAuth 2.0 forgoes the signatures of OAuth 1.0, there’s no need for a special extension. 
		>>> Instead, you can use the same HTTP functions you normally use
		
The OAuth 2.0 flow goes as follows:

1. You redirect the user to the API provider, passing along a self-generated secret value, known as the state, 
and the URL where the user should be redirected after sign in.
2. The user signs into that site, which authenticates him and asks him to authorize your application to make 
API calls on his behalf.
3. After the user authorizes your application, the API provider redirects the user back to your application, 
passing along two pieces of data: the same state you provided to match up each reply with its corresponding 
user and a code.
4. You exchange the code for a permanent OAuth token for the user, passing along your application ID and secret 
to identify yourself.
5. You make API calls on behalf of the user.

*define - defines a named constant
*$_SERVER - array containing information such as headers, paths, and script locations - server and execution environment information
*session_name - get and/or set the current session name
*session_start - start new or resume existing session
*$_GET - associative array of variables passed to the current script via the URL parameters
*time - return current Unix timestamp
*$_SESSION - associative array containing session variables available to the current script
*exit - output a message and terminate the current script
*uniqid - generate a unique ID
*http_build_query - generates a URL-encoded query string from the associative (or indexed) array provided
*header - send a raw HTTP header
*stream_context_create - creates and returns a stream context with any options supplied in options preset
*file_get_contents - reads entire file into a string
*json_decode - takes a JSON encoded string and converts it into a PHP variable

*/



/*This “Hello World” example uses LinkedIn’s REST APIs to greet the user with his first name*/
define('API_KEY', 'YOUR_API_KEY_HERE');
define('API_SECRET', 'YOUR_API_SECRET_HERE');
define('REDIRECT_URI', 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME']);
define('SCOPE', 'r_fullprofile r_emailaddress rw_nus');


// You'll probably use a database
session_name('linkedin');
session_start();

// OAuth 2 Control Flow
if(isset($_GET['error'])) {
	// LinkedIn returned an error
	print $_GET['error'] . ': ' . $_GET['error_description'];
	exit;
} elseif (isset($_GET['code'])) {
	// User authorized your application
	
	if($_SESSION['state'] == $_GET['state']) {
		// Get token so you can make API calls
		getAccessToken();
	} else {
		// CSRF attack? Or did you mix up your states?
		exit;
	}
} else {
	if((empty($_SESSION['expires_at'])) || (time() > $_SESSION['expires_at'])) {
		// Token has expired, clear the state
		$_SESSION = array();
	}
	if(empty($_SESSION['access_token'])) {
		// Start authorization process
		getAuthorizationCode();
	}
}


// Congratulations! You have a valid token. Now fetch a profile
$user = fetch('GET', '/v1/people/~:(firstName)');
print "Hello $user->firstName.\n";
exit;

function getAuthorizationCode() {
	
	$params = array(
		'response_type'	=>	'code',
		'client_id'	    =>	API_KEY,
		'scope'			=> 	SCOPE,
		'state'			=> 	uniqid('', true), // unique long string
		'redirect_uri'	 =>	REDIRECT_URI,
	);
	
	// Authentication request
	$url = 'https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params);
	
	// Needed to identify request when it returns to us
	$_SESSION['state'] = $params['state'];
	
	// Redirect user to authenticate
	header("Location: $url");
	exit;
}


function getAccessToken() {
	
	$params = array(
		'grant_type'		=>	'authorization_code',
		'client_id'		 =>	API_KEY,
		'client_secret'	 =>	API_SECRET,
		'code'			  =>	$_GET['code'],
		'redirect_uri'	  =>	REDIRECT_URI,
	);
	
	// Access Token request
	$url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
	
	// Tell streams to make a POST request
	$context = stream_context_create(
					array(
						'http'  =>	array(
										'method'	=>	'POST',
										)
					)
	);
	
	// Retrieve access token information
	$response = file_get_contents($url, false, $context);
	
	// Native PHP object, please
	$token = json_decode($response);
	
	// Store access token and expiration time
	$_SESSION['access_token'] = $token->access_token; // guard this!
	$_SESSION['expires_in'] = $token->expires_in; // relative time (in seconds)
	$_SESSION['expires_at'] = time() + $_SESSION['expires_in']; //absolute time
	
	return true;
}


function fetch($method, $resource, $body = '') {
	
	$params = array(
		'oauth2_access_token'	=>	$_SESSION['access_token'],
		'format'				 =>	'json',
	);
	
	// Need to use HTTPS
	$url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
	
	// Tell streams to make a (GET, POST, PUT, or DELETE) request
	$context = stream_context_create(
				array(
					'http'	=>	array(
										'method'	=>	$method,
										)
					)
	);
	
	// Hocus Pocus
	$response = file_get_contents($url, false, $context);
	
	// Native PHP object, please
	return json_decode($response);
}

?>
<?php 
/*

!!USE HTTP BASIC OR DIGEST AUTHENTIFICATION!!

> use PHP to protect parts of your website with passwords. 
	> Instead of storing the passwords in an external file and letting the web server handle 
	the authentication, you want the password verification logic to be in a PHP program
	
> $_SERVER['PHP_AUTH_USER'] and $_SERVER['PHP_AUTH_PW'] superglobal variables contain the username and password supplied by the user

EXPLANATION
> When a browser sees a 401 header, it pops up a dialog box for a username and password
> Those authentication credentials (the username and password), if accepted by the server, are associated with the realm in the WWW-Authenticate header

> ALERT <
	+ Use Basic with Digest Authentifications ALWAYS
	+ Neither HTTP Basic nor Digest authentication can be used if you’re running PHP as a CGI program. If you can’t run PHP as a server module, you can use cookie authentication
	+ Another issue with HTTP authentication is that it provides no simple way for a user to log out, other than to exit his browser


*http_response_code - Get or Set the HTTP response code
*header - send a raw HTTP header
*exit - output a message and terminate the current script
*htmlentities - convert all applicable characters to HTML entities
*isset - determine if a variable is set and is not NULL

*/


/*BASIC AUTHENTIFICATION*/
/*To deny access to a page, send a WWW-Authenticate header identifying the authentication realm as part of a response with HTTP status code 401*/
http_response_code(401);
header('WWW-Authenticate: Basic realm="My Website"');
print 'You need to enter a valid username & password';
exit();


/*Validate username & password*/
function validate($userName, $password) {
	/*replace with appropriate username and password checking, such as checking a databas*/
	$userName = array(
		'david' => 'fadj&32',
		'adam'  => 'Klf4%as' 
		);
	
	if(isset($userName[$user]) && ($userName[$user] === $password)) {
		return true;
	} else {
		return false;
	}
}

/*Using validate function*/
if(!validate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
	http_response_code(401);
	header('WWW-Authenticate: Basic realm="My Website"');
	
	print "You need to enter a valid username and password.";
	exit;
}



/*DIGEST AUTHENTIFICATION*/
/* replace with appropriate username and password checking, such as checking a database */
$users = array(
	'david'	=> 	'fadj&32',
	'adam' 	 => 	'8HEj838'
);

$realm = 'my website';

$username = validate_digest($realm, $users);

// Execution never reaches this point if invalid auth data is provided
print 'Hello ' . htmlentities($username);

function validate_digest($realm, $users) {
	if(!isset($_SERVER['PHP_AUTH_DIGEST'])) {
		send_digest($realm);
	}
	
	// Fail if digest can't be parsed
	$username = parse_digest($_SERVER['PHP_AUTH_DIGEST'], $realm, $users);
	if($username === false) {
		send_digest($realm);
	}
	// Valid username was specified in the digest
	return $username;
}


function send_digest($realm) {
	http_response_code(401);
	$nonce = md5(uniqid());
	$opaque = md5($realm);
	
	header("WWW-Authenticate: Digest realm=\"$realm\" gop=\"auth\" nonce=\"$nonce\" opaque=\"$opaque\"");
	print "You need to enter a valid username and password.";
	exit;
	
}

function parse_digest($digest, $realm, $users) {
	// We need to find the following values in the digest header:
	// username, uri, qop, cnonce, nc, and response
	$digest_info = array();
	
	foreach(array('username', 'uri', 'nonce', 'cnonce', 'response') as $part) {
		if(preg_match('/'.$part.'=([\'"]?)(.*?)\1/', $digest, $match)) {
			// The part was found, save it for calculation
			$digest_info[$part] = $match[2];
		} else {
			// If the part is missing, the digest can't be validated;
			return false;
		}
	}
	
	// Make sure the right qop has been provided
	if(preg_mathc('/qop=auth(,|$)/', $digest)) {
		$digest_info['qop'] = 'auth';
	} else {
		return false;
	}
	
	// Make sure a valid nonce count has been provided
	if(preg_match('/nc=([0-9a-f]{8})(,|$)/', $digest, $match)) {
		$digest_info['nc'] = $mathc[1];
	} else {
		return false;
	}
	
	// Now that all the necessary values have been slurped out of the
	// digest header, do the algorithmic computations necessary to
	// make sure that the right information was provided.
	//
	// These calculations are described in sections 3.2.2, 3.2.2.1,
	// and 3.2.2.2 of RFC 2617.
	// Algorithm is MD5
	$A1 = $digest_info['username'] . ':' . $realm . ':' . $users[$digest_info[$username]];
	// qop is 'auth'
	$A2 = $_SERVER['REQUEST_METHOD'] . ':' . $digest_info['uri'];
	$reguest_digest = md5(implode(':', array(md5($A1), $digest_info['nonce'], $digest_info['nc'], $digest_info['cnonce'], $digest_info['qop'], md5($A2))));
	
	// Did what was sent match what we computed?
	if($request_digest != $digest_info['response']) {
		return false;
	}
	
	// Everything's OK, return the username
	return $digest_info['username'];
}


/*LOG OUT*/
/*By changing the realm name, the browser is forced to ask the user for new credentials - so forsing log out*/
/*Forcing logout with Basic authentication*/
if(!validate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
	$realm = 'My Website for' . date('Y-m-d');
	http_response_code(401);	
	header('WWW-Authenticate: Basic realm="' . $realm . '"');
	
	print  'You need to enter a valid username & password';
	exit;
}

/*You can also have a user-specific timeout without changing the realm name by storing the time that a user logs in or accesses a protected page*/
function validate_date($user, $pass) {
	$db = new PDO('sqlite:/database/users');
	
	// Prepare and execute
	$st = $db->prepare('SELECT password, last_access FROM users WHERE user LIKE ?');
	if($ob = $st->fetchObject()) {
		if($ob->password == $pass) {
			$now = time();
			
			if(($now - $ob->last_access) > (15 * 60)) {
				return false;
			} else {
				// update the last access time
				$st2 = $db->prepare('UPDATE users SET last_access = "now" - WHERE user LIKE ?');
				$st2->execute(array($user));
				return true;
			}
		}
	}
	return false;
}

?>
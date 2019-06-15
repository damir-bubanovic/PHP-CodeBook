<?php 
/*

!!SESSION - PREVENTING SESSION FIXATION!!

> want to make sure that your application is not vulnerable to session fixation attacks, 
in which an attacker forces a user to use a predetermined session ID

> Require the use of session cookies without session identifiers appended to URLs, and generate a new session ID frequently

EXPLANATION:
> We start by setting PHP’s session behavior to use cookies only. 
	>> This ensures PHP won’t pay attention to a session ID if an attacker has put one in a URL
> Once the session is started, we set a value that will keep track of the last time a session ID was generated. 
	>> By requiring a new one to be generated on a regular basis—every 30 seconds in this example—the opportunity 
	for an attacker to obtain a valid session ID is dramatically reduced

*ini_set - sets the value of the given configuration option
*session_start - start new or resume existing session
*isset - determine if a variable is set and is not NULL
*time - return current Unix timestamp
*session_regenerate_id - update the current session id with a newly generated one

*/


ini_set('session.use_only_cookies', true);

session_start();

if(!isset($_SESSION['generated']) || $_SESSION['generated'] < (time() - 30)) {
	session_regenerate_id();
	$_SESSION['generated'] = time();
}

?>
<?php 
/*

!!SECURITY - PREVENTING SESSION FIXATION!!

> You need to ensure that a user’s session identifier cannot be provided 
by a third party, such as an attacker who seeks to hijack the user’s session

> For sessions to work, each of the users’ requests must include a session identifier 
that uniquely identifies a session

> ALERT <
	By default, PHP accepts a session identifier sent in a cookie, but if session.use_only_cookies is set to 1, 
	it will accept a session identifier in the URL. 
		>> An attacker can trick a victim into following a link to your application that includes an embedded 
		session identifier			
			<a href="http://example.org/login.php?PHPSESSID=1234">Click Here!</a>
		>> A user who follows this link will resume the session identified as 1234

> As of PHP 5.5.2, a new configuration setting, session.use_strict_mode helps prevent session hijacking. 
	>> When this is enabled, PHP accepts only already initialized session IDs. 
	>> If a browser sends a new session ID, PHP rejects it and generates a new one

	

*session_regenerate_id - update the current session id with a newly generated one
*$_SESSION - associative array containing session variables available to the current script

*/


/*Regenerate the session identifier with session_regenerate_id() whenever there 
is a change in the user’s privilege, such as after a successful login*/
session_regenerate_id();
$_SESSION['logged_in'] = true;

?>
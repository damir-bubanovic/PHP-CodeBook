<?php 
/*

!!SESSION - RESOLVE THE REGENERATE ISSUE!!

> I wrote the following code for a project I'm working on- it attempts to resolve the 
regenerate issue, as well as deal with a couple of other session related things.

> I tried to make it a little more generic and usable (for instance, in the full version 
it throws different types of exceptions for the different types of session issues), 
so hopefully someone might find it useful.

*$_SESSION - associative array containing session variables available to the current script
*md5 - calculate the md5 hash of a string
*microtime - return current Unix timestamp with microseconds
*time - return current Unix timestamp
*session_regenerate_id - update the current session id with a newly generated one
*session_id - get and/or set the current session id
*session_write_close - write session data and end session
*session_start - start new or resume existing session
*is_numeric - finds whether a variable is a number or a numeric string
*mt_rand - generate a better random value

*/

function regenerateSession($reload = false) {
    // This token is used by forms to prevent cross site forgery attempts
    if(!isset($_SESSION['nonce']) || $reload) {
        $_SESSION['nonce'] = md5(microtime(true));
	}

    if(!isset($_SESSION['IPaddress']) || $reload) {
        $_SESSION['IPaddress'] = $_SERVER['REMOTE_ADDR'];
	}

    if(!isset($_SESSION['userAgent']) || $reload) {
        $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
	}
	

    //$_SESSION['user_id'] = $this->user->getId();

    // Set current session to expire in 1 minute
    $_SESSION['OBSOLETE'] = true;
    $_SESSION['EXPIRES'] = time() + 60;

    // Create new session without destroying the old one
    session_regenerate_id(false);

    // Grab current session ID and close both sessions to allow other scripts to use them
    $newSession = session_id();
    session_write_close();

    // Set session ID to the new one, and start it back up again
    session_id($newSession);
    session_start();

    // Don't want this one to expire
    unset($_SESSION['OBSOLETE']);
    unset($_SESSION['EXPIRES']);
}



function checkSession() {
    try {
        if($_SESSION['OBSOLETE'] && ($_SESSION['EXPIRES'] < time())) {
            throw new Exception('Attempt to use expired session.');
		}

        if(!is_numeric($_SESSION['user_id'])) {
            throw new Exception('No session started.');
		}

        if($_SESSION['IPaddress'] != $_SERVER['REMOTE_ADDR']) {
            throw new Exception('IP Address mixmatch (possible session hijacking attempt).');
		}

        if($_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT']) {
            throw new Exception('Useragent mixmatch (possible session hijacking attempt).');
		}

        if(!$this->loadUser($_SESSION['user_id'])) {
            throw new Exception('Attempted to log in user that does not exist with ID: ' . $_SESSION['user_id']);
		}

        if(!$_SESSION['OBSOLETE'] && mt_rand(1, 100) == 1) {
            $this->regenerateSession();
        }

        return true;

    } catch(Exception $e){
        return false;
    }
}

?>
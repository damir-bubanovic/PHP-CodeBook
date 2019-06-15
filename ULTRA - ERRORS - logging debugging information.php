<?php 
/*

!!ERRORS - LOGGING DEBUGGING INFORMATION!!

> want to make debugging easier by adding statements to print out variables. 
	>> But you want to be able to switch back and forth easily between production and debug modes

*define - defines a named constant
*defined - checks whether a given named constant exists
*error_log - send an error message to the defined error handling routines
*mysqli_query - send a MySQL query

*/


/* 1) Put a function that conditionally prints out messages based on a defined constant 
in a page included using the auto_prepend_file configuration setting. 

Save the following code to debug.php*/
// turn debugging on
define('DEBUG',true);

// generic debugging function
function pc_debug($message) {
	if(defined('DEBUG') && DEBUG) {
		error_log($message);
	}
}

/*2) Set the auto_prepend_file directive in php.ini or your site .htaccess file*/
?>

auto_prepend_file=debug.php

<?php
/*3) call pc_debug() from your code to print out debugging information*/
$sql = 'SELECT color, shape, smell FROM vegetables';
pc_debug("[sql: $sql]"); // only printed if DEBUG is true
$r = mysqli_query($sql);

?>


<?php 
/*1) DEBUGGING TECHNIQUE*/
/*assign different priority levels to different types of debugging comments. Then the 
debug function prints information only if it’s higher than the current priority level*/
define('DEBUG',2);

function pc_debug($message, $level = 0) {
	if(defined('DEBUG') && ($level > DEBUG)) {
		error_log($message);
	}
}

$sql = 'SELECT color, shape, smell FROM vegetables';
pc_debug("[sql: $sql]", 1); // not printed, since 1 < 2
pc_debug("[sql: $sql]", 3); // printed, since 3 > 2



/*2) DEBUGGING TECHNIQUE*/
/*write wrapper functions to include additional information to help with performance 
tuning, such as the time it takes to execute a database query*/
function db_query($sql) {
	
	if(defined('DEBUG') && DEBUG) {
		// start timing the query if DEBUG is on
		$DEBUG_STRING = "[sql: $sql]<br>\n";
		$starttime = microtime(true);
	}
	
	$r = mysql_query($sql);
	
	if(!$r) {
		$error = mysql_error();
		error_log('[DB: query @'.$_SERVER['REQUEST_URI']."][$sql]: $error");
	} elseif(defined(DEBUG) && DEBUG) {
		// the query didn't fail and DEBUG is turned on, so finish timing it
		$endtime = microtime(true);
		$elapsedtime = $endtime - $starttime;
		$DEBUG_STRING .= "[time: $elapsedtime]<br>\n";
		error_log($DEBUG_STRING);
	}
	
	return $r;
}
/*Here, instead of just printing out the SQL to the error log, you also record the number
of seconds it takes MySQL to perform the request. This lets you see if certain queries
are taking too long*/



/*3) DEBUGGING TECHNIQUE*/
/*integrate PEAR’s Log package, which provides an efficient framework for an abstracted 
logging system. PEAR Log predefines eight log levels: 
	PEAR_LOG_EMERG, PEAR_LOG_ALERT, PEAR_LOG_CRIT, PEAR_LOG_ERR, PEAR_LOG_WARNING, 
	PEAR_LOG_NOTICE, PEAR_LOG_INFO, and PEAR_LOG_DEBUG. 
The Log package provides a robust assortment of options for customizing error logging, 
including logging errors to SQLite and/or to a pop-up browser window*/

?>
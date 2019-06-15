<?php 
/*

!!ERRORS - LOGGING ERRORS!!

> You want to save program errors to a log. 
	>> These errors can include everything from parser errors and files not 
	being found to bad database queries and dropped connections

*ldap_errno - return the LDAP error number of the last LDAP command
*error_log - send an error message to the defined error handling routines
*mysqli_query - send a MySQL query
*mysqli_error - returns the text of the error message from previous MySQL operation

*/


/*Use error_log() to write to the error log*/
// LDAP error
if(ldap_errno($ldap)) {
	error_log("LDAP Error #" . ldap_errno($ldap) . ": " . ldap_error($ldap));
}



/*Logging errors facilitates debugging. Smart error logging makes it easier to 
fix bugs. Always log information about what caused the error*/
$r = mysqli_query($sql);

if(! $r) {
	$error = mysqli_error();
	error_log('[DB: query @'.$_SERVER['REQUEST_URI']."][$sql]: $error");
} else {
	// process results
}



/*You’re not getting all the debugging help you could be if you simply log that 
an error occurred without any supporting information*/
$r = mysqli_query($sql);
if(!$r) {
	error_log("bad query");
} else {
	// process result
}



/*Another useful technique is to include the __FILE__, __LINE__, __FUNCTION__,
__CLASS__, and __METHOD__ “magic” constants in your error messages:*/
error_log('['.__FILE__.']['.__LINE__."]: $error");

?>
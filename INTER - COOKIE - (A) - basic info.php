<?php 
/*

!!BASIC COOKIE!!

> use it so hat your website can recognize subsequent requests from the same web browser (same user)
> ALERT < 
	Cookies are sent with the HTTP headers, so if you’re not using output buffering, set cookie() must be called before any output is generated
	
> $expirationTime - expressed as an epoch timestamp
	> If the $expirateionTIME is missing (or empty), the cookie expires when the browser is closed
> $path - cookie is sent back to the server only when pages whose path begin with the specified string are requested
> $domain - cookie is sent back to the server only when pages whose hostname ends with the specified domain are requested
> $flag - if set to true, instructs the browser only to send the cookie over an SSL connection
	> usefull when cookie contains sensitive information

*time - returns the current time measured in the number of seconds since the Unix Epoch (January 1 1970 00:00:00 GMT)

> deleting cookie - The call to setcookie() to delete a cookie has to have the same arguments (except for value and time)
	> that means $path, $domain & $flag if arguments used in creating a cookie

*/



/*SET COOKIE*/
setcookie($name, $value, $expirationTime, $path, $domain, $flag);	// path & domain not usually used
/*Example*/
setcookie('flavor','chocolate chip', time() + (60 * 60 * 8), '/products/', '.example.com');
	// cookie expires in 8 hours (60sec * 60min * 8h)
	// cookie is sent back to all hosts in the example.com domain



/*READ COOKIE*/
/*Look in the $_COOKIE superglobal array*/
if(isset($_COOKIE['flavor'])) {
	print "You ate a {$_COOKIE['flavor']} cookie";
}
/*print the names and values of all cookies sent in a particular request*/
foreach($_COOKIE as $cookie_name => $cookie_value) {
	print "$cookie_name = $cookie_value" . '<br />';
}



/*DELETE COOKIES*/
/*Usefull when user logs out*/
/*Call setcookie() with no value for the cookie and an expiration time in the past*/
setcookie('flavor', '', 1);
?>
<?php 
/*

!!SECURITY - DETECTING SSL!!

> You want to know if a request arrived over SSL

> Look up more on SSL and counter measeures for PHP

*$_SERVER - array containing information such as headers, paths, and script locations
*setcookie - send a cookie

*/


/*Test the value of $_SERVER['HTTPS']*/
if('on' == $_SERVER['HTTPS']) {
	print 'The secret ingredient in Coca-Cola is Soylent Green.';
} else {
	print 'Coca-Cola contains many delicious natural and artificial flavors.';
}


/*In addition to altering code based on $_SERVER['HTTPS'], you can also set cookies to
be exchanged only over SSL connections. If the last argument to setcookie() is true,
the browser sends the cookie back to the server only over a secure connection*/

/* Set an SSL-only cookie named "sslonly" with value "yes" that expires at the
end of the current browser session. */
if('on' === $_SERVER['HTTPS']) {
	setcookie('sslonly', 'yes', 0, '/', 'example.org', true);
}

?>
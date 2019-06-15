<?php 
/*

!!REDIRECTING MOBILE BROWSER TO A MOBILE OPTIMIZED SITE!!

> send mobile or tablet browsers to an alternative site or alternative content that is optimized for their device

USAGE:
1. get_browser() function examines the environment variable (set by the web server) and compares it to browsers listed in an external browser capability file
	> As a lighter-weight alternative to get_browser(), parse the $_SERVER['HTTP_USER_AGENT'] yourself
2. one source for a browser capability file is Browscap. Download the php_browscap.ini file from that site (not the standard version)
3. tell PHP where to find it by setting the browscap configuration directive to the pathname of the file. If you use PHP as a CGI, set the directive in the php.ini file
4. after you identify the device as mobile, you can then redirect the request to a specific mobile optimized site or render a mobile optimized page

*/

/*Use the object returned by get_browser() to determine if it’s a mobile browser*/
if($browser->ismobilebrowser) {
	// print mobile layout
} else {
	// print desctop layout
}


/*3.*/
browscap=/usr/local/lib/php_browscap.ini
/*4.*/
header('Location: http://m.example.com/');

?>
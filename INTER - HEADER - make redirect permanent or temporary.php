<?php 
/*

!!HEADER - MAKE REDIRECT PERMANENT OR TEMPORARY!!

> A quick way to make redirects permanent or temporary is to 
make use of the $http_response_code parameter in header()

*header - send a raw HTTP header

*/


// 301 Moved Permanently
header("Location: /foo.php",TRUE,301);

// 302 Found
header("Location: /foo.php",TRUE,302);
header("Location: /foo.php");

// 303 See Other
header("Location: /foo.php",TRUE,303);

// 307 Temporary Redirect
header("Location: /foo.php",TRUE,307);

?>
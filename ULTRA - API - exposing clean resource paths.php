<?php
/*

!!API - EXPOSING CLEAN RESOURCE PATHS!!

> want your URLs to look clean and not include file extensions

*explode - returns an array of strings, each of which is a substring of string formed by splitting 
			it on boundaries formed by the string delimiter
*$_GET - associative array of variables passed to the current script via the URL parameters - 

*/


/*1) Use Apache’s mod_rewrite to map the path to your PHP script*/
?>

RewriteEngine on
RewriteBase /v1/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?PATH_INFO=$1 [L,QSA]

<?php
/*2) Then use $_GET['PATH_INFO'] in place of $_SERVER['PATH_INFO']*/
$request = explode('/', $_GET['PATH_INFO']);


/*Use mod_rewrite to expose elegant URLs, such as /v1/books/9781449363758, even when there isn’t a 
file at that specific path. Without this, you end up with the more clumsy URL of /v1/books.php/9781449363758.*/

/*The code in the Solution tells Apache that when it doesn’t find a file or directory at the requested path, 
it should route it to index.php instead. Additionally, so you can still read in the original URL to properly 
process the request, extract the path and pass it in as the PATH_INFO query parameter*/

?>
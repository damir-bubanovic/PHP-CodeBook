<?php 
/*

!!ERRORS - ELIMINATING "headers already sent" ERRORS!!

> You are trying to send an HTTP header or cookie using header() or setcookie(), 
but PHP reports a “headers already sent” error message

> This error happens when you send nonheader output before calling header() 
or set cookie()

*setcookie - send a cookie
*copy - copies file
*trim - strip whitespace (or other characters) from the beginning and end of a string
*join - join array elements with a string - use implode instead
*file - reads entire file into an array
*fopen - opens file or URL
*fwrite - binary-safe file write
*fclose - closes an open file pointer

*/


/*Rewrite your code so any output happens after sending headers*/
// good
setcookie("name", $name);
print "Hello $name";


//bad
print "Hello $name";
setcookie("name", $name);


// good
setcookie("name",$name); 
?>
<html><title>Hello</title>

<?php 

/*
> HTTP message has a header and a body, which are sent to the client in that order.
> Once you begin sending the body, you can’t send any more headers. 
	>> If you call setcookie() after printing some HTML, PHP can’t send the appropriate Cookie header.
	>> Remove trailing whitespace in any include files.
		>>> Use trim() to remove leading and trailing blank lines from files
*/

$file = '/path/to/file.php';

// backup
copy($file, "$file.bak") or die("Can't copy $file: $php_errormsg");

// read and trim
$contents = trim(join('', file($file)));

// write
$fh = fopen($file, 'w') or die("Can't open $file for writing: $php_errormsg");
if(-1 == fwrite($fh, $contents)) {
	die("Can't write to $file: $php_errormsg");
}
fclose($fh) or die("Can't close $file: $php_errormsg");

/*Instead of processing files on a one-by-one basis, it may be more convenient 
to do so on a directory-by-directory basis*/
?>
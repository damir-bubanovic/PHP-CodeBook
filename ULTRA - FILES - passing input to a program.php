<?php 
/*

!!FILES - PASSING INPUT TO A PROGRAM!!

> You want to pass input to an external program run from inside a PHP script. 
	>> npr. your database requires you to run an external program to index text and you
	want to pass text to that program

*popen - opens process file pointer
*fputs - binary-safe file write - use fwrite instead
*pclose - closes process file pointer

*/


/*Open a pipe to the program with popen(), write to the pipe with fputs() or
fwrite(), and then close the pipe with pclose()*/
$ph = popen('/usr/bin/indexer --category=dinner', 'w') or die($php_errormsg);

if(-1 == fputs($ph, "red-cooked chicken\n")) { 
	die($php_errormsg); 
}

if(-1 == fputs($ph, "chicken and dumplings\n")) { 
	die($php_errormsg); 
}

pclose($ph)

?>
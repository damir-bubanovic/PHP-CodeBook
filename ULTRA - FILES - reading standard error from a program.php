<?php 
/*

!!FILES - READING STANDARD ERROR FROM A PROGRAM!!

> You want to read the error output from a program 
	>> npr. you want to capture the system calls displayed by strace(1)

*popen - opens process file pointer
*feof - tests for end-of-file on a file pointer
*fgets - gets line from file pointer

*/


/*Redirect standard error to standard output by adding 2>&1 to the command 
line passed to popen(). Read standard output by opening the pipe in r mode*/
$ph = popen('strace ls 2>&1', 'r') or die($php_errormsg);

while(!feof($ph)) {
	$s = fgets($ph) or die($php_errormsg);
}

pclose($ph) or die($php_errormsg);


/*This technique reads in standard error but doesn’t provide a way to distinguish it from
standard output. To read just standard error, you need to prevent standard output from
being returned through the pipe. You do this by redirecting it to /dev/null on Unix and
NUL on Windows*/
// Unix: only read standard error
$ph = popen('strace ls 2>&1 1>/dev/null', 'r') or die($php_errormsg);

// Windows: only read standard error
$ph = popen('ipxroute.exe 2>&1 1>NUL', 'r') or die($php_errormsg);

?>
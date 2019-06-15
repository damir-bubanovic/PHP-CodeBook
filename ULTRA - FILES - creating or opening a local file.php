<?php 
/*

!!FILES - CREATING OR OPENING A LOCAL FILE!!

> You want to open a local file to read data from it or write data to it

> To operate on a file, 
	+) pass the filehandle returned from fopen() to other I/O functions such as 
	+) fgets()
	+) fputs()
	+) fclose()

> LOOK UP - fopen() file modes od php.net

*fopen - opens file or URL

*/


/*Use fopen()*/
$fh = fopen('file.txt','r') or die("can't open file.txt: $php_errormsg");


/*On non-POSIX systems, such as Windows, you need to add a b to the mode when opening 
a binary file, or reads and writes get tripped up on NUL (ASCII 0) characters*/
$fh = fopen('c:/images/logo.gif','rb');


/*Even though Unix systems handle binary files fine without the b in the mode, it’s a 
good idea to use it always. That way, your code is maximally portable and runs well on 
both Unix and Windows*/

/*If the file given to fopen() doesn’t have a pathname, the file is opened in the directory
of the running script (web context) or in the current directory (command-line context)*/

/*You can also tell fopen() to search for the file to open in the include_path specified 
in your php.ini file by passing true as a third argument*/
$fh = fopen('file.inc','r',true) or die("can't open file.inc: $php_errormsg");

?>
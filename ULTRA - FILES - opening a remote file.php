<?php 
/*

!!FILES - OPENING A REMOTE FILE!!

> You want to open a file that’s accessible to you via HTTP or FTP
	>> When fopen() is passed a filename that begins with http://, it retrieves the 
	given page with an HTTP/1.0 GET request
		>>> Files can be read, but not written, via HTTP
		
	>> When fopen() is passed a filename that begins with ftp://, it returns a pointer 
	to the specified file, obtained via passive-mode FTP. 
		>> You can open files via FTP for either reading or writing, but not both

*fopen - opens file or URL

*/


/*Pass the file’s URL to fopen()*/
$fh = fopen('http://www.example.com/robots.txt','r') or die($php_errormsg);


/*To open URLs that require a username and a password with fopen(), embed the 
authentication information in the URL as shown*/
$fh = fopen('ftp://username:password@ftp.example.com/pub/Index','r');
$fh = fopen('http://username:password@www.example.com/robots.txt','r');

?>
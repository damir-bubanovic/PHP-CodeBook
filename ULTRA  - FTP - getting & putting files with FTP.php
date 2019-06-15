<?php 
/*

!!INTERNET SERVECES - GETTING & PUTTING FILES WITH FTP!!

> want to transfer files using FTP

> FTP is a method of exchanging files between one computer and another. 
	>> Unlike with HTTP servers, it’s easy to set up an FTP server to both send and receive files
	
> Using the built-in FTP functions doesn’t require additional libraries, but you must specifically 
enable them with --enable-ftp

*ftp_connect - opens an FTP connection
*ftp_login - logs in to an FTP connection
*ftp_put - uploads a file to the FTP server
*ftp_close - closes an FTP connection
*curl_init - initialize a cURL session
*fopen - opens file or URL
*curl_setopt - set an option for a cURL transfer
*curl_exec - perform a cURL session
*curl_close - close a cURL session
*ftp_get - downloads a file from the FTP server
*ftp_fget - downloads a file from the FTP server and saves to an open file
*set_time_limit - limits the maximum execution time
*ftp_set_option - set miscellaneous runtime FTP options

*/


/*Use PHP’s built-in FTP functions*/
$c = ftp_connect('ftp.example.com') or die("Can't connect");
ftp_login($c, $username, $password) or die("Can't login");
ftp_put($c, $remote, $local, FTP_ASCII) or die("Can't transfer");
ftp_close($c) or die("Can't close");


/*You can also use the cURL extension*/
$c = curl_init("ftp://$username:$password@ftp.example.com/$remote");

// $local is the location to store file on local machine
$fh = fopen($local, 'w') or die($php_errormsg);
curl_setopt($c, CURLOPT_FILE, $fh);
curl_exec($c);
curl_close($c);


/*Some FTP servers support a feature known as anonymous FTP. Under anonymous FTP,
users can log in without an account on the remote system. When you use anonymous
FTP, your username is anonymous, and your password is your email address*/


/*Here’s how to transfer files with ftp_put() and ftp_get()*/
/*
ftp_put() function takes a file on your computer and copies it to the remote server;
ftp_get() copies a file on the remote server to your computer
*/
ftp_put($c, $remote, $local, FTP_ASCII) or die("Can't transfer");
ftp_get($c, $local, $remote, FTP_ASCII) or die("Can't transfer");


/*how to retrieve a file and write it to the existing file pointer, $fp*/
$fp = fopen($file, 'w');
ftp_fget($c, $fp, $remote, FTP_ASCII) or die("Can't transfer");


/*To adjust the amount of seconds the connection takes to time out, use ftp_set_option()*/
// Up the time out value to two minutes:
set_time_limit(120);
$c = ftp_connect('ftp.example.com');
ftp_set_option($c, FTP_TIMEOUT_SEC, 120);
/*The default value is 90 seconds; however, the default max_execution_time of a PHP
script is 30 seconds. So if your connection times out too early, be sure to check both
values*/



/*To use the cURL extension, you must download cURL and set the --with-curl configuration
option when building PHP. To use cURL, start by creating a cURL handle
with curl_init(), and then specify what you want to do using curl_setopt(). The
curl_setopt() function takes three parameters: a cURL resource, the name of a cURL
constant to modify, and a value to assign to the second parameter. In the Solution, the
CURLOPT_FILE constant is used*/
$c = curl_init("ftp://$username:$password@ftp.example.com/$remote");
// $local is the location to store file on local client
$fh = fopen($local, 'w') or die($php_errormsg);
curl_setopt($c, CURLOPT_FILE, $fh);
curl_exec($c);
curl_close($c);

?>
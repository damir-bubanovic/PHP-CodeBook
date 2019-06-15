<?php 
/*

!!DIRECTORIES - SPLITTING A FILENAME INTO ITS COMPONENT PARTS!!

> You want to find a file’s path and filename
	>> npr. you want to create a file in the same directory as an existing file


*basename - returns trailing name component of path
*dirname - returns a parent directory's path
*pathinfo - returns information about a file path
*tempnam - create file with unique file name
*fopen - opens file or URL

*/


/*Use basename() to get the filename and dirname() to get the path*/
$full_name = '/usr/local/php/php.ini';
$base = basename($full_name); // $base is "php.ini"
$dir = dirname($full_name); // $dir is "/usr/local/php"


/*Use pathinfo() to get the directory name, base name, and extension in an associative array*/
$info = pathinfo('/usr/local/php/php.ini');
// $info['dirname'] is "/usr/local/php"
// $info['basename'] is "php.ini"
// $info['extension'] is "ini"


/*To create a temporary file in the same directory as an existing file, use dirname() 
to find the directory, and pass that directory to tempnam().*/
$dir = dirname($existing_file);
$temp = tempnam($dir, 'temp');
$temp_fh = fopen($temp, 'w');


/*__FILE__ useful when you want to include or require scripts in the same directory as a 
particular file, but you don’t know what that directory is and it isn’t necessarily in the 
include path*/
$currentDir = dirname(__FILE__);
include $currentDir . '/functions.php';
include $currentDir . '/classes.php';


/*Using functions such as basename(), dirname(), and pathinfo() is more portable than
just splitting up full filenames on the / character because the functions use an operating
system–appropriate separator*/

?>
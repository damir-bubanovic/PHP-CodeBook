<?php 
/*

!!DIRECTORIES - GETTING FILE INFORMATION!!

> You want to read a file’s metadata
	>> npr. for permissions and ownership
	
> LOOK UP - Information returned by stat() on php.net

> Because stat() returns an array with both numeric and string indexes, using fore
ach to iterate through the returned array produces two copies of each value. 
	>> Instead, use a for loop from element 0 to element 12 of the returned array	


*stat - gives information about a file
*base_convert - convert a number between arbitrary bases

*/


/*Use stat(), which returns an array of information about a file*/
$info = stat('harpo.php');


/*The mode element of the returned array contains the permissions expressed as a base
10 integer. To convert the permissions to the more understandable octal format, 
use base_convert()*/
$file_info = stat('/tmp/session.txt');
$permissions = base_convert($file_info['mode'],10,8);

?>
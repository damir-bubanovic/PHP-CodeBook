<?php 
/*

!!DIRECTORIES - GETTING & SETTING FILE TIMESTAMPS!!

> You want to know when a file was last accessed or changed, or you want to update a
file’s access or change time
	>> npr. you want each page on your website to display when it was last modified
	
> Update a file’s modification time with touch(). Without a second argument, touch()
sets the modification time to the current date and time. To set a file’s modification time
to a specific value, pass that value as an epoch timestamp to touch() as a second argument

> The fileatime() function returns the last time a file was opened for reading or writing.
The filemtime() function returns the last time a file’s contents were changed. The
filectime() function returns the last time a file’s contents or metadata (such as owner
or permissions) were changed. Each function returns the time as an epoch timestamp

*fileatime - gets last access time of file
*touch - sets access and modification time of file
*strftime - format a local time/date according to locale settings

*/


/*The fileatime(), filemtime(), and filectime() functions return the time 
of last access, modification, and metadata change of a file, as shown*/
$last_access = fileatime('larry.php');
$last_modification = filemtime('moe.php');
$last_change = filectime('curly.php');


/*This example changes the modification time of two files without changing 
their contents:*/
touch('shemp.php'); // set modification time to now
touch('joe.php', $timestamp); // set modification time to $timestamp


/*This code prints the time a page on your website was last updated*/
print "Last Modified: ". strftime('%c',filemtime($_SERVER['SCRIPT_FILENAME']));

?>
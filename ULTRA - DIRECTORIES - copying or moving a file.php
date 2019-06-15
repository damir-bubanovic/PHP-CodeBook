<?php 
/*

!!DIRECTORIES - COPYING OR MOVING A FILE!!

> You want to copy or move a file

> If you have multiple files to copy or move, call copy() or rename() in a loop.
> You can operate only on one file each time you call these functions

*copy - copies file
*rename - renames a file or directory

*/


/*Use copy() to copy a file*/
$old = '/tmp/yesterday.txt';
$new = '/tmp/today.txt';
copy($old,$new) or die("couldn't copy $old to $new: $php_errormsg");


/*Use rename() to move a file*/
$old = '/tmp/today.txt';
$new = '/tmp/tomorrow.txt';
rename($old,$new) or die("couldn't move $old to $new: $php_errormsg");

?>
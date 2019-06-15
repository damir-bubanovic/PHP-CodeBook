<?php 
/*

!!DIRECTORIES - DELETING A FILE!!

> You want to delete a file

> If you’re having trouble getting unlink() to work, check the permissions
on the file and how you’re running PHP

*unlink - deletes a file

*/


/*Use unlink()*/
$file = '/tmp/junk.txt';
unlink($file) or die ("can't delete $file: $php_errormsg");

?>
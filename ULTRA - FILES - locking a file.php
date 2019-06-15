<?php 
/*

!!FILES - LOCKING A FILE!!

> You want to have exclusive access to a file to prevent it from being changed while you
read or update it. 
	>> npr. if you are saving guestbook information in a file, two users should be able to 
	add guestbook entries at the same time without clobbering each other’s entries
	
> In general, if you find yourself needing to lock a file, it’s best to see if there’s an 
alternative way to solve your problem. 
> Often you can (and should!) use a database (or SQLite, if you don’t have access to a 
standalone database) instead

> You can set two kinds of locks with flock(): exclusive locks and shared locks. An exclusive
lock, specified by LOCK_EX as the second argument to flock(), can be held only
by one process at one time for a particular file. A shared lock, specified by LOCK_SH, can
be held by more than one process at one time for a particular file. Before writing to a
file, you should get an exclusive lock. Before reading from a file, you should get a shared
lock.

> To unlock a file, call flock() with LOCK_UN as the second argument. It’s important to
flush any buffered data to be written to the file with fflush() before you unlock the
file. Other processes shouldn’t be able to get a lock until that data is written


*fopen - opens file or URL
*flock - portable advisory file locking
*fwrite - binary-safe file write
*fflush - flushes the output to a file
*fclose - closes an open file pointer
*sleep - delay execution
*file_exists - checks whether a file or directory exists
*touch - sets access and modification time of file

*/


/*Use flock() to provide advisory locking*/
$fh = fopen('guestbook.txt', 'a') or die($php_errormsg);
flock($fh, LOCK_EX) or die($php_errormsg);
fwrite($fh, $_POST['guestbook_entry']) or die($php_errormsg);
fflush($fh) or die($php_errormsg);
flock($fh, LOCK_UN) or die($php_errormsg);
fclose($fh) or die($php_errormsg);


/*By default, flock() blocks until it can obtain a lock. To tell it not to block, 
add LOCK_NB to the second argument, as shown*/
$fh = fopen('guestbook.txt', 'a') or die($php_errormsg);
$tries = 3;

while ($tries > 0) {
	$locked = flock($fh,LOCK_EX | LOCK_NB);
	
	if(!$locked) {
		sleep(5);
		$tries--;
	} else {
		// don't go through the loop again
		$tries = 0;
	}
}

if ($locked) {
	fwrite($fh, $_POST['guestbook_entry']) or die($php_errormsg);
	fflush($fh) or die($php_errormsg);
	flock($fh, LOCK_UN) or die($php_errormsg);
	fclose($fh) or die($php_errormsg);
} else {
	print "Can't get lock.";
}


/*If you use a file instead of a directory as a lock indicator, 
the code to create it looks something like this*/
$locked = 0;

while(!$locked) {
	if (!file_exists('guestbook.txt.lock')) {
		touch('guestbook.txt.lock');
		$locked = 1;
	} else {
		sleep(1);
	}
}

?>
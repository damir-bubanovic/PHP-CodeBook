<?php 
/*

!!DIRECTORIES - REMOVING A DIRECTORY & ITS CONTENTS!!

> You want to remove a directory and all of its contents, 
including subdirectories and their contents

*rmdir - removes directory
*unlink - deletes a file
*rmdir - removes directory

*/


/*Use RecursiveDirectoryIterator and RecursiveIteratorIterator, specifying that
children (files and subdirectories) should be listed before their parents*/
function obliterate_directory($dir) {
	$iter = new RecursiveDirectoryIterator($dir);
	
	foreach(new RecursiveIteratorIterator($iter, RecursiveIteratorIterator::CHILD_FIRST) as $f) {
		if($f->isDir()) {
			rmdir($f->getPathname());
		} else {
			unlink($f->getPathname());
		}
	}
	rmdir($dir);
}

obliterate_directory('/tmp/junk');

?>
<?php 
/*

!!DIRECTORIES - PROCESSING ALL FILES IN A DIRECTORY RECURSIVELY!!

> You want to do something to all the files in a directory and in any subdirectories. 
	>> you want to see how much disk space is consumed by all the files under a directory.

> Use a RecursiveDirectoryIterator and a RecursiveIteratorIterator. The RecursiveDirectoryIterator 
extends the DirectoryIterator with a getChildren() method that provides access to the elements in a 
subdirectory. The RecursiveIteratorIterator flattens the hierarchy that the RecursiveDirectoryIterator 
returns into one list

*/


/*Count the total size of files under a directory*/
$dir = new RecursiveDirectoryIterator('/usr/local');
$totalSize = 0;

foreach (new RecursiveIteratorIterator($dir) as $file) {
	$totalSize += $file->getSize();
}
print "The total size is $totalSize.\n";

?>
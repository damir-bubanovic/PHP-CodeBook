<?php 
/*

!!DELETE FILES IN DIRECTORY!!

*array_map - applies the callback to the elements of the given arrays
	> array array_map ( callable $callback , array $array1 [, array $... ] )
	> returns an array containing all the elements of array after applying the callback FUNCTION to each one
*unlink - deletes a file
	> bool unlink ( string $filename [, resource $context ] )
*glob - find pathnames matching a pattern
	> array glob ( string $pattern [, int $flags = 0 ] )
		> $flag:
			GLOB_MARK - Adds a slash to each directory returned
			GLOB_NOSORT - Return files as they appear in the directory (no sorting). When this flag is not used, the pathnames are sorted alphabetically
			GLOB_NOCHECK - Return the search pattern if no files matching it were found
			GLOB_NOESCAPE - Backslashes do not quote metacharacters
			GLOB_BRACE - Expands {a,b,c} to match 'a', 'b', or 'c'
			GLOB_ONLYDIR - Return only directory entries which match the pattern
			GLOB_ERR - Stop on read errors (like unreadable directories), by default errors are ignored
	> glob() function searches for all the pathnames matching pattern according to the rules used by the libc glob() function
	

*/

/*delete all files in a directory matching a pattern*/
array_map('unlink', glob("some/dir/*.txt"));


/*delete all files of a particular extension, or infact, delete all with wildcard, a much simplar way is to use the glob function, say I wanted to delete all jpgs*/
foreach (glob("*.jpg") as $filename) {
	print "$filename size " . filesize($filename) . "\n";
	unlink($filename);
}
?>
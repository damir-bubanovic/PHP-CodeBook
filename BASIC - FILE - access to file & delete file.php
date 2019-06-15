<?php
/*

!!ACCESS TO FILE & DELETE IT!!

*file_exists - checks whether a file or directory exists
	> bool file_exists ( string $filename )
	> $filename -> Path to the file or directory
		> On windows, use //computername/share/filename or \\computername\share\filename to check files on network shares
	> ALERT <
		This function returns FALSE for files inaccessible due to safe mode restrictions. 
		However these files still can be included if they are located in safe_mode_include_dir
*touch - sets access and modification time of file
	> bool touch ( string $filename [, int $time = time() [, int $atime ]] )
	> Attempts to set the access and modification times of the file named in the filename parameter to the value given in time. 
	> Note that the access time is always modified, regardless of the number of parameters.
*unlink - deletes a file
	> bool unlink ( string $filename [, resource $context ] )

*/

$file = 'marko.pdf';

if(file_exists($file)) {
	print $file . ' does exist.<br />';
} else {
	print $file . ' does not exist.<br />';
	
	touch($file);
	/*OR*/
	unlink($file);
}
?>
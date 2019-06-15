<?php 
/*

!!SORT LIST OF FILES INTO REVERSED ORDER BASED ON THEIR MODIFICATION DATE!!

*is_dir - tells whether the filename is a directory
*opendir - open directory handle
*readdir - read entry from directory handle
*preg_match - perform a regular expression match
*filemtime - gets file modification time
*array_merge - merge one or more arrays
*rsort - sort an array in reverse order
*list - assign variables as if they were an array
*each - return the current key and value pair from an array and advance the array cursor
*file - reads entire file into an array
*closedir - close directory handle
*$_SERVER - server and execution environment information - array containing information such as headers, paths, and script locations

*/

function display_content($dir, $ext) {
	$f = array();
	
	if(is_dir($dir)) {
		if($dh = opendir($dir)) {
			while(($folder = readdir($dh)) !== false) {
				if(preg_match("/\s*$ext$/", $folder)) {
					$fullpath = "$dir/$folder";
					$mtime = filemtime($fullpath);
					
					$ff = array($mtime => $fullpath);
					$f = array_merge($f, $ff);
				}
			}
			rsort($f, SORT_NUMERIC);
			
			while(list($key, $val) = each($f)) {
				$fcontents = file($var, 'r');
				while(list($key, $val) = each($fcontents)) {
					print "$val\n";
				}
			}
		}
	}
	closedir($dh);
}
/*display_content("folder","extension");*/



/*Simpler way*/
$path = $_SERVER[DOCUMENT_ROOT] . "/files/";
$dh = @opendir($path);

while(false !== ($file = readdir($dh))) {
	if(substr($file, 0, 1) != '.') {
		$files = array(filemtime($path . $file), $file);	#2-D array
	}
}
closedir($dh);

if($files) {
	rsort($files); // sorts by filemtime
	// done! Show the files sorted by modification date
	foreach($files as $file) {
		print "$file[0] $file[1]<br>\n";	// file[0]=Unix timestamp; file[1]=filename
	}
}
?>
<?php 
/*

!!FILES - READING A FILE INTO A STRING!!

> You want to load the entire contents of a file into a variable. 
	>> npr. you want to determine if the text in a file matches a regular expression


*file_get_contents - reads entire file into a string
*preg_match - perform a regular expression match
*is_readable - tells whether a file exists and is readable
*filemtime - gets file modification time
*time - return current Unix timestamp
*header - send a raw HTTP header
*filesize - gets file size
*readfile - outputs a file
*error_log - send an error message to the defined error handling routines

*/


/*Use file_get_contents()*/
$people = file_get_contents('people.txt');

if(preg_match('/Names:.*(David|Susannah)/i', $people)) {
	print "people.txt matches.";
}



/*
if you just want to print the entire contents of a file use
	1) fpassthru($fh), which prints everything left on the filehandle $fh and then closes it. 
	2) readfile($filename), prints the entire contents of $filename
*/

/*You can use readfile() to implement a wrapper around images that shouldn’t always
be displayed. This program makes sure a requested image is less than a week old*/
$image_directory = '/usr/local/images';

if(preg_match('/^[a-zA-Z0-9]+\.(gif|jpe?g)$/', $image, $matches) &&
is_readable($image_directory . "/$image") && 
(filemtime($image_directory . "/$image") >= (time() - 86400 * 7))) {
	header('Content-Type: image/' . $matches[1]);
	header('Content-Length: ' . filesize($image_directory."/$image"));
	readfile($image_directory . "/$image");
} else {
	error_log("Can't serve image: $image");
}

?>
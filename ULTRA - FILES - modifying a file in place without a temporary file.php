<?php 
/*

!!FILES - MODIFYING A FILE IN PLACE WITHOUT A TEMPORARY FILE!!

> You want to change a file without using a temporary file to hold the changes

*file_get_contents - Reads entire file into a string
*strtoupper - Make a string uppercase
*file_put_contents - Write a string to a file
*preg_replace - Perform a regular expression search and replace
*filesize - gets file size
*fseek - seeks on a file pointer
*fgets - gets line from file pointer
*ftell - returns the current position of the file read/write pointer
*fwrite - binary-safe file write
*ftruncate - truncates a file to a given length
*fclose - closes an open file pointer

*/


/*Read the file with file_get_contents(), make the changes, and rewrite the 
file with file_put_contents()*/
$contents = file_get_contents('pickles.txt');
$contents = strtoupper($contents);
file_put_contents('pickles.txt', $contents);



/*This example turns text emphasized with asterisks or slashes into text with 
HTML <b> or <i> tags*/
$contents = file_get_contents('message.txt');
// convert *word* to <b>word</b>
$contents = preg_replace('@\*(.*?)\*@i','<b>$1</b>',$contents);
// convert /word/ to <i>word</i>
$contents = preg_replace('@/(.*?)/@i','<i>$1</i>',$contents);
file_put_contents('message.txt', $contents);



/*This converts text marked with <b> and <i> to text marked with asterisks and slashes*/
$fh = fopen('message.txt', 'r+') or die($php_errormsg);

// figure out how many bytes to read
$bytes_to_read = filesize('message.txt');

// initialize variables that hold file positions
$next_read = $last_write = 0;

// keep going while there are still bytes to read
while ($next_read < $bytes_to_read) {
	
	/*move to the position of the next read, read a line, and save the position of the next read */
	fseek($fh,$next_read);
	$s = fgets($fh) or die($php_errormsg);
	$next_read = ftell($fh);
	
	// convert <b>word</b> to *word*
	$s = preg_replace('@<b[^>]*>(.*?)</b>@i', '*$1*', $s);
	
	// convert <i>word</i> to /word/
	$s = preg_replace('@<i[^>]*>(.*?)</i>@i', '/$1/', $s);
	
	/*move to the position where the last write ended, write the onverted line, and save the position for the next write*/
	fseek($fh,$last_write);
	if (-1 == fwrite($fh,$s)) { 
		die($php_errormsg); 
	}
	$last_write = ftell($fh);
}

// truncate the file length to what we've already written
ftruncate($fh,$last_write) or die($php_errormsg);

// close the file
fclose($fh) or die($php_errormsg);

?>
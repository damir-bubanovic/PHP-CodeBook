<?php 
/*

!!FILES - CREATING A TEMPORARY FILE!!

> You need a file to temporarily hold some data

*tmpfile - creates a temporary file
*fputs - binary-safe file write - use fwrite instead
*strftime - format a local time/date according to locale settings
*tempnam - create file with unique file name
*fopen - opens file or URL
*fclose - closes an open file pointer

*/


/*If the file needs to last only the duration of the running script, use tmpfile()*/
$temp_fh = tmpfile();
// write some data to the temp file
fputs($temp_fh, "The current time is " . strftime('%c'));
// the file goes away when the script ends
exit(1);


/*If the file needs to last longer, generate a filename with tempnam(), and then use fopen()*/
$tempfilename = tempnam('/tmp', 'data-');
$temp_fh = fopen($tempfilename, 'w') or die($php_errormsg);
fputs($temp_fh, "The current time is " . strftime('%c'));
fclose($temp_fh) or die($php_errormsg);



/*Alternatively, tempnam() generates a filename. It takes two arguments: the first is a
directory, and the second is a prefix for the filename*/
$tempfilename = tempnam('/tmp','data-');
print "Temporary data will be stored in $tempfilename";

?>
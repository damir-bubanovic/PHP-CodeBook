<?php 
/*

!!FILES - READING FROM STANDARD INPUT!!

> You want to read from standard input in a command-line context
	>> npr. to get user input from the keyboard or data piped to your PHP program

*fopen - opens file or URL

*/


/*Use fopen() to open php://stdin*/
$fh = fopen('php://stdin', 'r') or die($php_errormsg);
while($s = fgets($fh)) {
	print "You typed: $s";
}

?>
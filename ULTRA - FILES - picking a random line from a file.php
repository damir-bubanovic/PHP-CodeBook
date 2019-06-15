<?php 
/*

!!FILES - PICKING A RANDOM LINE FROM A FILE!!

> You want to pick a line at random from a file
	>> npr. you want to display a selection from a file of sayings

*fopen - opens file or URL
*feof - tests for end-of-file on a file pointer
*fgets - gets line from file pointer
*mt_rand - generate a better random value
*fclose - closes an open file pointer

*/


/*Spread the selection odds evenly over all lines in a file*/
$line_number = 0;

$fh = fopen(__DIR__ . '/sayings.txt', 'r') or die($php_errormsg);
while(!feof($fh)) {
	if($s = fgets($fh)) {
		$line_number++;
		
		if(mt_rand(0, $line_number - 1) == 0) {
			$line = $s;
		}
	}
}
fclose($fh) or die($php_errormsg);

?>
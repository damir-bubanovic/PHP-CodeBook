<?php 
/*

!!FILES - COUNTING LINES, PARAGRAPHS OR RECORDS IN A FILE!!

> You want to count the number of lines, paragraphs, or records in a file

*fopen - opens file or URL
*feof - tests for end-of-file on a file pointer
*fgets - gets line from file pointer
*rtrim - strip whitespace (or other characters) from the end of a string
*preg_split - split string by a regular expression
*array_pop - pop the element off the end of array
*stream_get_line - gets line from stream resource up to a given delimiter

*/


/*To count lines, use fgets()*/
$lines = 0;

if($fh = fopen('orders.txt', 'r')) {
	while(!feof($fh)) {
		if(fgets($fh)) {
			$lines++;
		}
	}
}
print $lines;


/*To count paragraphs, increment the counter only when you read a blank line*/
$paragraphs = 0;

if($fh = fopen('great-american-novel.txt','r')) {
	while(!feof($fh)) {
		$s = fgets($fh);
		
		if(("\n" == $s) || ("\r\n" == $s)) {
			$paragraphs++;
		}
	}
}
print $paragraphs;


/*To count records, increment the counter only when the line read contains just the record
separator and whitespace. Here the record separator is stored in $record_separator*/
$records = 0;
$record_separator = '--end--';

if($fh = fopen('great-american-textfile-database.txt', 'r')) {
	while(!feof($fh)) {
		$s = rtrim(fgets($fh));
		
		if($s == $record_separator) {
			$records++;
		}
	}
}
print $records;



/*When counting paragraphs, the solution works properly on simple text but may produce
unexpected results when presented with a long string of blank lines or a file without
two consecutive line breaks. These problems can be remedied with functions based on
preg_split(). If the file is small and can be read into memory, use the split_para
graphs() function. This function returns an array containing each paragraph in the file*/
function split_paragraphs($file, $rs = "\r?\n") {
	$text = file_get_contents($file);
	$matches = preg_split("/(.*?$rs)(?:$rs)+/s", $text, -1, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
	return $matches;
}


/*If the file is too big to read into memory at once, use the split_paragraphs_large
file() function, which reads the file in 16 KB chunks*/
function split_paragraphs_largefile($file, $rs = "\r?\n") {
	global $php_errormsg;
	
	$unmatched_text = '';
	$paragraphs = array();
	
	$fh = fopen($file,'r') or die($php_errormsg);
	
	while(! feof($fh)) {
		$s = fread($fh,16384) or die($php_errormsg);
		$text_to_split = $unmatched_text . $s;
		$matches = preg_split("/(.*?$rs)(?:$rs)+/s", $text_to_split, -1, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
		
		// if the last chunk doesn't end with two record separators, save it to prepend to the next section that gets read
		$last_match = $matches[count($matches)-1];
		if(!preg_match("/$rs$rs\$/", $last_match)) {
			$unmatched_text = $last_match;
			array_pop($matches);
		} else {
			$unmatched_text = '';
		}
	
		$paragraphs = array_merge($paragraphs,$matches);
	}
	
	// after reading all sections, if there is a final chunk that doesn't end with the record separator, count it as a paragraph
	if($unmatched_text) {
		$paragraphs[] = $unmatched_text;
	}
	
	return $paragraphs;
}



/*The record-counting function lets fgets() figure out how long each line is. 
	>> If you can supply a reasonable upper bound on line length, stream_get_line() provides a 
	more concise way to count records. 
	>> This function reads a line until it reaches a certain number of bytes or it sees a particular
	delimiter. 
	>> Supply it with the record separator as the delimiter,*/
$records = 0;
$record_separator = '--end--';

if($fh = fopen('great-american-textfile-database.txt', 'r')) {
	$done = false;
	
	while(!$done) {
		$s = stream_get_line($fh, 65536, $record_separator);
		
		if(feof($fh)) {
			$done = true;
		} else {
			$records++;
		}
	}
}
print $records;

?>
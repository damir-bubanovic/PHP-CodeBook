<?php 
/*

!!FILES - PROCESSING EVERY WORD IN A FILE!!

> You want to do something with every word in a file. 
	>> npr. you want to build a concordance of how many times each word is 
	used to compute similarities between documents

*fopen - opens file or URL
*feof - tests for end-of-file on a file pointer
*fgets - gets line from file pointer
*preg_split - split string by a regular expression
*fclose - closes an open file pointer
*strlen - get string length

*/


/*Read in each line with fgets(), separate the line into words, and process each word*/
$fh = fopen('great-american-novel.txt', 'r') or die($php_errormsg);

while(!feof($fh)) {
	if($s = fgets($fh)) {
		$words = preg_split('/\s+/', $s, -1, PREG_SPLIT_NO_EMPTY);
		// process words
	}
}
fclose($fh) or die($php_errormsg);


/*This example calculates the average word length in a file*/
$word_count = $word_length = 0;

if($fh = fopen('great-american-novel.txt', 'r')) {
	while(!feof($fh)) {
		if($s = fgets($fh)) {
			$words = preg_split('/\s+/', $s, -1, PREG_SPLIT_NO_EMPTY);
			
			foreach($words as $word) {
				$word_count++;
				$word_length += strlen($word);
			}
		}
	}
}
print sprintf("The avarage word length over %d words is %.02f characters.", $word_count, $word_length / $word_count);

?>
<?php 
/*

!!TRIM A STRING DOWN TO A CERTAIN NUMBER OF WORDS!!

*str_replace - replace all occurrences of the search string with the replacement string
*explode - split a string by string
*trim - strip whitespace (or other characters) from the beginning and end of a string
*str_word_count - return information about words used in a string, counts the number of words inside string

*/


/*ALERT - NOT WORKING!*/
/*trim a $string down to a certian number of words, and add a...   on the end of it*/
function trim_text($text, $count) {
	$text = str_replace('  ', ' ', $text);
	$string = explode(' ', $text);
	
	for($word_counter = 0; $word_counter <= $count; $word_counter++) {
		$trimmed .= $string[$word_counter];
		if($word_counter < $count) {
			$trimmed .= ' ';
		} else {
			$trimmed .= '...';
		}
	}
	$trimmed = trim($trimmed);
	return $trimmed;
}



/*ALERT - WORKING SO / SO */
$string = 'Moja marina je veliki medo, ponekada je stvarno gladna i šljumpava i također nema puno godina!';

$string_to_array = explode(' ', $string);

$word_start = 0;
$word_end = 5;

$word_in_string = str_word_count($string);

if($word_in_string < $word_end) {
	for($word_count = $word_start; $word_count < $word_in_string; $word_count++) {
		print $trimmed = $string_to_array[$word_count] . ' ';
	}
	print $dots = '';
} else {
	for($word_count = $word_start; $word_count < $word_end; $word_count++) {
		print $trimmed = $string_to_array[$word_count] . ' ';
	}
	print $dots = '...';
};
?>
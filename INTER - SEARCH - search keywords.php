	<!--LOOK / USE WITH _SEARCH - custom search and sort data.php, INTER - SEARCH search based on user keywords.php-->

<?php 
/*

!!SEARCH BASED ON USER KEYWORDS!!

*str_replace - replace all occurrences of the search string with the replacement string 
*explode - split a string by string
*count - count all elements in an array, or something in an object

*/

/*Extract the search keywords into an array & replace , with spaces for better execution of explode function*/
$clean_search = str_replace(',', ' ', $user_search);
/*explode - put keywords into array*/
$search_words = explode(' ', $clean_search);
$final_search_words = array();
/*if there are search words*/
if (count($search_words) > 0) {
	/*Search each element of search words*/	
	foreach ($search_words as $word) {
		/*if element is not empty tj. $words*/  
		if (!empty($word)) {
			/*put non empty $words in $final_search_words array*/	
			$final_search_words[] = $word;
		}
	}
}

?>
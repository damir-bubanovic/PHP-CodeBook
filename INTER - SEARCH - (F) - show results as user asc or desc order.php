	<!--USE with _BASIC - user order hyperlinks.php-->
	<!--LOOK / USE WITH _SEARCH - custom search and sort data.php, INTER - SEARCH search based on user keywords.php, INTER - SEARCH - search keywords.php-->

<?php
/*

!!USER - ASC or DESC ORDER!!

*str_replace - replace all occurrences of the search string with the replacement string 
*explode - split a string by string
*count - count all elements in an array, or something in an object
*implode - join array elements with a string

*/


// This function builds a search query from the search keywords and sort setting
function build_query($user_search, $sort) {
    $search_query = "SELECT * FROM riskyjobs";

    /*Extract the search keywords into an array*/
	/*str_replace - replace , for better execution of explode function*/
    $clean_search = str_replace(',', ' ', $user_search);
	/*explode - put keywords into array*/
    $search_words = explode(' ', $clean_search);
    $final_search_words = array();
	/*if there are search words*/
	if (count($search_words) > 0) {
		/*Search each element of search words*/	
		foreach ($search_words as $word) {
			/*if there are non empty elements tj. $words*/  
			if (!empty($word)) {
				/*put non empty words in $final_search_words array*/	
				$final_search_words[] = $word;
			}
		}
    }

    /*Generate a WHERE clause using all of the search keywords*/
    $where_list = array();
	/*$final_search_words contains no empty elements - see code above*/
    if (count($final_search_words) > 0) {
		foreach($final_search_words as $word) {
			$where_list[] = "description LIKE '%$word%'";
		}
    }
	/*implode words so it searches with words with OR - for MySQL query*/
    $where_clause = implode(' OR ', $where_list);

    // Add the keyword WHERE clause to the search query
    if (!empty($where_clause)) {
		$search_query .= " WHERE $where_clause";
    }

    /*Sort the search query using the sort setting*/
	/*Switch statement checks the value of $sort and adds the coresponding 
	ORDER by statement at the end of the search query*/
    switch ($sort) {
    // Ascending by job title
    case 1:
		$search_query .= " ORDER BY title";
		break;
    // Descending by job title
    case 2:
		$search_query .= " ORDER BY title DESC";
		break;
    // Ascending by state
    case 3:
		$search_query .= " ORDER BY state";
		break;
    // Descending by state
    case 4:
		$search_query .= " ORDER BY state DESC";
      	break;
    // Ascending by date posted (oldest first)
    case 5:
      	$search_query .= " ORDER BY date_posted";
      	break;
    // Descending by date posted (newest first)
    case 6:
      	$search_query .= " ORDER BY date_posted DESC";
      	break;
    default:
      // No sort setting provided, so don't sort the query
	  /*When the user first loads the results $sort will be empty (default)*/
    }
	/*Return query to see results*/
    return $search_query;
}
  ?>
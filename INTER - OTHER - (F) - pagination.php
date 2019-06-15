	<!--LOOK / USE WITH _SEARCH - custom search and sort data.php-->
	<!--USE with _BASIC - user asc or desc order.php, _BASIC - user order hyperlinks.php-->

<?php 
/*

!!PAGINATION!!

> function generate_page_links builds navigational page links based on the current page and the number of pages
*$_SERVER - array containing information such as headers, paths, and script locations
*$_GET - associative array of variables passed to the current script via the URL parameters
*isset - determine if a variable is set and is not NULL
*http_build_query - generates a URL-encoded query string from the associative (or indexed) array provided
*mysqli_num_rows - returns the number of rows in the result set
*ceil - rounds a number up to the nearest integer - the ceiling
*mysqli_fetch_array - fetch a result row as an associative array, a numeric array, or both

*/


function generate_page_links($user_search, $sort, $cur_page, $num_pages) {
	$page_links = '';

    /*If this page is not the first page, generate the "previous" link*/
    if($cur_page > 1) {
	  /*We still have to pass along the user search data and the sort order in each link URL.*/
      $page_links .= '<a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . ($cur_page - 1) . '"><-</a> ';
    } else {
	  /*The “previous” link appears as a left arrow, as in “<-”.*/
      $page_links .= '<- ';
    }

    /*Loop through the pages generating the page number links*/
    for ($i = 1; $i <= $num_pages; $i++) {
		if ($cur_page == $i) {
			$page_links .= ' ' . $i;
		} else {
			/*Make sure each page link points back to the same script - we’re just passing a different page number with each link.*/
			/*The link to a specific page is just the page number.*/
			$page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . $i . '"> ' . $i . '</a>';
		}
    }

    /*If this page is not the last page, generate the "next" link*/
    if ($cur_page < $num_pages) {
		$page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . ($cur_page + 1) . '">-></a>';
    } else {
		/*The “next” link appears as a right arrow, as in “->”.*/
		$page_links .= ' ->';
    }

    return $page_links;
}

/*Grab the sort setting and search keywords from the URL using GET*/
/*Get the sort order which is an integer in the range 1 - 6*/
$sort = $_GET['sort'];
/*Grab the search string that the user entered into the form*/
$user_search = $_GET['usersearch'];

/*Calculate pagination information*/
/*Get the current page, $cur_page from the URL via GET. If there’s no current page, set $cur_page to 1.*/
/*Default to the first page if the page number isn’t set (number 1).*/
/*Initialize the pagination variables since we’ll need them in a moment to LIMIT the query and build the pagination links.*/
$cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
/*Set the number of results per page*/
$results_per_page = 5;  // number of results per page
/*Compute the number of the first row on the page, $skip.*/
/*This calculation results in 0 for page 1, 5 for page 2, 10 for page 3, etc.*/
$skip = (($cur_page - 1) * $results_per_page);
  
  
  
	/*Database connection*/
  	......
  
  	/*Query to get the total results*/
  	/*This query retrieves all the rows with no LIMIT.*/
  	$query = build_query($user_search, $sort); /*Ovo bi trebalo biti http_build_query*/
  	$result = mysqli_query($dbc, $query);
 	/*mysqli_num_rows() returns a count of how many total rows were returned by the query.*/
  	/*Store away the total number of rows with a call to the mysqli_num_rows() function.*/
  	$total = mysqli_num_rows($result);
  	/*Compute number of pages by dividing the total number of rows by the number of results per page, and then rounding up the result.*/
  	$num_pages = ceil($total / $results_per_page);
  
  	/*Query again to get just the subset of results*/
  	/*$skip - Skip this many rows...*/
  	/*$results_per_page - ...and return this many rows.*/
  	$query =  $query . " LIMIT $skip, $results_per_page";
  	/*Issue a second query, but this time LIMIT the results to the current page.*/
  	$result = mysqli_query($dbc, $query);
  	while ($row = mysqli_fetch_array($result)) {
		/*Generate table*/
		.....
	} print '</table>';
  
	/*Generate navigational page links if we have more than one page*/
  	/*First check to make sure there is more than one page of search results; otherwise, don’t generate the page links*/
	if ($num_pages > 1) {
		/*Pass along the search string, sort order, current page, and total number of pages to use in generating the page links.*/  
    	print generate_page_links($user_search, $sort, $cur_page, $num_pages);
	}
  
	/*Close database connection*/
	......
?>
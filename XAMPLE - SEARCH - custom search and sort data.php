	<!--USE with _BASIC - user asc or desc order.php, _BASIC - user order hyperlinks.php, _BASIC - pagination.php, 
	BASIC - VAR - show only part of text.php, _BASIC - SEARCH_keywords.php, _BASIC - SEARCH_based on user keywords.php-->

<?php
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

    // Sort the search query using the sort setting
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

  /*This function builds heading links based on the specified sort setting*/
  /*Transform HTML headers of colums into links (hyper-links) for sorting data*/
  /*in generate_sort_links function we are passing 2 arguments = $user_search and $sort*/
  function generate_sort_links($user_search, $sort) {
	/*default - empty string*/  
    $sort_links = '';

    switch ($sort) {
    case 1:
	  /*PHP_SELF - reload the page when user clicks hyper-link (self referencing form)*/
	  /*build_query() function needs the user’s search keywords to display results*/
	  /*We pass along sort data to indicate the desired sorting of the search. Since this is the job title link, “sort” is equal to 2.*/
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=2">Job Title</a></td><td>Description</td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">State</a></td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=5">Date Posted</a></td>';
      break;
    case 3:
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Job Title</a></td><td>Description</td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=4">State</a></td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">Date Posted</a></td>';
      break;
    case 5:
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Job Title</a></td><td>Description</td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">State</a></td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=6">Date Posted</a></td>';
      break;
    default:
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Job Title</a></td><td>Description</td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">State</a></td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=5">Date Posted</a></td>';
    }
	/*Return to see results - show links*/
    return $sort_links;
  }

  // This function builds navigational page links based on the current page and the number of pages
  function generate_page_links($user_search, $sort, $cur_page, $num_pages) {
    $page_links = '';

    // If this page is not the first page, generate the "previous" link
    if ($cur_page > 1) {
      $page_links .= '<a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . ($cur_page - 1) . '"><-</a> ';
    }
    else {
      $page_links .= '<- ';
    }

    // Loop through the pages generating the page number links
    for ($i = 1; $i <= $num_pages; $i++) {
      if ($cur_page == $i) {
        $page_links .= ' ' . $i;
      }
      else {
        $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . $i . '"> ' . $i . '</a>';
      }
    }

    // If this page is not the last page, generate the "next" link
    if ($cur_page < $num_pages) {
      $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . ($cur_page + 1) . '">-></a>';
    }
    else {
      $page_links .= ' ->';
    }

    return $page_links;
  }

  /*Grab the sort setting and search keywords from the URL using GET*/
  $sort = $_GET['sort'];
  $user_search = $_GET['usersearch'];

  // Calculate pagination information
  $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $results_per_page = 5;  // number of results per page
  $skip = (($cur_page - 1) * $results_per_page);

  /*Start generating the table of results*/
  echo '<table border="0" cellpadding="2">';

  /*Generate the search result headings*/
  echo '<tr class="heading">';
  echo generate_sort_links($user_search, $sort);
  echo '</tr>';

  /*Connect to the database*/
  require_once('connectvars.php');
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Query to get the total results 
  $query = build_query($user_search, $sort);
  $result = mysqli_query($dbc, $query);
  $total = mysqli_num_rows($result);
  $num_pages = ceil($total / $results_per_page);

  /*Query again to get just the subset of results*/
  $query =  $query . " LIMIT $skip, $results_per_page";
  $result = mysqli_query($dbc, $query);
  while ($row = mysqli_fetch_array($result)) {
    echo '<tr class="results">';
    echo '<td valign="top" width="20%">' . $row['title'] . '</td>';
	/*We are using substring to show only part of the job description, not all, for the purpuses of easy viewing*/
	/*substring - string, start point, end point*/
    echo '<td valign="top" width="50%">' . substr($row['description'], 0, 100) . '...</td>';
    echo '<td valign="top" width="10%">' . $row['state'] . '</td>';
	/*We are using substring to show the date, MM-DD-YYYY, which takes up exactly 10 characters*/
    echo '<td valign="top" width="20%">' . substr($row['date_posted'], 0, 10) . '</td>';
    echo '</tr>';
  } 
  echo '</table>';

  /*Generate navigational page links if we have more than one page*/
  /*First check to make sure there is more than one page of search results; otherwise, don’t generate the page links*/
  if ($num_pages > 1) {
	/*Pass along the search string, sort order, current page, and total number of pages to use in generating the page links.*/  
    echo generate_page_links($user_search, $sort, $cur_page, $num_pages);
  }

  mysqli_close($dbc);
?>
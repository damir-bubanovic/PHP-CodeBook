	<!--LOOK / USE WITH _SEARCH - custom search and sort data.php, INTER - SEARCH - search keywords.php-->

<?php
/*

!!SEARCH BASED ON USER KEYWORDS!!

*$_GET - associative array of variables passed to the current script via the URL parameters
*mysqli_fetch_array - fetch a result row as an associative array, a numeric array, or both

*/

	/*Grab the search keywords from the URL using GET*/
  	$user_search = $_GET['usersearch'];

  	/*Start generating the table of results*/
  	...	

  	/*Connect to the database*/
  	...

  	/*Query to get the results*/
  	/*$user_search - variable of user input data/keyword*/
  	/*WHERE = - means 2 results must be identical to each other*/
  	$query = "SELECT * FROM riskyjobs WHERE title = '$user_search'";
  	$result = mysqli_query($dbc, $query);
  	while ($row = mysqli_fetch_array($result)) {
    	print '<tr class="results">';
    	print '<td valign="top" width="20%">' . $row['title'] . '</td>';
    	print '<td valign="top" width="50%">' . $row['description'] . '</td>';
    	print '</tr>';
 	 } 
  	echo '</table>';

  	/*Close database*/
	...

?>
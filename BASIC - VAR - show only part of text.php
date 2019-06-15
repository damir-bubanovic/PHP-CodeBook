	<!--LOOK / USE WITH _SEARCH - custom search and sort data.php-->

<?php
/*

!!SHOW ONLY PART OF TEXT!!

*substr - return part of a string
	> string substr ( string $string , int $start [, int $length ] )
	> returns the portion of string specified by the start and length parameters

*/

/*Query again to get just the subset of results*/
$query =  $query . " LIMIT $skip, $results_per_page";
$result = mysqli_query($dbc, $query);
while ($row = mysqli_fetch_array($result)) {
	print '<tr class="results">';
    print '<td valign="top" width="20%">' . $row['title'] . '</td>';
	/*We are using substring to show only part of the job description, not all, for the purpuses of easy viewing*/
    print '<td valign="top" width="50%">' . substr($row['description'], 0, 100) . '...</td>';
    print '<td valign="top" width="10%">' . $row['state'] . '</td>';
	/*We are using substring to show the date, MM-DD-YYYY, which takes up exactly 10 characters*/
    print '<td valign="top" width="20%">' . substr($row['date_posted'], 0, 10) . '</td>';
    print '</tr>';
} 
print '</table>';

?>
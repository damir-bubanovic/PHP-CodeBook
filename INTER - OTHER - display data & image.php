<?php
/*

!!DISPLAY SCORE DATA!!

*GW_UPLOADPATH - constant for upload path

*/


/*Display score data with images in table, you can display anything*/
$query = "SELECT * FROM guitarwars ORDER BY score DESC, date ASC";
$data = mysqli_query($dbc, $query);

print '<table>';
$i = 0;
while ($row = mysqli_fetch_array($data)) { 
	// Display the score data
	/*Displaying the top score user in our database*/
    if ($i == 0) {
    	print '<tr><td colspan="2" class="topscoreheader">Top Score: ' . $row['score'] . '</td></tr>';
    }
	/*Displaying with "secondary table"*/
    print '<tr><td class="scoreinfo">';
    print '<span class="score">' . $row['score'] . '</span><br />';
    print '<strong>Name:</strong> ' . $row['name'] . '<br />';
	/*Display image if screenshot actually exists*/
    if (is_file(GW_UPLOADPATH . $row['screenshot']) && filesize(GW_UPLOADPATH . $row['screenshot']) > 0) {
      	print '<td><img src="' . GW_UPLOADPATH . $row['screenshot'] . '" alt="Score image" /></td></tr>';
    }
    else {
     	print '<td><img src="' . GW_UPLOADPATH . 'unverified.gif' . '" alt="Unverified score" /></td></tr>';
    }
	/*Incrementing the counter for score loop*/
    $i++;
}
print '</table>';
?>
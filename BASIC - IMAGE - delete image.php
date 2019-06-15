<?php
/*

!!DELETE IMAGE!!

*isset - variable set & not NULL
	> can use var_dump() for more information about a variable 
	> return true
	> isset() only works with variables as passing anything else will result in a error
	> for checking if constants are set use the defined() function
*unlink - deletes a file
	> bool unlink ( string $filename [, resource $context ] )
> DB_HOST, DB_USER, DB_PASSWORD, DB_NAME -> database constant values

*/


if(isset($_POST['submit'])) {
	/*If confirm button is pressed, we confirmed deletion, if radio button yes is selected*/
    if($_POST['confirm'] == 'Yes') {
		
		// Delete the screen shot image file from the server, from images folder
		@unlink(GW_UPLOADPATH . $screenshot);

		// Connect to the database
      	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

      	// Delete the score data from the database, most precise is to delete specific unique id
	  	/*Limiting deletion of 1 single row of data*/
      	$query = "DELETE FROM guitarwars WHERE id = $id LIMIT 1";
      	mysqli_query($dbc, $query);
      	mysqli_close($dbc);

      	// Confirm success with the user
      	print '<p>The high score of ' . $score . ' for ' . $name . ' was successfully removed.';
	} else {
		print '<p class="error">The high score was not removed.</p>';
    }
}
?>
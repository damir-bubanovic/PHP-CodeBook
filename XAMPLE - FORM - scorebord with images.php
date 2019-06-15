<h2>Guitar Wars - High Scores</h2>
<?php
if (isset($_POST['submit'])) {
	// Grab the score data from the POST
	/*Screen image shot obtained from form POST data*/
	$name = $_POST['name'];
	$score = $_POST['score'];
	/*Validate to make shure image filename is not empty*/
	if (!empty($name) && !empty($score)) {
		// Connect to the database
		$dbc = mysqli_connect('www.guitarwars.net', 'admin', 'rockit', 'gwdb');
		// Write the data to the database
		/*Inserting image filename into guitarwars table*/
		$query = "INSERT INTO guitarwars VALUES (0, NOW(), '$name', '$score')";
		
		mysqli_query($dbc, $query);
		// Confirm success with the user
			echo '<p>Thanks for adding your new high score!</p>';
			echo '<p><strong>Name:</strong> ' . $name . '<br />';
			echo '<strong>Score:</strong> ' . $score . '</p>';
			echo '<p><a href="index.php">&lt;&lt; Back to high scores</a></p>';
		// Clear the score data to clear the form
		/*Upon sucess make shure image field form gets cleared*/
		$name = "";
		$score = "";
		
		mysqli_close($dbc);
		}
	else {
		echo '<p class="error">Please enter all of the information to add ' .
		'your high score.</p>';
	}
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<!-- <input> tag for image file selection -->
    <label for="name">Name:</label><input type="text" id="name" name="name"
    	value="<?php if (!empty($name)) echo $name; ?>" /><br />
    <label for="score">Score:</label><input type="text" id="score" name="score"
   		value="<?php if (!empty($score)) echo $score; ?>" />
    <hr />
    <input type="submit" value="Add" name="submit" />
</form>
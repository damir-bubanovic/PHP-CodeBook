<?php 
/*HTML authentification*/
require_once('authorize.php');
?>

	<!--USE WITH SCOREBOARD - show scores.php user insert score.pdf approve score.php remove score.php-->
	<!--LOOK / USE WITH SCOREBOARD - image upload path.php & BASIC - database connection.php & BASIC - user pass HTTP authentification-->

  <h2>Guitar Wars - High Scores Administration</h2>
  <p>Below is a list of all Guitar Wars high scores. Use this page to remove scores as needed.</p>
  <hr />

<?php
  require_once('appvars.php');
  require_once('connectvars.php');

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

  // Retrieve the score data from MySQL
  $query = "SELECT * FROM guitarwars ORDER BY score DESC, date ASC";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of score data, formatting it as HTML 
  echo '<table>';
  while ($row = mysqli_fetch_array($data)) { 
    // Display the score data
    echo '<tr class="scorerow"><td><strong>' . $row['name'] . '</strong></td>';
    echo '<td>' . $row['date'] . '</td>';
    echo '<td>' . $row['score'] . '</td>';
    echo '<td><a href="removescore.php?id=' . $row['id'] . '&amp;date=' . $row['date'] .
      '&amp;name=' . $row['name'] . '&amp;score=' . $row['score'] .
      '&amp;screenshot=' . $row['screenshot'] . '">Remove</a>';
	/*Check to see if the score is unapproved before generating the Approve link*/
	if($row['approved'] == '0') {
		/*This is all passed in the URL link*/
		print '/ <a href="approve.php?id=' . $row['id'] . '&amp;date=' . $row['date'] .
		'&amp;name=' . $row['name'] . '&amp;score=' . $row['score'] .
		'&amp;screenshot=' . $row['screenshot'] . '">Approve</a>';
	}
	print '</td></tr>';
  } echo '</table>';

  mysqli_close($dbc);
?>
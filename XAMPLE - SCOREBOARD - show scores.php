<body>

  <h2>Guitar Wars - High Scores</h2>
  <p>Welcome, Guitar Warrior, do you have what it takes to crack the high score list? If so, just <a href="addscore.php">add your own score</a>.</p>
  <hr />

<?php

	/*USE WITH SCOREBOARD - user insert score.php*/
	/*LOOK / USE WITH SCOREBOARD - image upload path.php & approve score admin.php & BASIC - database connection.php*/
	/*This can be index / first page*/

  /*Set constants like BASIC file upload path and BASIC database connection and put in separate files in include folder*/
  require_once('appvars.php');
  require_once('connectvars.php');

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

  // Retrieve the score data from MySQL
  /*Retrieve all the data from the table*/
  /*Displaying the table ordered by score descending so highest score is on the top!!*/
  /*Where approved - select only data with the approved column that have values of 1 (1 = approved)*/
  $query = "SELECT * FROM guitarwars WHERE approved = 1 ORDER BY score DESC, date ASC";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of score data, formatting it as HTML 
  /*Look out for "primary table" outside displayed rows*/
  echo '<table>';
  $i = 0;
  while ($row = mysqli_fetch_array($data)) { 
    // Display the score data
	/*Displaying the top score user in our database*/
    if ($i == 0) {
      echo '<tr><td colspan="2" class="topscoreheader">Top Score: ' . $row['score'] . '</td></tr>';
    }
	/*Displaying with "secondary table"*/
    echo '<tr><td class="scoreinfo">';
    echo '<span class="score">' . $row['score'] . '</span><br />';
    echo '<strong>Name:</strong> ' . $row['name'] . '<br />';
    echo '<strong>Date:</strong> ' . $row['date'] . '</td>';
	/*Display image if screenshot actually exists*/
    if (is_file(GW_UPLOADPATH . $row['screenshot']) && filesize(GW_UPLOADPATH . $row['screenshot']) > 0) {
      echo '<td><img src="' . GW_UPLOADPATH . $row['screenshot'] . '" alt="Score image" /></td></tr>';
    }
    else {
      echo '<td><img src="' . GW_UPLOADPATH . 'unverified.gif' . '" alt="Unverified score" /></td></tr>';
    }
	/*Incrementing the counter for score loop*/
    $i++;
  }
  echo '</table>';

  mysqli_close($dbc);
?>

</body> 
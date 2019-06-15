<h2>Guitar Wars - Remove a High Score</h2>

<?php

	/*USE WITH - SCOREBOARD - remove score.php*/
	/*THIS IS CONFIRM PAGE FOR SCORE REMOVAL*/

  /*Connection variables and aplication constants max file size and upload path*/
  require_once('appvars.php');
  require_once('connectvars.php');
  
  /*If all data values are present in page (id, date, name, score and screenshot)*/
  /*For admin we use GET method*/
  if (isset($_GET['id']) && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['score']) && 
  isset($_GET['screenshot'])) {
    // Grab the score data from the GET
    $id = $_GET['id'];
    $date = $_GET['date'];
    $name = $_GET['name'];
    $score = $_GET['score'];
    $screenshot = $_GET['screenshot'];
	/*If data values screenshot is missing*/
  } else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['score'])) {
    // Grab the score data from the POST
    $id = $_POST['id'];
    $name = $_POST['name'];
    $score = $_POST['score'];
	/*Values are not specified and we can not delete (needed name and score for deletion)*/
  } else {
    echo '<p class="error">Sorry, no high score was specified for removal.</p>';
  }
  
  /*If submit button is pressed*/
  if (isset($_POST['submit'])) {
	/*If confirm button is pressed, we confirmed deletion, if radio button yes is selected*/
    if ($_POST['confirm'] == 'Yes') {
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
      echo '<p>The high score of ' . $score . ' for ' . $name . ' was successfully removed.';
    }
    else {
      echo '<p class="error">The high score was not removed.</p>';
    }
  }
  /*Confirm message to delete user*/
  /*This message is only showed if all of these high score variables are set*/
  else if (isset($id) && isset($name) && isset($date) && isset($score)) {
    echo '<p>Are you sure you want to delete the following high score?</p>';
    echo '<p><strong>Name: </strong>' . $name . '<br /><strong>Date: </strong>' . $date .
      '<br /><strong>Score: </strong>' . $score . '</p>';
    echo '<form method="post" action="removescore.php">';
	/*Radio buttons yes / no for removal*/
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="submit" value="Submit" name="submit" />';
	/*Hidden values posted from remove user page*/
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="hidden" name="name" value="' . $name . '" />';
    echo '<input type="hidden" name="score" value="' . $score . '" />';
    echo '</form>';
  }
  /*Return link*/
  echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p>';
?>
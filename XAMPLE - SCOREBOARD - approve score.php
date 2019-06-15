<?php 
/*HTML authentification*/
require_once('authorize.php');
?>

	<!--USE WITH SCOREBOARD - show scores.php user insert score.pdf-->
	<!--LOOK / USE WITH SCOREBOARD - image upload path.php & BASIC - database connection.php & BASIC - user pass HTTP authentification-->

<?php
require_once('appvars.php');
require_once('connectvars.php');

  /*Because we are admin we can use GET method to get to data from table and set variables*/
  if (isset($_GET['id']) && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['score'])) {
    // Grab the score data from the GET
    $id = $_GET['id'];
    $date = $_GET['date'];
    $name = $_GET['name'];
    $score = $_GET['score'];
    $screenshot = $_GET['screenshot'];
  }
  else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['score'])) {
    // Grab the score data from the POST
    $id = $_POST['id'];
    $name = $_POST['name'];
    $score = $_POST['score'];
  }
  else {
    echo '<p class="error">Sorry, no high score was specified for approval.</p>';
  }

/*If submit button has been clicked*/
if(isset($_POST['submit'])) {
	/*If confirm (approval) button has been set clicked (set to Yes = 1)*/
	if($_POST['confirm'] == "Yes") {
		/*Connect to the database*/
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
		or die("Can not connect to the database");
		
		/*Update database, approved row for a score to equal 1 (from 0)*/
		/*The ID (person_id) must match in order to carry out the approval*/
		$query = "UPDATE high_scores SET approved = 1 WHERE id = '$id'";
		
		$result = mysqli_query($dbc, $query);
		
		mysqli_close($dbc);
		/*Confirm the sucess with the user showing the approved score and name*/
		print '<p>The high score of' . $score . ' for ' . $name . ' was succesfully approved.</p>';
	} else {
		/*Important to reveal when the score cannot be approved*/
		print '<p class="error">Sorry, there was a problem approving the high score.</p>';
	}
	/*Provide link back to admin page for easy acess*/
	print '<p><a href="admin.php">&lt;&lt Back to admin page</a></p>';
} else if (isset($id) && isset($name) && isset($date) && isset($score)) {
	echo '<p>Are you sure you want to approve the following high score?</p>';
    echo '<p><strong>Name: </strong>' . $name . '<br /><strong>Date: </strong>' . $date .
      '<br /><strong>Score: </strong>' . $score . '</p>';
    echo '<form method="post" action="approvescore.php">';
    echo '<img src="' . GW_UPLOADPATH . $screenshot . '" width="160" alt="Score image" /><br />';
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="submit" value="Submit" name="submit" />';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="hidden" name="name" value="' . $name . '" />';
    echo '<input type="hidden" name="score" value="' . $score . '" />';
    echo '</form>';
}
?>
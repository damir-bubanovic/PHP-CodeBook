<body>

	<!--USE WITH SCOREBOARD - show scores.php, BASIC - SECURITY - anti SQL injections-->
	<!--LOOK / USE WITH SCOREBOARD - image upload path.php & BASIC - database connection.php-->

  <h2>Guitar Wars - Add Your High Score</h2>

<?php
  /*Set constants like BASIC file upload path and BASIC database connection and put them in include files*/
  require_once('appvars.php');
  require_once('connectvars.php');

  /*If button submit clicked*/
  if (isset($_POST['submit'])) {
    /*Grabbing important input data for info and further verification*/
	/*Screenshot type and size for correct type (jpeg, gif...) and size (32kg)*/
    $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
    $score = mysqli_real_escape_string($dbc, trim($_POST['score']));
    $screenshot = mysqli_real_escape_string($dbc, trim($_FILES['screenshot']['name']));
    $screenshot_type = $_FILES['screenshot']['type'];
    $screenshot_size = $_FILES['screenshot']['size']; 

	/*If input fields are not empty*/
	/*Is_numeric - score input must be number or number in a string*/
    if (!empty($name) && is_numeric($score) && !empty($screenshot)) {
	  /*Check to confirm that screenshot is an image & is greater than 0 bytes & is less than constant GW_MAXFILESIZE*/
      if ((($screenshot_type == 'image/gif') || ($screenshot_type == 'image/jpeg') || ($screenshot_type == 'image/pjpeg') || ($screenshot_type == 'image/png'))
        && ($screenshot_size > 0) && ($screenshot_size <= GW_MAXFILESIZE)) {
        if ($_FILES['screenshot']['error'] == 0) {
          /*Move the file to the target upload folder - in our case images*/
		  /*time() is used to add uniqueness to image filename to server, so identically named imaged do not get overwritten*/
          $target = GW_UPLOADPATH . $screenshot;
          if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {
            // Connect to the database
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            // Write the data to the database
			/*MySQL = 0 for auto-increment, NOW() for timestamp*/
			/*Here we did not define column names in $query*/
			/*Last 0 is for column approved, all new scores by default have 0, and after human approval 1 if OK*/
			/*Insert into ti ovdje nije secure pogledaj BASIC - security - query SQL injection.php*/
            $query = "INSERT INTO guitarwars VALUES (0, NOW(), '$name', '$score', '$screenshot', 0)";
            mysqli_query($dbc, $query);

            // Confirm success with the user
			/*Confirmation message for user that data has been recorded*/
            echo '<p>Thanks for adding your new high score! It will be reviewed and added to the high score list as soon as possible.</p>';
            echo '<p><strong>Name:</strong> ' . $name . '<br />';
            echo '<strong>Score:</strong> ' . $score . '<br />';
            echo '<img src="' . GW_UPLOADPATH . $screenshot . '" alt="Score image" /></p>';
			// Clear the score data to clear the form
			/*I believe so not to have sticky data if form submission was successful*/
            echo '<p><a href="index.php">&lt;&lt; Back to high scores</a></p>';

            // Clear the score data to clear the form
            $name = "";
            $score = "";
            $screenshot = "";

            mysqli_close($dbc);
          }
          else {
            echo '<p class="error">Sorry, there was a problem uploading your screen shot image.</p>';
          }
        }
      }
      else {
        echo '<p class="error">The screen shot must be a GIF, JPEG, or PNG image file no greater than ' . (GW_MAXFILESIZE / 1024) . ' KB in size.</p>';
      }

      // Try to delete the temporary screen shot image file
	  /*unlink function deletes a file from web server in case file upload is not successful to not receive error message */
      @unlink($_FILES['screenshot']['tmp_name']);
    }
    else {
      echo '<p class="error">Please enter all of the information to add your high score.</p>';
    }
  }
?>

  <hr />
  <!--Self referencing form with sticky data if not submitted correctly-->
  <!--enctype atribute is special encoding required for file uploads, important for POST data-->
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<!--Maximum file size for file upload is 32kb, for greater or lesser explore further-->
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE; ?>" />
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" /><br />
    <label for="score">Score:</label>
    <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>" /><br />
	<!--Upload file field-->
    <label for="screenshot">Screen shot:</label>
    <input type="file" id="screenshot" name="screenshot" />
    <hr />
    <input type="submit" value="Add" name="submit" />
  </form>
</body> 





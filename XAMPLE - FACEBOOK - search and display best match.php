	<!--USE with _FACEBOOK - questionnaire.php-->

<?php
  /*Start the session - for sessions & cookies*/
  require_once('startsession.php');

  /*Insert the page header*/
  $page_title = 'My Mismatch';
  require_once('header.php');
  /*Insert database connection and specific website constants*/
  require_once('appvars.php');
  require_once('connectvars.php');

  /*Make sure the user is logged in before going any further.*/
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
  }

  /*Show the navigation menu*/
  require_once('navmenu.php');

  /*Connect to the database*/
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  /*Only look for a mismatch if the user has questionnaire responses stored*/
  $query = "SELECT * FROM mismatch_response WHERE user_id = '" . $_SESSION['user_id'] . "'";
  $data = mysqli_query($dbc, $query);
  /*Only posible to find a mismatch for a user who has responded to the questionere*/
  if (mysqli_num_rows($data) != 0) {
    /*First grab the user's responses from the response table (JOIN to get the topic name)*/
    $query = "SELECT mr.response_id, mr.topic_id, mr.response, mt.name AS topic_name " .
      "FROM mismatch_response AS mr " .
      "INNER JOIN mismatch_topic AS mt USING (topic_id) " .
      "WHERE mr.user_id = '" . $_SESSION['user_id'] . "'";
    $data = mysqli_query($dbc, $query);
    $user_responses = array();
	/*while loop used to go through each row of query result building an array of user responses in the process*/
    while ($row = mysqli_fetch_array($data)) {
	  /*$user_responses will hold all of the user's responses*/
      array_push($user_responses, $row);
    }

    /*Initialize the mismatch search results*/
	/*These variables keep track of the mismatch search in progress*/
	/*the variable holds the mismatch score between two users - the highest score ultimately results in a mismatch*/
    $mismatch_score = 0;
	/*this is the user_id of the person who is being checked as a potencial mismatch*/
	/*after the search is complete this variable holds the id of the best mismatch*/
	/*if the variable is still set to -1 after ehe search we know there was not a mismatch, this is not likely*/
    $mismatch_user_id = -1;
	/*this array holds the topics that are mismatched between two users*/
    $mismatch_topics = array();

    /*Loop through the user table comparing other people's responses to the user's responses*/
    $query = "SELECT user_id FROM mismatch_user WHERE user_id != '" . $_SESSION['user_id'] . "'";
    $data = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_array($data)) {
      /*Grab the response data for the user (a potential mismatch)*/
	  /*Topic ID is used to lok up the topic and category names from the mismatch_topic table*/
	  /*Query2 is inner query - very important - use new query variable, so the original query is not affected*/
      $query2 = "SELECT response_id, topic_id, response FROM mismatch_response WHERE user_id = '" . $row['user_id'] . "'";
      $data2 = mysqli_query($dbc, $query2);
      $mismatch_responses = array();
      while ($row2 = mysqli_fetch_array($data2)) {
        array_push($mismatch_responses, $row2);
      }

      /*Compare each response and calculate a mismatch total*/
      $score = 0;
      $topics = array();
	  /*For loop counter is used to step through each user response*/
      for ($i = 0; $i < count($user_responses); $i++) {
		/*Remember 1 = love, 2 = hate, and 3 = 1 + 2 = mismatch */ 
		/*(int) - integar so it can be added & compared*/ 
        if (((int)$user_responses[$i]['response']) + ((int)$mismatch_responses[$i]['response']) == 3) {
          $score += 1;
          array_push($topics, $user_responses[$i]['topic_name']);
        }
      }

      /*Check to see if this person is better than the best mismatch so far*/
      if ($score > $mismatch_score) {
        /*We found a better mismatch, so update the mismatch search results*/
        $mismatch_score = $score;
		/*If the user is better mismatch than the best mismatch so far, than set him as the best mismatch*/
        $mismatch_user_id = $row['user_id'];
		/*array_slice - extract the slice of the array, in this case copy $topics array to $mismatch_topics*/
        $mismatch_topics = array_slice($topics, 0);
      }
    }

    /*Make sure a mismatch was actualy found*/
    if ($mismatch_user_id != -1) {
	  /*Query for the mismatched user's information so we can display it*/		
      $query = "SELECT username, first_name, last_name, city, state, picture FROM mismatch_user WHERE user_id = '$mismatch_user_id'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 1) {
        /*The user row for the mismatch was found, so display the user data*/
        $row = mysqli_fetch_array($data);
        echo '<table><tr><td class="label">';
        if (!empty($row['first_name']) && !empty($row['last_name'])) {
          echo $row['first_name'] . ' ' . $row['last_name'] . '<br />';
        }
        if (!empty($row['city']) && !empty($row['state'])) {
          echo $row['city'] . ', ' . $row['state'] . '<br />';
        }
        echo '</td><td>';
        if (!empty($row['picture'])) {
          echo '<img src="' . MM_UPLOADPATH . $row['picture'] . '" alt="Profile Picture" /><br />';
        }
        echo '</td></tr></table>';

        /*Display the mismatched topics*/
        echo '<h4>You are mismatched on the following ' . count($mismatch_topics) . ' topics:</h4>';
        foreach ($mismatch_topics as $topic) {
          echo $topic . '<br />';
        }

        /*Display a link to the mismatch user's profile*/
        echo '<h4>View <a href=viewprofile.php?user_id=' . $mismatch_user_id . '>' . $row['first_name'] . '\'s profile</a>.</h4>';
      }
    }
  }
  else {
    echo '<p>You must first <a href="questionnaire.php">answer the questionnaire</a> before you can be mismatched.</p>';
  }

  mysqli_close($dbc);

  /*Insert the page footer*/
  require_once('footer.php');
?>

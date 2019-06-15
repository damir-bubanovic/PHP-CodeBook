	<!--USE with _FACEBOOK - search and display best match.php-->

<?php
  /*Start the session - for cookies and sessions*/
  require_once('startsession.php');

  /*Insert the page header*/
  $page_title = 'Questionnaire';
  require_once('header.php');
  /*MySQL connections and specific website CONSTANTS*/
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

  /*OPTION 1*/
  /*If this user has never answered the questionnaire, insert empty responses into the database*/
  $query = "SELECT * FROM mismatch_response WHERE user_id = '" . $_SESSION['user_id'] . "'";
  $data = mysqli_query($dbc, $query);
  /*Check if the query returned 0 rows of data == no data (mysqli_num_rows - how many rows of data are returned)*/
  if (mysqli_num_rows($data) == 0) {
    /*First grab the list of topic IDs from the topic table*/
    $query = "SELECT topic_id FROM mismatch_topic ORDER BY category_id, topic_id";
    $data = mysqli_query($dbc, $query);
    $topicIDs = array();
	/*mysqli_fetch_array - get data from mysqli as an array*/
    while ($row = mysqli_fetch_array($data)) {
	  /*array push - push values to the end of the array of user data*/
      array_push($topicIDs, $row['topic_id']);
    }

    /*Insert empty response rows into the response table, one per topic - user has left options unchecked*/
	/*This happends the first time user acceses the the form*/
    foreach ($topicIDs as $topic_id) {
      $query = "INSERT INTO mismatch_response (user_id, topic_id) VALUES ('" . $_SESSION['user_id']. "', '$topic_id')";
      mysqli_query($dbc, $query);
    }
  }

  /*OPTION 2*/
  /*If the questionnaire form has been submitted, write the form responses to the database*/
  if (isset($_POST['submit'])) {
    /*Write the questionnaire response rows to the response table - update user submitted information*/
	/*When the user submits the form all that changes is response column of the response table, so we are updating that*/
	/*With update we are changing the response rows basede on user responses in the form*/
    foreach ($_POST as $response_id => $response) {
      $query = "UPDATE mismatch_response SET response = '$response' WHERE response_id = '$response_id'";
      mysqli_query($dbc, $query);
    }
    echo '<p>Your responses have been saved.</p>';
  }

  /*Grab the response data from the database to generate the form*/
  /*The topic_id is used to loog up the topic and category name from the mismatch_topic table*/
  /*Mt je shortcut za Mismatch*/
  /*AS keyword creates an alias npr. mismatch_topic table - we are simplifying the queryes*/
  /*With Join you can involve multiple tables in a query*/
  $query = "SELECT mr.response_id, mr.topic_id, mr.response, mt.name AS topic_name, mc.name AS category_name " .
    "FROM mismatch_response AS mr " .
	/*Mismatch topic can now be references as topic_id (brijem)*/
	/*First join brings topic table in query allowing the source the topic name using the topic id*/
	/*Second join wires the category table into the query using the category id allowing us the access the category name*/
    "INNER JOIN mismatch_topic AS mt USING (topic_id) " .
    "INNER JOIN mismatch_category AS mc USING (category_id) " .
    "WHERE mr.user_id = '" . $_SESSION['user_id'] . "'";
  $data = mysqli_query($dbc, $query);
  $responses = array();
  /*mysqli_fetch_array - get data from mysqli as an array*/
  while ($row = mysqli_fetch_array($data)) {
	/*Store all the query results data in the $response array*/
    array_push($responses, $row);
  }

  mysqli_close($dbc);

  /*Generate the questionnaire form by looping through the response array*/
  echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
  echo '<p>How do you feel about each topic?</p>';
  /*Grab the category of the first response to get started before entering the loop*/
  $category = $responses[0]['category_name'];
  /*Each category is sreated as a fieldset to help organize topics together*/
  echo '<fieldset><legend>' . $responses[0]['category_name'] . '</legend>';
  foreach ($responses as $response) {
    /*Only start a new fieldset if the category has changed*/
    if ($category != $response['category_name']) {
      $category = $response['category_name'];
      echo '</fieldset><fieldset><legend>' . $response['category_name'] . '</legend>';
    }

    /*Display the topic form field*/
	/*Insteda of if/else we use here ternary operator to change the style of the label for unanswered topics*/
	/*Each topic is created as a label followed by Love and Hate radio buttons*/
    echo '<label ' . ($response['response'] == NULL ? 'class="error"' : '') . ' for="' . $response['response_id'] . '">' . $response['topic_name'] . ':</label>';
	/*1 = love, 2 = hate*/
    echo '<input type="radio" id="' . $response['response_id'] . '" name="' . $response['response_id'] . '" value="1" ' . ($response['response'] == 1 ? 'checked="checked"' : '') . ' />Love ';
    echo '<input type="radio" id="' . $response['response_id'] . '" name="' . $response['response_id'] . '" value="2" ' . ($response['response'] == 2 ? 'checked="checked"' : '') . ' />Hate<br />';
  }
  echo '</fieldset>';
  echo '<input type="submit" value="Save Questionnaire" name="submit" />';
  echo '</form>';

  /*Insert the page footer*/
  require_once('footer.php');
?>

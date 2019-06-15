	<!--USE with - _BASIC - REGEX - validate phone numbers.php, validate email.php-->
	<!--LOOK UO - _BASIC - regex.php-->

<?php
  /*If submit button is pressed*/	
  if (isset($_POST['submit'])) {
	/*Store field values in variables*/  
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $job = $_POST['job'];
    $resume = $_POST['resume'];
	/*Show form - if there is an error than 'yes', if not than 'no'*/
    $output_form = 'no';

	/*Script checks for empty form filds*/
    if (empty($first_name)) {
      // $first_name is blank
      echo '<p class="error">You forgot to enter your first name.</p>';
      $output_form = 'yes';
    }

    if (empty($last_name)) {
      // $last_name is blank
      echo '<p class="error">You forgot to enter your last name.</p>';
      $output_form = 'yes';
    }

	/*Email adress has a special (correct) format - npr. @ and . */
	/*Acceptable characters*/
	$email_char = '[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/';
	/*if email adress does not have acceptable these characters*/
	if(!preg_match($email_char, $email)) {
		/*Email is not valid because LocalNape is bad*/
		print '<p class="error">This is not a valid email adress!</p>';
		$output_form = 'yes';
	} else {
		/*Strip out everything but the domain from the email*/
		$pattern_email = '/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/';
		$replacement_email = '';
		$domain = preg_replace($pattern_email, $replacement_email, $email);
		/*if domain is not registered - 0 - not valid*/
		/*If web server is UNIX / LINUX*/
		if(!checkdnsrr($domain)) {
			print '<p class="error">The domain is not registered!</p>';	
			$output_form = 'yes';
		} 
	}

	/*Phone number has a special (correct) format - npr. area code, country code, mobile network*/
	/*You can write more code by checking if variable is empty and than check preg_match inside*/
	/*Regex phone number - acceptable phone format - but make better phone format!!!*/
	$regex_phone = '/^[+][2-9]\d\d{1,2}\s\d{1,2}\s\d{3}-\d{3,4}$/';
	/*if phone and regex variables are not matched with preg_match*/
	if(!preg_match($regex_phone, $phone)) {
		print '<p class="errot">Your phone number is invalid</p>';
		$output_form = 'yes';
	} else {
		$pattern = '/[\+\s\-]/';
		$replacement = '';
		/*Standardize numbers for MySQL database to store only numbers with preg_replace*/
		$new_phone = preg_replace($pattern, $replacement, $phone);
	}
	
	if(empty($job) {
		/*Job is empty*/
		print '<p class="error">You forgot to enter desired job</p>';
		$output_form = 'yes';
	}
	
	if(empty($resume) {
		/*Resume is empty*/
		print '<p class="error">You forgot to submit resume</p>';
		$output_form = 'yes';
	}


  }
  else {
    $output_form = 'yes';
  }

  if ($output_form == 'yes') {
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <p>Register with Risky Jobs, and post your resume.</p>
  <table>
    <tr>
      <td><label for="firstname">First Name:</label></td>
      <td><input id="firstname" name="firstname" type="text" value="<?php echo $first_name; ?>"/></td></tr>
    <tr>
      <td><label for="lastname">Last Name:</label></td>
      <td><input id="lastname" name="lastname" type="text" value="<?php echo $last_name; ?>"/></td></tr>
    <tr>
      <td><label for="email">Email:</label></td>
      <td><input id="email" name="email" type="text" value="<?php echo $email; ?>"/></td></tr>
    <tr>
      <td><label for="phone">Phone:</label></td>
	  <td><p class="example">Example: +385 98 345-3425</p></td>
      <td><input id="phone" name="phone" type="text" value="<?php echo $phone; ?>"/></td></tr>
    <tr>
      <td><label for="job">Desired Job:</label></td>
      <td><input id="job" name="job" type="text" value="<?php echo $job; ?>"/></td>
  </tr>
  </table>
  <p>
    <label for="resume">Paste your resume here:</label><br />
    <textarea id="resume" name="resume" rows="4" cols="40"><?php echo $resume; ?></textarea><br />
    <input type="submit" name="submit" value="Submit" />
  </p>
</form>

<?php
  }
  else if ($output_form == 'no') {
    echo '<p>' . $first_name . ' ' . $last_name . ', thanks for registering with Risky Jobs!</p>';

    // code to insert data into the RiskyJobs database...
  }
?>
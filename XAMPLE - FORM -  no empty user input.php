<?php
/*$output_form je nova varijabla koja je postavljena*/
/*ako je true prikazuje nam se ponovno form, ako je false sve je ok!*/
$from = 'elmer@makemeelvis.com';
$subject = $_POST['subject'];
$text = $_POST['elvismail'];
$output_form = false;

/*Provjeravanje jesu li input fields prazni ili ne*/
if (empty($subject) && empty($text)) {
	// We know both $subject AND $text are blank
	echo 'You forgot the email subject and body text.<br />';
	$output_form = true;
}

if (empty($subject) && (!empty($text))) {
	echo 'You forgot the email subject.<br />';
	$output_form = true;
}

if ((!empty($subject)) && empty($text)) {
	echo 'You forgot the email body text.<br />';
	$output_form = true;
}

if ((!empty($subject)) && (!empty($text))) {
	// Code to send the email
	...
}

/*Ako je $output_form variabla tru onda displaya form*/
/*kreativan način za prikazivanje podataka*/
/*Izlazimo i ponovno ulazimo u PHP*/
if ($output_form) {
?>
<form method="post" action="sendemail.php">
<label for="subject">Subject of email:</label><br />
<input id="subject" name="subject" type="text" size="30" /><br />
<label for="elvismail">Body of email:</label><br />
<textarea id="elvismail" name="elvismail" rows="8" cols="40"></textarea><br />
<input type="submit" name="submit" value="Submit" />
</form>
<?php
};
?>


<?php 
/*OR*/

$from = 'elmer@makemeelvis.com';
$subject = $_POST['subject'];
$text = $_POST['elvismail'];

	/*Flipali smo empty, u našem slučaju ako nije empty (!)*/
	if(!empty($subject)) {
		if(!empty($subject)) {
			$dbc = mysqli_connect('data.makemeelvis.com', 'elmer', 'theking', 'elvis_store')
			or die('Error connecting to MySQL server.');
			
			$query = "SELECT * FROM email_list";
			$result = mysqli_query($dbc, $query)
				or die('Error querying database.');
				
			while ($row = mysqli_fetch_array($result)) {
				$to = $row['email'];
				$first_name = $row['first_name'];
				$last_name = $row['last_name'];
				$msg = "Dear $first_name $last_name,\n$text";
				mail($to, $subject, $msg, 'From:' . $from);
				echo 'Email sent to ' . $to . '<br />';
			}
			mysqli_close($dbc);
		}
		else {
			print 'You forgot the email subject and / or body text. <br />';
		}
	};


?>
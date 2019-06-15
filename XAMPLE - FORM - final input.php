<?php
/*User data in variables*/
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$when_it_happened = $_POST['whenithappened'];
$how_long = $_POST['howlong'];
$how_many = $_POST['howmany'];
$alien_description = $_POST['aliendescription'];
$what_they_did = $_POST['whattheydid'];
$fang_spotted = $_POST['fangspotted'];
$email = $_POST['email'];
$other = $_POST['other'];

/*Update MySQL database*/
$dbc = mysqli_connect('localhost', 'root', '', 'aliendatabase')
or die('Error connecting to MySQL server.');

$query = "INSERT INTO aliens_abduction (first_name, last_name, when_it_happened, how_long, " .
"how_many, alien_description, what_they_did, fang_spotted, other, email) " .
"VALUES ('$first_name', '$last_name', '$when_it_happened', '$how_long', '$how_many', " .
"'$alien_description', '$what_they_did', '$fang_spotted', '$other', '$email')";

$result = mysqli_query($dbc, $query)
or die('Error querying database.');

mysqli_close($dbc);
/*End*/

/*Message to sales manager*/
$to = 'damir.bubanovic@yahoo.com';
$subject = 'Aliens Abducted Me - Abduction Report';
$msg = $name . ' was abducted ' . $when_it_happened . ' and was gone for ' . $how_long . '.\n' .
'Number of aliens: ' . $how_many . '\n' .
'Alien description: ' . $alien_description . '\n' .
'What they did: ' . $what_they_did . '\n' .
'Fang spotted: ' . $fang_spotted . '\n' .
'Other comments: ' . $other;
mail($to, $subject, $msg, 'From:' . $email);

/*Message to user*/
echo 'Thanks for submitting the form.<br />';
echo 'You were abducted ' . $when_it_happened;
echo ' and were gone for ' . $how_long . '<br />';
echo 'Describe them: ' . $alien_description . '<br />';
echo 'Was Fang there? ' . $fang_spotted . '<br />';
echo 'Your email address is ' . $email;



/*OR*/

/*Processing user input into variables*/
/*REMEMBER - for PHP take NAME of element, for JS take ID of element*/
/*Alternative Code \n means new line, great for text messages*/
$firstName = $_POST["firstname"];
$lastName = $_POST["lastname"];
$eMail = $_POST["email"];
$messAge = $_POST["message"];
$subject = "Business - User message";
$messageTo = "damir.bubanovic@yahoo.com";
$messageText = "Heads UP! Business message! \n" .
"$firstName $lastName wrote a message: \n" .
"Message says: \n $messAge \n";


/*Database connection*/
$databaseConnection = mysqli_connect(
	"localhost",
	"damir",
	"buba",
	"user_message_db"
) or die("Error connecting to MySQL server");

/*Insert values into database - CUSTOM QUERY*/
$query = "INSERT INTO user_message ('firstname', 'lastname', 'email', 'message')" .
"VALUES ('$firstname', '$lastname', '$email', '$message')";
/*Insert query on database*/
$result = mysqli_query($databaseConnection, $query)
or die("Error Querrying Database");
/*Close connection MySQL*/
mysqli_close($databaseConnection);


/*Sent mail to admin ( mail() function )*/
mail($messageTo, $subject, $messageText, "From: " . $eMail);

/*message report*/
print "Message has been sucessfuly send!";


?>
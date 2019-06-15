<?php 
/*Defining variables*/
/*$from - our email adress*/
/*for subject adn text we can store text in MySQL database*/
$from = "damir.bubanovic@yahoo.com";
$subject = $_POST["subject"];
$text = $_POST["elvismail"];

/*Database connection*/
$dbc = mysqli_connect('localhost', 'root', '', 'elvis_store')
or die('Error connecting to MySQL server.');

/*Selecting data from databases*/
/*email_list is list in elvis_store database*/
$query = "SELECT * FROM email_list";
$result = mysqli_query($dbc, $query)
or die('Error querying database.');

/*prikazivanje podataka - putem loopa prolazim sve podatke*/
/*$row pohranjuje podatke red po red! pogledaj bolje ovo!!!*/
while($row = mysqli_fetch_array($result)) {
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$msg = "Dear $first_name $last_name,\n $text";
	$to = $row['email'];
	mail($to, $subject, $msg, 'From:' . $from);
	echo 'Email sent to: ' . $to . '<br />';
};

/*Close Connection*/
mysqli_close($dbc);
?>
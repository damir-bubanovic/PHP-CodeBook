<?php 
/*Create Connection with database*/
$dbc = mysqli_connect('localhost', 'root', '', 'elvis_store')
or die('Error connecting to MySQL server.');

/*Catch user info in $email*/
$email = $_POST['email'];

/*From data list delete item with email identical to user input*/
$query = "DELETE FROM elvis_list WHERE email = '$email'";
mysqli_query($dbc, $query)
or die('Error Querrying database!');

print 'Customer removed';

mysqli_close($dbc);
?>
<?php 

/*USE WITH MAILING LIST - remove users.html*/

/*User email to variable*/
$email = $_POST["email"];

/*Connect & remove user from database*/
/*Based on email because that is unique*/
$dataConnect = mysqli_connect("localhost", "root", "", "elvis_store")
or die("Can not connect to database!");

$query = "DELETE FROM email_list WHERE email = $email";

mysqli_query($dataConnect, $query)
or die("Can not query database!");

print "You have been sucesfully removed from mailing list!";

mysqli_close($dataConnect);
?>
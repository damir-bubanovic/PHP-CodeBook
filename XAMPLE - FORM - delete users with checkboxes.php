<!--Self referencing form-->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">

<?php
$dbc = mysqli_connect('localhost', 'root', '', 'elvis_store')
or die('Error connecting to MySQL server.');

/*Delete the customer rows (only if the form has been submitted)*/
if(isset($_POST['submit'])) {
	/*array je stored u post superglobal todelete*/
	/*svaki element arraya biti će dostupan kroz varijablu $delete_id*/
	foreach($_POST['todelete'] as $delete_id) {
		$query = "DELETE FROM email_list WHERE id=$delete_id";
		mysqli_query($dbc, $query)
		or die('Error querying database.');
	}
	print 'Customer(s) removed.<br />';
}

/*Display the customer rows with checkboxes for deleting*/
$query = "SELECT * FROM email_list";
$result = mysqli_query($dbc, $query);
while ($row = mysqli_fetch_array($result)) {
	/*Koristimo primary key za deletanje*/
	/*todelete[] - checkbox values stavljamo u array todelete[]*/
	echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]" />';
	echo $row['first_name'];
	echo ' ' . $row['last_name'];
	echo ' ' . $row['email'];
	echo '<br />';
}

mysqli_close($dbc);
?>

<input type="submit" name="submit" value="Remove" />
</form>
<?php 
/*Code half missing*/
/*Pogledaj bolje kako da makneš duplikate iz database*/
/*echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]">';*/

$dbc = mysqli_connect('data.makemeelvis.com', 'elmer', 'theking', 'elvis_store')
or die('Error connecting to MySQL server.');
// Delete the customer rows (only if the form has been submitted)
if(isset($_POST["submit"])) {
	foreach($_POST["todelete"] as $delete_id) {
		$query = "DELETE FROM email_list WHERE id = $delete_id";
		mysqli_query($dbs, $query)
		or die("Can not query database");
	}
	print "Customer removed.<br />";
}
// Display the customer rows with checkboxes for deleting
$query = "SELECT * FROM email_list";
$result = mysqli_query($dbc, $query);
while ($row = mysqli_fetch_array($result)) {
echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]" />';
echo $row['first_name'];
echo ' ' . $row['last_name'];
echo ' ' . $row['email'];
echo '<br />';
}
mysqli_close($dbc);
?>

<form>
	<!--Form se zapravo povezuje gore i remove button je na kraju scripta, ovo je self-processing page-->
	<input type="submit" name="submit" value="Remove" />
</form>
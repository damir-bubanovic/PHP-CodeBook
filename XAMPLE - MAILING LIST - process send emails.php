<?php 

/*USE WITH MAILING LIST - send emails.html*/

/*Email variables for send*/
$from = "damir.bubanovic@yahoo.com";
$subject = $_POST["subject"];
$text = $_POST["elvismail"];

/*Check if user input is empty*/
if((!empty($subject)) && (!empty($text))) {
	/*Database querying*/
	$dataConnect = mysqli_connect("localhost", "root", "", "elvis_store")
	or die("Can not connect to database!");
	
	$query = "SELECT * FROM email_list";
	
	/*$result variable stores ID number for MySQL resource, not the actual data*/
	$result = mysqli_query($dataConnect, $query)
	or die("Can not query database!");
	
	/*Each row of data is returned in array, and it is stored in $row*/
	/*Send email message to customers in email_list*/
	while($row = mysqli_fetch_array($result)) {
		$first_name = $row["first_name"];
		$last_name = $row["last_name"];
		
		$message = "Dear $first_name $last_name, \n $text";
		$to = $row["email"];
		mail($to, $subject, $message, 'From: ' . $from);
		
		print "Email sent to: " . $to . "<br />";	
	};
		
	mysqli_close($dataConnect);
} else {
	print "Please enter Subject and Message text in email";
}
?>
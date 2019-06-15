<?php 
/*

!!FORM - GUARDING AGAINST MULTIPLE SUBMISSIONS OF THE SAME FORM!!

> want to prevent a user from submitting the same form more than once

> Include a hidden field in the form with a unique value
	>> When validating the form, check if a form has already been submitted with that value. 
	>> If it has, reject the submission, If it hasn’t, process the form and record the value for later use. 
	>> Use JavaScript to disable the form Submit button once the form has been submitted

> POSITIVES <
	+ prevents the non-malicious mistake and can slow down the malicious user. To be absolutely sure add CAPTCHA or other form verification
	+ prevents your database from being cluttered with too many copies of the same record
	+ by generating a token that’s placed in the form, you can uniquely identify that specific instance of the form, even when cookies are disabled

*md5 - calculate the md5 hash of a string
*uniqid - generate a unique ID
*$_SERVER - array containing information such as headers, paths, and script locations (Server and execution environment information)
*count - count all elements in an array, or something in an object
	
*/


/*Insert a unique ID into a form - uses uniqid() and md5() functions to insert a unique ID field*/
?>

<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" onsubmit="document.getElementById('submit-button').disabled = true;">
    <!-- insert all the normal form elements you need -->
    <input type='hidden' name='token' value='<?php md5(uniqid()) ?>'/>
    <input type='submit' value='Save Data' id='submit-button'/>
</form>

<?php 
/*Checking a form for resubmission*/
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$db = new PDO('sqlite:/tmp/formjs.db');
	$db->beginTransaction();
	
	$sth = $db->prepare("SELECT * FROM forms WHERE token = ?");
	$sth->execute(array($_POST['token']));
	
	if(count($sth->fetchAll())) {
		print 'This form has already been submitted!';
		$db->rollBack();
	} else {
		/* Validation code for the rest of the form goes here -- validate everything before inserting the token */
		$sth = $db->prepare("INSERT INTO forms (token) VALUES (?)");
		$sth = execute(array($_POST['token']));
		$db->commit();
		print 'The form is submitted successfully!';
	}
}

?>
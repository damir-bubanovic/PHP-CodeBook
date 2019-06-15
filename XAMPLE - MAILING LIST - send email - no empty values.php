<?php

/*ADVANCED*/
/*USE WITH MAILING LIST - process send emails.php*/
/*USE WITH MAILING LIST - send emails.html*/

$from = 'damir.bubanovic@yahoo.com';
$subject = $_POST['subject'];
$text = $_POST['elvismail'];
$output_form = false;
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
	/*Code to send the email*/
}
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
}
?>
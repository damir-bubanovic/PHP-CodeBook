<?php 
/*

!!INTERNET SERVICES - SENDING MAIL!!

> want to send an email message. This can be in direct response to a user’s action, such as 
signing up for your site, or a recurring event at a set time, such as a weekly newsletter

*mail - send mail

*/


/*Use Zetacomponent’s ezcMailComposer class*/
$message = new ezcMailComposer();

$message->from = new ezcMailAdress('webmaster@example.com');
$message->addTo(new ezcMailAdress('adam@example.com', 'Adam'));
$message->subject = 'New Version of PHP Released!';
$body = 'Go to http://www.php.net and download it today!';

$message->plainText = $body;
$message->build();

$sender = new ezcMailMtaTransport();
$sender->send($message);


/*OR*/


/*If you can’t use Zetacomponent’s ezcMailComposer class, use PHP’s built-in mail() function*/
$to = 'adam@example.com';
$subject = 'New Version of PHP Released!';
$body = 'Go to http://www.php.net and download it today!';

mail($to, $subject, $body);


/*
> The Zetacomponent ezcMailComposer class gives you a way to construct email messages.
> How the component sends the message depends on which ezcMailTransport implementation you use

The ezcMailSmtpTransport can be used to talk to an SMTP server directly, as follows
*/
$message = new ezcMailComposer();
$message->from = new ezcMailAddress('webmaster@example.com');
$message->addTo(new ezcMailAddress('adam@example.com', 'Adam'));
$message->subject = 'New Version of PHP Released!';

$body = 'Go to http://www.php.net and download it today!';

$message->plainText = $body;
$message->build();
$host = 'smtpauth.example.com';
$username = 'philb';
$password = 'jf430k24';
$port = 587;

$smtpOptions = new ezcMailSmtpTransportOptions();
$smtpOptions->preferredAuthMethod = ezcMailSmtpTransport::AUTH_LOGIN;
$sender = new ezcMailSmtpTransport($host, $username, $password, $port, $smtpOptions);
$sender->send($message);



/*
The program mail() uses to send mail is specified in the send mail_path configuration variable in your php.ini file. 
	> If you’re running Windows, set the SMTP variable to the hostname of your SMTP server. Your From address comes from
	the sendmail_from variable

You can also add extra headers with an optional fourth parameter
*/
$to = 'adam@example.com';
$subject = 'New Version of PHP Released!';
$body = 'Go to http://www.php.net and download it today!';
$header = "Reply-To: webmaster@example.com\r\n" 
			. "Organization: The PHP Group";	/*Separate each header with \r\n, but don’t add \r\n following the last header*/

mail($to, $subject, $body, $header);


/*Regardless of which method you choose, it’s a good idea to write a wrapper function to assist you in sending mail. 
Forcing all your mail through this function makes it easy to add logging and other checks to every message sent*/

function mail_wrapper($to, $subject, $body, $headers) {
	mail($to, $subject, $body, $headers);
	error_log("[MAIL][TO: $to]");
}


/*
Here a message is written to the error log, recording the recipient of each message that’s sent. 
	> This provides a timestamp that allows you to more easily track complaints that someone is trying to 
	use the site to send spam. 
> Another option is to create a list of do not send email addresses, which prevent those people from ever 
receiving another message from your site. 
> You can also validate all recipient email addresses, which reduces the number of bounced messages
*/

?>
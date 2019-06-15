<?php 
/*

!!INTERNET SERVECES - READING MAIL WITH IMAP or POP3!!

> want to read mail using IMAP or POP3, which allows you to create a web-based email client

> The underlying library PHP uses to support IMAP and POP3 offers a seemingly unending
number of features that allow you to essentially write an entire mail client
	>> there are currently 73 different functions in PHP beginning with the word imap

*imap_open - open an IMAP stream to a mailbox
*imap_headers - returns headers for all messages in a mailbox
*imap_num_msg - gets the number of messages in the current mailbox
*imap_header - read the header of the message - USE imap_headerinfo()
*imap_body - read the message body
*imap_close - close an IMAP stream
*imap_fetchstructure - read the structure of a particular message
*count - count all elements in an array, or something in an object
*imap_fetchbody - fetch a particular section of the body of the message

*/


/*Use PHP’s IMAP extension, which speaks both IMAP and POP3*/
// open IMAP connection
// This opens an IMAP connection to the server named mail.server.com on port 143
$mail = imap_open('{mail.server.com:143}', 'username', 'password');

// or, open POP3 connection
$headers = imap_headers($mail);

// grab a header object for the last message in the mailbox
$last = imap_num_msg($mail);
$header = imap_header($mail, $last);

// grab the body for the same message
$body = imap_body($mail, $last);

// close the connection
imap_close($mail);



/*To open a POP3 connection instead, append /pop3 to the end of the server and port.
Because POP3 usually runs on port 110, add :110 after the server name*/
$mail = imap_open('{mail.server.com:110/pop3}', 'username', 'password');


/*
> To encrypt your connection with SSL, add /ssl on to the end, just as you did with pop3
	>> most SSL connections talk on either port 993 or 995
*/
$mail = imap_open('{mail.server.com:993/novalidate-cert/pop3/ssl}', 'username', 'password');



/*Open connection*/
$server = 'mail.server.com';
$port = 993;

$mail = imap_open("\{$server:$port}", 'username', 'password');

/*
> You can ask a variety of questions to the server
	>> To get a listing of all the messages in your inbox, use imap_headers()
*/
$headers = imap_headers($mail);
/*
This returns an array in which each element is a formatted string corresponding to a message:
A 189) 5-Aug-2007 Beth Hondl an invitation (1992 chars)
*/

/*Retrieve a specific message, use imap_header() and imap_body() to pull the header object and body string*/
$header = imap_header($message_number);
$body = imap_body($message_number);


/*imap_header() fields from a server - Look it up on php*/


/*The body element is just a string, but if the message is a multipart message, such as one
that contains both an HTML and a plain-text version, $body holds both parts and the
MIME lines describing them*/
?>

------=_Part_1046_3914492.1008372096119
Content-Type: text/plain; charset=us-ascii
Content-Transfer-Encoding: 7bit
Plain-Text Message
------=_Part_1046_3914492.1008372096119
Content-Type: text/html
Content-Transfer-Encoding: 7bit
<html>HTML Message</html>
------=_Part_1046_3914492.1008372096119--

<?php 
/*To avoid this, use imap_fetchstructure() in combination with imap_fetchbody() to
discover how the body is formatted and to extract just the parts you want*/
// pull the plain text for message $n
$st = imap_fetchstructure($mail, $n);

if(!empty($st->parts)) {
	for($i = 0, $j = count($st->parts); $i < $j; $i++) {
		$part = $st->parts[$i];
		
		if($part->subtype == 'PLAIN') {
			$body = imap_fetchbody($mail, $n, $i+1);
		}
	}
} else {
	$body = imap_body($mail, $n);
}

/*IMAP MIME type values - LOOK on php.net*/

?>
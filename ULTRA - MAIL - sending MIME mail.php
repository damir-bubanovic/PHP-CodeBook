<?php 
/*

!!INTERNET SERVICES - SENDING MIME MAIL!!

> want to send MIME email. 
	>> npr. you want to send multipart messages with both plain text and HTML portions and 
	have MIME-aware mail readers automatically display the correct portion

*/


/*Use Zetacomponent’s ezcMailComposer class, specifying both a plainText and an htmlText 
property as follows*/
$message = new ezcMailComposer();
$message->from = new ezcMailAddress('webmaster@example.com');
$message->addTo(new ezcMailAddress('adam@example.com', 'Adam'));
$message->subject = 'New Version of PHP Released!';

$body = 'Go to http://www.php.net and download it today!';

$message->plainText = $body;
$html = '<html><body><b>Hooray!</b> New PHP Version!</body></html>';
$message->htmlText = $html;
$message->build();

$sender = new ezcMailMtaTransport();
$sender->send($message);


/*Including inline images is easy with ezcMailComposer. Just reference the appropriate local 
path in the src attribute of an <img/> tag*/
$message = new ezcMailComposer();
$message->from = new ezcMailAddress('webmaster@example.com');
$message->addTo(new ezcMailAddress('adam@example.com', 'Adam'));
$message->subject = 'New Version of PHP Released!';

$body = 'Go to http://www.php.net and download it today!';

$message->plainText = $body;
$html = '<html>Me: <img src="file:///home/me/picture.png"/></html>';
$message->htmlText = $html;
$message->build();

$sender = new ezcMailMtaTransport();
$sender->send($message);


/*To add an attachment to the message, such as a graphic or an archive, call addFileAt
tachment() or addStringAttachment()*/
$message = new ezcMailComposer();
$message->from = new ezcMailAddress('webmaster@example.com');
$message->addTo(new ezcMailAddress('adam@example.com', 'Adam'));
$message->subject = 'New Version of PHP Released!';

$body = 'Go to http://www.php.net and download it today!';

$message->plainText = $body;
$message->addFileAttachment('/home/me/details.png','image','png');
$message->addStringAttachment('extra.txt','Some text', 'text/plain');
$message->build();

$sender = new ezcMailMtaTransport();
$sender->send($message);

?>
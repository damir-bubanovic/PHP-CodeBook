<?php 
/*

!!INTER & LOCAL - SETTING THE CHARACTER ENCODING OF OUTGOING DATA!!

> You want to make sure that browsers correctly handle the UTF-8–encoded 
text that your programs emit

*header - send a raw HTTP header

*/


/*Set PHP’s default_encoding configuration directive to utf-8.
	>> This ensures that the Content-Type header PHP emits on HTML responses includes 
	the charset=utf-8 piece, which tells web browsers to interpret the page contents 
	as UTF-8 encoded*/


/*If you can’t change the default_encoding configuration directive, send the proper
Content-Type header yourself with the header() function*/
/*Setting character encoding*/
header('Content-Type: text/html;charset=utf-8');

?>
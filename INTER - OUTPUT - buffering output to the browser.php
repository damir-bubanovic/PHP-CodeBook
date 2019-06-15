<?php 
/*

!!BUFFERING OUTPUT TO THE BROWSER!!

> start generating output before you’re finished sending headers or cookies

*ob_start - turn on output buffering
*setcookie - defines a cookie to be sent along with the rest of the HTTP headers
*ob_end_flush - flush (send) the output buffer and turn off output buffering
*preg_match - searches subject for a match to the regular expression given in pattern

*/


/*Call ob_start() at the top of your page and ob_end_flush() at the bottom*/
/*The output won’t be sent until ob_end_flush() is called*/

ob_start();	// I haven't decided if I want to send a cookie yet
/*...code...*/
setcookie('heron','great blue');	// Yes, sending that cookie was the right decision.
/*...code...*/
ob_end_flush();



/*pass ob_start() the name of a callback function to process the output buffer with that function*/
/*npr. useful for postprocessing all the content in a page, such as hiding email addresses from address-harvesting robots*/
function mangle_email($s) {
	return preg_match('/([^@\s]+)@([-a-z0-9]+\.)+[a-z]{2,}/is', '<$1@...>', $s);
}

// I would not like spam sent to ronald@example.com!
ob_start('mangle_email');	// I would not like spam sent to <ronald@...>!




/*output_buffering configuration directive turns output buffering on for all pages*/
output_buffering = On

/*output_handler sets an output buffer processing callback to be used on all pages*/
output_handler=mangle_email
?>
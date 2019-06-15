<?php 
/*

!!HEADER - REDIRECT A USER!!

> If you want to redirect an user and tell him he will be redirected, e. g. 
"You will be redirected in about 5 secs. If not, click here

> ALERT <
	> If you're using header("Location: "); after you've output content make sure you've put 
	ob_start(); earlier in the script. ob_start(); buffers your script, so nothing is output 
	until you either call ob_end(); or the end of the file is reached. 
	> Calling header("Location: "); after content has already been output to the browser can cause problems

*header — send a raw HTTP header
*/


/*either you have to use the HTML meta refresh thingy or you use the following*/
header( "refresh:5;url=wherever.php" ); 
print 'You\'ll be redirected in about 5 secs. If not, click <a href="wherever.php">here</a>.';

?>
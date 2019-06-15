<?php 
/*

!!FORCE OUTPUT TO THE BROWSER!!

> force output to be sent to the browser. 
	npr. before doing a slow database query, you want to give the user a status update
> flush() function sends all output that PHP has internally buffered to the web server, but the web 
server may have internal buffering of its own that delays when the data reaches the browser

*flush - flush system output buffer

*/


print 'Finding identical snowflakes...';
flush();
$sth = $dbh->query('SELECT shape, COUNT(*) AS c FROM snowflakes GROUP BY shape HAVING c > 1');


/*Forcing IE to display content immediately - some IE are slow*/
print str_repeat(' ', 300);
print 'Finding identical snowflakes...';
flush();
$sth = $dbh->query('SELECT shape,COUNT(*) AS c FROM snowflakes GROUP BY shape HAVING c > 1');

?>
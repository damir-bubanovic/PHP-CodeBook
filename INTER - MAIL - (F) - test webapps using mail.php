<?php 
/*

!!TEST WEBAPPS USING EMAIL - FAKE SENT MAIL!!

> save this file as /usr/sbin/sendmail and you can test your PHP applications using mail by looking at the /tmp/fakesendmail.log files
*mail - send mail
*define - defines a named constant
*fopen - opens file or URL
*fwrite - binary-safe file write
*implode - join array elements with a string
*date - format a local time/date
*file_get_contents - reads entire file into a string
*fclose - closes an open file pointer

*/

define('LOGFILE', '/tmp/fakesendmail.log');

$log = fopen(LOGFILE, 'a+');

fwrite($log, "\n" . implode(' ', $argv) . " called on: " . date('Y-m-d H:i:s') . "\n");
fwrite($log, file_get_contents("php://stdin"));

fwrite($log,
"\n===========================================================\n");
fclose($log);
?>
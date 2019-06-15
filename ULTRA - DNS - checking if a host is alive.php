<?php 
/*

!!DNS - CHECKING IF A HOST IS ALIVE!!

> want to ping a host to see if it is still up and accessible from your location

*/


/*Use PEAR’s Net_Ping package*/
require 'Net/Ping.php';

$ping = Net_Ping::factory();
if($ping->checkHost('www.oreilly.com')) {
	print 'Reachable';
} else {
	print 'Unreachable';
}

$data = $ping->ping('www.oreilly.com');


/*The ping program tries to send a message from your machine to another*/
require 'Net/Ping.php';

$ping = Net_Ping::factory();
$result = $ping->ping('www.oreilly.com');

print<<<_INFO_
Ping of www.oreilly.com ({$result->getTargetIp()})
with {$result->getTransmitted()} requests had
a minimum time of {$result->getMin()} ms and
a maximum time of {$result->getMax()} ms.
_INFO_
;

/*Output*/
?>

Ping of www.oreilly.com (23.67.61.152)
with 3 requests had
a minimum time of 35.4 ms and
a maximum time of 40.586 ms.
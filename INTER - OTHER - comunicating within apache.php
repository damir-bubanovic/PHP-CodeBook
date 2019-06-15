<?php 
/*

!!COMUNICATING WITHIN APACHE!!

> communicate from PHP to other parts of the Apache request process

*/


// get value
$session = apache_note('session');


// set value
apache_note('session', $session);

?>
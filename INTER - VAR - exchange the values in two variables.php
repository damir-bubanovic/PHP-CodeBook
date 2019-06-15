<?php 
/*

!!EXCHANGE VALUES BETWEEN TWO VARIABLES!!

> exchange the values in two variables without using additional variables for storage

*list - Assign variables as if they were an array 

*/


/*To swap $a and $b:*/
$a = 'Alice';
$b = 'Bob';

list($a,$b) = array($b,$a);
// now $a is Bob and $b is Alice

/*OTHER EXAPMLE*/
$yesterday = 'pleasure';
$today = 'sorrow';
$tomorrow = 'celebrate';

list($yesterday,$today,$tomorrow) = array($today,$tomorrow,$yesterday);
// now $yesterday is 'sorrow', $today is 'celebrate'
// and $tomorrow is 'pleasure'
?>
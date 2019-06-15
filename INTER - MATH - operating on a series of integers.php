<?php 
/*

!!OPERATING ON SERIES ON INTEGERS!!

*range - create an array containing a range of elements

*/


/*Apply a piece of code to a range of integers*/
$start = 3;
$end = 7;

for($i = $start; $i <= $end; $i++) {
	printf("%d squared is %d\n", $i, $i * $i);
}


/*Increment using values other than 1*/
$start = 3;
$end = 7;

for($i = $start; $i <= $end; $i += 2) {
	printf("The odd number %d squared is %d\n", $i, $i * $i);
}


/*Preserve the numbers for use beyond iteration*/
$numbers = range(3, 7);

foreach($numbers as $n) {
	printf("%d squared is %d\n", $n, $n * $n);
}
foreach($numbers as $n) {
	printf("%d cubed is %d\n", $n, $n * $n * $n);
}

?>
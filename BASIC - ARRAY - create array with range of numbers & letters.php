<?php 
/*

!!CREATE ARRAY WITH RANGE OF NUMBERS / LETTERS!!

*range - Create an array containing a range of elements
	> array range ( mixed $start , mixed $end [, number $step = 1 ] )
		> If a step value is given, it will be used as the increment between elements in the sequence

*/


$cards = range(1, 52);
// (shows numbers from 1-52)


$odd = range(1, 52, 2);
$even = range(2, 52, 2);
// (shows even numbers from 2-52)





// array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12)
foreach (range(0, 12) as $number) {
    echo $number;
}

// The step parameter
// array(0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100)
foreach (range(0, 100, 10) as $number) {
    echo $number;
}

// Usage of character sequences
// array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i');
foreach (range('a', 'i') as $letter) {
    echo $letter;
}
// array('c', 'b', 'a');
foreach (range('c', 'a') as $letter) {
    echo $letter;
}
?>
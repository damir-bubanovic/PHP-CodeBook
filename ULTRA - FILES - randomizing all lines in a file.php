<?php 
/*

!!FILES - RANDOMIZING ALL LINES IN A FILE!!

> You want to randomly reorder all lines in a file. 
	>> npr. you have a file of funny quotes and you want to pick out one at random

*shuffle - shuffle an array 
*file - reads entire file into an array

*/


/*Read all the lines in the file into an array with file() and then 
shuffle the elements of the array*/
$lines = file(__DIR__ . '/quotes-of-the-day.txt');

if(shuffle($lines)) {
	// okay
} else {
	die("Failed to shuffle!");
}

/*The shuffle() function randomly reorders the array elements, so after 
shuffling, you can pick out $lines[0] as a quote to display*/
?>
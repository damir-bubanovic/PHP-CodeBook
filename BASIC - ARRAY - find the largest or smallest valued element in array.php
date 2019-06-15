<?php 
/*

!!FIND THE LARGEST AND SMALLEST VALUED ELEMENT IN ARRAY!!

*min - find lowest value
	> mixed min ( array $values )
*max - find highest value
	> mixed max ( array $values )
*arsort - sort an array in reverse order and maintain index association
	> bool arsort ( array &$array [, int $sort_flags = SORT_REGULAR ] )

*/


/*find the largest or smallest valued element npr. find the appropriate scale when creating a histogram*/
$largest = max($array);
$smallest = min($array);

/*find the index of the largest element*/
arsort($array); // Now the value of the largest element is $array[0]

/*If you don’t want to disturb the order of the original array, make a copy and sort the copy*/
$copy = $array;
arsort($copy);
?>
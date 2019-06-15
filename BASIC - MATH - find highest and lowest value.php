<?php 
/*

!!FIND HIGHEST & LOWEST VALUE!!

TIPS & EXPLANATIONS:
*max - Find highest value
	> mixed max ( array $values ) or mixed max ( mixed $value1 , mixed $value2 [, mixed $... ] )
	> If an empty array is passed, then FALSE will be returned and an error will be emitted
*min - Find lowest value
	> mixed min ( array $values ) or mixed min ( mixed $value1 , mixed $value2 [, mixed $... ] )
	> If an empty array is passed, then FALSE will be returned and an error will be emitted

*/


/*HIGHEST VALUE*/
echo max(2, 3, 1, 6, 7);  // 7
echo max(array(2, 4, 5)); // 5

// The string 'hello' when compared to an int is treated as 0
// Since the two values are equal, the order they are provided determines the result
echo max(0, 'hello');     // 0
echo max('hello', 0);     // hello

// Here we are comparing -1 < 0, so 'hello' is the highest value
echo max('hello', -1);    // hello

// With multiple arrays of different lengths, max returns the longest
$val = max(array(2, 2, 2), array(1, 1, 1, 1)); // array(1, 1, 1, 1)

// Multiple arrays of the same length are compared from left to right
// so in our example: 2 == 2, but 5 > 4
$val = max(array(2, 4, 8), array(2, 5, 1)); // array(2, 5, 1)

// If both an array and non-array are given, the array will be returned
// as comparisons treat arrays as greater than any other value
$val = max('string', array(2, 5, 7), 42);   // array(2, 5, 7)

// If one argument is NULL or a boolean, it will be compared against
// other values using the rule FALSE < TRUE regardless of the other types involved
// In the below example, -10 is treated as TRUE in the comparison
$val = max(-10, FALSE); // -10

// 0, on the other hand, is treated as FALSE, so is "lower than" TRUE
$val = max(0, TRUE); // TRUE



/*LOWEST VALUE*/
echo min(2, 3, 1, 6, 7);  // 1
echo min(array(2, 4, 5)); // 2

// The string 'hello' when compared to an int is treated as 0
// Since the two values are equal, the order they are provided determines the result
echo min(0, 'hello');     // 0
echo min('hello', 0);     // hello

// Here we are comparing -1 < 0, so -1 is the lowest value
echo min('hello', -1);    // -1

// With multiple arrays of different lengths, min returns the shortest
$val = min(array(2, 2, 2), array(1, 1, 1, 1)); // array(2, 2, 2)

// Multiple arrays of the same length are compared from left to right
// so in our example: 2 == 2, but 4 < 5
$val = min(array(2, 4, 8), array(2, 5, 1)); // array(2, 4, 8)

// If both an array and non-array are given, the array is never returned
// as comparisons treat arrays as greater than any other value
$val = min('string', array(2, 5, 7), 42);   // string

// If one argument is NULL or a boolean, it will be compared against
// other values using the rule FALSE < TRUE regardless of the other types involved
// In the below examples, both -10 and 10 are treated as TRUE in the comparison
$val = min(-10, FALSE, 10); // FALSE
$val = min(-10, NULL, 10);  // NULL

// 0, on the other hand, is treated as FALSE, so is "lower than" TRUE
$val = min(0, TRUE); // 0
?>
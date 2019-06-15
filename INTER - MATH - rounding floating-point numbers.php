<?php 
/*

!!ROUND FLOATING POINT NUMBERS!!

> round a floating-point number, either to an integer value or to a set number of decimal places
> round a number to the closest integer, see also set number of digits after the decimal point

*round - rounds a float 
*ceil - round fractions up
*floor - round fractions down

*/

$number = round(2.4);
printf("2.4 rounds to the float %s", $number); // 2

/*round up*/
$number = ceil(2.4);
printf("2.4 rounds up to the float %s", $number); // 3

/*round down*/
$number = floor(2.4);
printf("2.4 rounds down to the float %s", $number); // 2

/*If a number falls exactly between two integers, PHP rounds away from 0:*/
$number = round(2.5);
printf("Rounding a positive number rounds up: %s\n", $number); // 3
$number = round(-2.5);
printf("Rounding a negative number rounds down: %s\n", $number); // -3
?>
<?php 
/*

!!VERY LARGE & VERY SMALL NUMBERS!!

*bcadd - dd two arbitrary precision numbers
*gmp_strval - convert GMP number to string
*gmp_add - add numbers
*gmp_pow - raise number into power
*gmp_fact - factorial
*gmp_gcd - calculate GCD
*gmp_legendre - legendre symbol

*/


$sum = bcadd('1234567812345678', '8765432187654321');	// $sum = "9999999999999999"

/*OR*/

$sum = gmp_add('1234567812345678', '8765432187654321');
// $sum is now a GMP resource, not a string; use gmp_strval() to convert
print gmp_strval($sum); // prints 9999999999999999


/*Adding numbers using GMP*/
$four = gmp_add(2, 2); // You can pass integers
$eight = gmp_add('4', '4'); // Or strings
$twelve = gmp_add($four, $eight); // Or GMP resources


/*Computing fancy mathematical stuff using GMP*/
/*Raising a number to a power*/
$pow = gmp_pow(2, 10);
/*Computing large factorials very quickly*/
$factorial = gmp_fact(20);
/*Finding a GCD*/
$gcd = gmp_gcd(123, 456);
/*Other fancy mathematical stuff*/
$legendre = gmp_legendre(1, 7);
?>
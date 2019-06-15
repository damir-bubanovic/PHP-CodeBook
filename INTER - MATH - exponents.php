<?php 
/*

!!EXPONENTS - RAISE A NUMBER TO A POWER!!

*exp - calculates the exponent of e
*pow - exponential expression

*/


/*raise e to a power, use exp()*/
$exp = exp(2);	// $exp (e squared) is about 7.389

/*raise it to any power, use pow()*/
$exp = pow( 2, M_E);	// $exp (2^e) is about 6.58
$pow1 = pow( 2, 10);	// $pow1 (2^10) is 1024
$pow2 = pow( 2, -2);	// $pow2 (2^-2) is 0.25
$pow3 = pow( 2, 2.5);	// $pow3 (2^2.5) is about 5.656
$pow4 = pow(-2, 10);	// $pow4 ( (-2)^10 ) is 1024
$pow5 = pow(-2, -2.5);	/*is_nan($pow5) returns true, because fractional exponent of negative 2 is not a real number.*/
?>
<?php 
/*

!!TRIGONOMETRY!!

*cos - returns the cosine of the arg parameter
*atan - returns the arc tangent of arg in radians
*sin - returns the sine of the arg parameter
*tan - returns the tangent of the arg parameter
*deg2rad - converts the number in degrees to the radian equivalent

*/


/*use trigonometric functions, such as sine, cosine, and tangent*/
$result = cos(2 * M_PI); 	// cosine of 2 pi is 1, $result = 1
$result = atan(M_PI / 4);	// arctan of pi/4 is about 0.665773
/*function atan2() takes two variables $x and $y, and computes atan($x/$y)*/

/*secant, cosecant, and cotangent, you should manually calculate the reciprocal values of sin(), cos(), and tan()*/
$n = 0.707;
$secant = 1 / sin($n);		// secant of 0.707 is about 1.53951
$cosecant = 1 / cos($n);	// cosecant of 0.707 is about 1.31524
$cotangent = 1 / tan($n);	// cotangent of 0.707 is about 1.17051
/*use hyperbolic functions: sinh(), cosh(), and tanh(), plus, of course, asinh(), acosh(), and atanh()*/

/*Trigonometry in Degrees, Not Radians*/
$degree = 90;
$cosine = cos(deg2rad($degree));	// cosine of 90 degrees is 0
?>
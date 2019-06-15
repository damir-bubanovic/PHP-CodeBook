<?php 
/*

!!LOGARITAM!!

*log - natural logarithm

> log() and log10() are defined only for numbers that are greater than zero if number is = or < 0 returns NAN

*/


/*Take the logarithm of a number*/
/*For logs using base e (natural log), use log():*/
$log = log(10);	// $log is about 2.30258

/*For logs using base 10, use log10():*/
$log10 = log10(10);	// $log10 == 1

/*For logs using other bases, pass the base as the second argument to log():*/
$log2 = log(10, 2);	// log base 2 of 10 is about 3.32
?>
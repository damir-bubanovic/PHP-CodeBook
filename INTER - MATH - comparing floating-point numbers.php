<?php 
/*

!!COMPARING FLOATING POINT NUMBERS!!

> use small $delta value to check if numbers $a & $b have a smaller difference than $delta
> the size of your $delta should be the smallest amount of difference you care about between two numbers

*abs - absolute value

*/


$delta = 0.00001;

/*numbers to compare*/
$a = 1.00000001;
$b = 1.00000000;


if (abs($a - $b) < $delta) {
	print '$a and $b are equal enough.';
}
?>
<?php 
/*

!!VALIDATING FORM INPUT: CREDIT CARDS!!

> want to make sure a user hasn’t entered a bogus credit card number

*strrev - reverse a string
*preg_replace - perform a regular expression search and replace
*$_POST - an associative array of variables passed to the current script via the HTTP POST method

*/

/*Validating a credit card number*/
function is_valid_credit_card($s) {
	// Remove non-digits and reverse
	$s = strrev(preg_replace('/[^\d]/', '', $s));
	
	// compute checksum
	$sum = 0;
	for($i = 0, $j = strlen($s); $i < $j; $i++) {
		// Use even digits as-is
		if(($i % 2) == 0) {
			$val = $s[$i];
		} else {
			// Double odd digits and subtract 9 if greater than 9
			$val = $s[$i] * 2;
			if($val > 9) {
				$val -= 9;
			}
		}
		$sum += $val;
	}
	// Number is valid if sum is a multiple of ten
	return (($sum % 10) == 0);
}


if(is_valid_credit_card($_POST['credit_card'])) {
	print 'Sorry, that card number is invalid';
}

?>
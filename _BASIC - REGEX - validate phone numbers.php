	<!--USE with - _FORM - REGISTRATION - with resume.php-->
	<!--LOOK UP - _BASIC - REGEX - validate numbers.php, regex.php, validate email.php-->

<?php 
/*Regex phone number - acceptable phone format*/
$regex_phone = '/^[+][2-9]\d\d{1,2}\s\d{1,2}\s\d{3}-\d{3,4}$/';
/*if phone and regex variables are not matched*/
if(!preg_match($regex_phone, $phone)) {
	print '<p class="errot">Your phone number is invalid</p>';
	$output_form = 'yes';
} else {
	$pattern = '/[\+\s\-]/';
	$replacement = '';
	/*Standardize numbers for MySQL database to store only numbers with preg_replace*/
	$new_phone = preg_replace($pattern, $replacement, $phone);
}
?>
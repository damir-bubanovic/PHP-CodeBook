	<!--USE with - _BASIC - regex.php-->

<?php 
/*Validate numbers, phone, social security*/
$user_social_security = '555-02-9983';
$regex = '/^\d{3}-\d{2}-\d{4}$/';
if(preg_match($regex, $user_social_security)) {
	print 'Valid social security number!';
} else {
	print 'Invalid social security number';
}
?>
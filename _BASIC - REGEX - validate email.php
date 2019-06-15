	<!--USE with - _FORM - REGISTRATION - with resume.php-->
	<!--LOOK UP - _BASIC - regex.php, validate numbers.php, validate phone numbers.php _INTER(M) - validate email.php-->

<?php 
/*Regex email adresses - acceptable email format*/
/*Acceptable characters*/
$email_char = '[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/';
/*if email adress does not have acceptable these characters*/
if(!preg_match($email_char, $email)) {
	/*Email is not valid because LocalNape is bad*/
	print '<p class="error">This is not a valid email adress!</p>';
	$output_form = 'yes';
} else {
	/*Strip out everything but the domain from the email*/
	$pattern_email = '/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/';
	$replacement_email = '';
	$domain = preg_replace($pattern_email, $replacement_email, $email);
	/*if domain is not registered - 0 - not valid*/
	/*If web server is UNIX / LINUX*/
	if(!checkdnsrr($domain)) {
		print '<p class="error">The domain is not registered!</p>';	
		$output_form = 'yes';
	} 
}

/*If web server is WINDOWS*/
function win_checkdnsrr($domain,$recType='') {
	if (!empty($domain)) {
		if ($recType=='') $recType="MX";
		/*exec command calls an external program running on the server to check domain*/
		exec("nslookup -type=$recType $domain",$output);
			foreach($output as $line) {
				if (preg_match("/^$domain/", $line)) {
				return true;
				}
			}
		return false;
		}
	return false;
}
?>
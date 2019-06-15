<?php 
/*

!!SECURITY - PROTECTING AGAINST FORM SPOOFING!!

> want to be sure that a form submission is valid and intentional

> Protects against cross-site request forgeries (CSRF). 
	>> These attacks all cause a victim to send requests to a target site without the victim’s knowledge. 
		>>> Typically, the victim has an established level of privilege with the target site, 
		so these attacks allow an attacker to perform actions that the attacker cannot otherwise perform. 
			>>>> npr. imagine Alice is logged in via cookies to a social networking website, then visits another website. 
				That second website could display a form to Alice that looks harmless, but really submits itself to a URL 
				on that social networking website. 
				Because Alice’s browser would send login cookies along with the form submission, the social networking website 
				wouldn’t be able to distinguish this malicious form submission from a good one without CSRF protection.

*session_start - start new or resume existing session
*$_SESSION - associative array containing session variables available to the current script
*md5 - calculate the md5 hash of a string
*uniqid - generate a unique ID (!not so secure!)
*mt_rand - generate a better random value

*/


/*Add a hidden form field with a one-time token, and store this token in the user’s session*/
session_start();
$_SESSION['token'] = md5(uniqid(mt_rand(), true));

/*Form*/
?>

<form action="buy.php" method="POST">
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
    <p>Stock Symbol: <input type="text" name="symbol" /></p>
    <p>Quantity: <input type="text" name="quantity" /></p>
    <p><input type="submit" value="Buy Stocks" /></p>
</form>

<?php 
/*When you receive a request that represents a form submission, check the tokens to be
sure they match*/
session_start();

if(!isset($_SESSION['token'])) {
	/* Prompt user for password. */
} else {
	/* Continue. */
}

?>
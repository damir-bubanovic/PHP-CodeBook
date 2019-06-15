	<!--USE with _BASIC - CAPTCHA - image.php, _CAPTCHA - addhighscore.php, captcha_script.php-->

<?php 
/*

!!CAPTCHA - characters!!

*define - defines a named constant
*chr - returns a one-character string containing the character specified by ascii.
*rand - generate a random integer


*/

/*CAPTCHA pass-phrase six characters long - optimum for bots and humans*/
define('CAPTCHA_NUMCHARS', 6);

/*Generiramo random pass-phrase*/
$pass_phrase = '';
/*Loop-am kroz svaki character u pass-phrase - u našem slučaju 6 puta*/
for($i = 0; $i < CAPTCHA_NUMCHARS; $i++) {
	/*chr() - convert numbers to letters - range 97-122 = a-z*/
	/*rand() - generates random number from defined range*/
	$pass_phrase .= chr(rand(97, 122));
}
?>
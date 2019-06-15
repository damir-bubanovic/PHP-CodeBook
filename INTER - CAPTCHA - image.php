	<!--USE with _BASIC - CAPTCHA - characters.php, _CAPTCHA - addhighscore.php, captcha_script.php-->

<?php 
/*

!!CAPTCHA - image!!

*define - defines a named constant
*imagecreatetruecolor - create a new true color image
*imagecolorallocate - allocate a color for an image
*imagefilledrectangle - draw a filled rectangle
*imageline - draw a line
*rand - generate a random integer
*imagesetpixel - set a single pixel
*imagettftext - write text to the image using TrueType fonts
*header - send a raw HTTP header
*imagepng - output a PNG image to either the browser or a file
*imagedestroy - destroy an image

*/


/*Size of CAPTCHA image - for easier adjustment later on*/
define('CAPTCHA_WIDTH', 100);
define('CAPTCHA_HEIGHT', 25);


/*Create image - novo stvorena slika počinje kao prazna crna background*/
$img = imagecreatetruecolor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT);

/*Set a white background with black text and gray graphics - RGB colors - stvaramo boje za GD funkcije*/
/*white*/
$bg_color = imagecolorallocate($img, 255, 255, 255);
/*black*/
$text_color = imagecolorallocate($img, 0, 0, 0);
/*dark grey*/
$graphic_color = imagecolorallocate($img, 64, 64, 64);

/*Fill the background - crtamo bijelu background da možemo nacrtati CAPTCHA*/
imagefilledrectangle($img, 0, 0, CAPTCHA_WIDTH, CAPTCHA_HEIGHT, $bg_color);

/*Draw some random lines - 5 lines*/
for($i = 0; $i < 5; $i++) {
	/*image, x and y starting point for lines, color at the end*/
	imageline($img, 0, rand() % CAPTCHA_HEIGHT, CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
}

/*Random dots*/
for($i = 0; $i < 50; $i++) {
	imagesetpixel($img, rand() % CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
}

/*Draw the pass-phrase string - crtamo text u tamnim bojama preko linija i dots*/
imagettftext($img, 18, 0, 5, CAPTCHA_HEIGHT - 5, $text_color, 'Courier New Bold.ttf', $pass_phrase);

/*Output the image as a PNG using a header*/
/*You can output image to <img> tag*/
header("Content-type: image/png");
imagepng($img);

/*Clear image from memory*/
imagedestroy($img);
?>
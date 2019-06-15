<?php 
<?php
/*

!!CONVERTING BETWEEN BASES!!

> Convert a number from one base to another

*base_convert - convert a number between arbitrary bases
*bindec - binary to decimal
*octdec - octal to decimal
*hexdec - hexadecimal to decimal
*decbin - decimal to binary
*decoct - decimal to octal
*dechex - decimal to hexadecimal

*/



/*hexadecimal number (base 16)*/
$hex = 'a1';
/*convert from base 16 to base 10, $decimal is '161'*/
$decimal = base_convert($hex, 16, 10);

/*convert from base 2 to base 10*/
// $a = 27
$a = bindec(11011);

/*convert from base 8 to base 10*/
// $b = 27
$b = octdec(33);

/*convert from base 16 to base 10*/
// $c = 27
$c = hexdec('1b');

/*convert from base 10 to base 2*/
// $d = '11011'
$d = decbin(27);
// $e = '33'
$e = decoct(27);
// $f = '1b'
$f = dechex(27);

/*Print out HTML color values*/
$red = 0;
$green = 102;
$blue = 204;
/*$color is '#0066CC'*/
$color = sprintf('#%02X%02X%02X', $red, $green, $blue);
?>
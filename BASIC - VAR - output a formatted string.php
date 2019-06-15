<?php 
/*

!!OUTPUT A STRING!!

*printf - output a string
	> int print ( string $arg )

*/


$value = 13;
printf("%d<br />",$value); 	//	13			(decimalni broj)
printf("%b<br />",$value); 	//	1101		(binarni broj)
printf("%c<br />",$value); 	//				(ASCII vrijednost)
printf("%f<br />",$value); 	//	13.000000	(floating-point broj (locale aware))
printf("%o<br />",$value); 	//	15			(octal broj)
printf("%s<br />",$value); 	//	13			(string broj)
printf("%x<br />",$value); 	//	d			(hexadecimal broj (mala slova))
printf("%X<br />",$value);	//	D			(hexadecimal broj (velika slova))

?>
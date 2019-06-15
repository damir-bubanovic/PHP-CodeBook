<?php 
/*

!!FORMATING MONETARY VALUES!!

> ISO-4217 specifies the three-letter codes to use for the various currencies of Earth

*/


/*print number with thousands and decimal separators*/
$number = 1234.56;

/*US uses $ , and . $formatted1 is $1,234.56*/
$usa = new NumberFormatter("en-US", NumberFormatter::CURRENCY);
$formatted1 = $usa->format($number);
/*France uses , and € $formatted2 is 1 234,56 €*/
$france = new NumberFormatter("fr-FR", NumberFormatter::CURRENCY);
$formatted2 = $france->format($number);

/*produce currency other than the locale’s native currency*/
$number = 1234.56;
/*US uses € , and . for Euro $formatted is €1,234.56*/
$usa = new NumberFormatter("en-US", NumberFormatter::CURRENCY);
$formatted = $usa->formatCurrency($number, 'EUR');
?>
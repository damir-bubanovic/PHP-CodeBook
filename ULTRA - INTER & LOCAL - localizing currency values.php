<?php 
/*

!!INTER & LOCAL - LOCALIZING CURRENCY VALUES!!

> want to display currency amounts in a locale-specific format

*/


/*For default formatting inside a message, use the currency style 
of the number argument type*/
$income =5549.3;
$debit = -25.95;

$fmt = new MessageFormatter(
	'en_US', '{0,number,currancy} in and {1,number,currency} out'
);
print $fmt->format(array($income, $debit));
/*
OUTPUT:
$5,549.30 in and -$25.95 out
*/



/*For more specific formatting, use the formatCurrency() method of a NumberFormatter*/
$income = 5549.3;
$debit = -25.95;

$fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
print $fmt->formatCurrency($income, 'USD') . ' in and ' . $fmt->formatCurrency($debit, 'EUR') . ' out';
/*
OUTPUT:
$5,549.30 in and -€25.95 out
*/



/*Although you can construct complex currency formatting rules with the decimal format
patterns that MessageFormatter understands, it is often clearer to express those needs
via the programmatic interface NumberFormatter provides*/
$amounts = array(
	array(152.9, 'USD'),
	array(328, 'ISK'),
	array(-1, 'USD'),
	array(500.53, 'EUR') 
);

$fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
$fmt->setAttribute(NumberFormatter::PADDING_POSITION, NumberFormatter::PAD_AFTER_PREFIX);
$fmt->setAttribute(NumberFormatter::FORMAT_WIDTH, 15);
$fmt->setTextAttribute(NumberFormatter::PADDING_CHARACTER, ' ');

foreach($amounts as $amount) {
	print $fmt->formatCurrency($amount[0], $amount[1]) . "\n";
}
/*
OUTPUT:
$ 152.90
ISK 328
-$ 1.00
€ 500.53
*/

?>
<?php 
/*IMAŠ 2 VERZIJE (IF i SWITCH)*/
?>

<?php 
$weekday = date("l");
$tax_rate = 4;
if($weekday === "Monday") {
	$discount = $tax_rate * 0.05;
} else if($weekday === "Tuesday") {
	$discount = $tax_rate * 0.06;
} else if($weekday === "Wednesday") {
	$discount = $tax_rate * 0.07;
} else if($weekday === "Thursday") {
	$discount = $tax_rate * 0.08;
} else if($weekday === "Friday") {
	$discount = $tax_rate * 0.09;
}
print $weekday . "'s discount is: $" . $discount;
?> 

<?php 
$today = date("l");
$tax_rate = 0;
switch($today) {
	case "Monday" :
		$tax_rate += 2;
		break;
	case "Tuesday" :
		$tax_rate += 3;
		break;
	case "Wednesday" :
		$tax_rate += 4;
		break;
	case "Thursday" :
		$tax_rate += 5;
		break;
	case "Friday" :
		$tax_rate += 6;
		break;
	default :
		$tax_rate += 0;
}
print $today . "'s discount is: " . $tax_rate;
?>
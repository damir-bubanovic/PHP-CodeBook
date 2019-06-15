<?php 
/*

!!SORT ARRAY WITH METHOD!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

*usort - sort an array by values using a user-defined comparison function
*strcmp - binary safe string comparison

*/


/*Define a custom sorting routine to order an array with use an object method*/
/*Pass in an array holding a class name and method in place of the function name*/
usort($access_times, array('dates', 'compare'));


/*object method needs to take two input arguments and return 1, 0, or −1*/
class sort {
	// reverse-order string comparison
	static function strrcmp($a, $b) {
		return strcmp($b, $a);
	}
}
usort($words, array('sort', 'strrcmp'));

/*It must also be declared as static. Alternatively, you can use an instantiated object*/
class Dates {
	public function compare($a, $b) { /* compare here */ }
}
$dates = new Dates;
usort($access_times, array($dates, 'compare'));
?>
<?php 
/*

!!DEFINING STATIC PROPERTIES & METHODS!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method
						
*number_format - format a number with grouped thousands

*/


/*define methods in an object, and be able to access them without instantiating a object (invoke those methods without instantiating a object)*/
class Format {
	public static function number($number, $decimals = 2, $decimal = '.', $thousands = ',') {
		return number_format($number, $decimals, $decimal, $thousands);
	}
}

print Format::number(1234.567);


/*Within the class where the static method is defined, refer to it using self*/
class Format {
	public static function number($number, $decimals = 2, $decimal = '.', $thousands = ',') {
		return number_format($number, $decimals, $decimal, $thousands);
	}
	
	public static function integer($number) {
		return self::number($number, 0);
	}
}

print Format::number(1234.567) . "\n";
print Format::integer(1234.567) . "\n";

/*Više na str 219*/
?>
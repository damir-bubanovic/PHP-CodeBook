<?php 
/*

!!ERRORS - PRINTING A STACK TRACE!!

> want to know what’s happening at a specific point in your program, 
and what happened leading up to that point

1. option) debug_print_backtrace() function allows you to quickly get a sense of what has 
been been going on in your application immediately before you called a particular
function
	>> The more complicated your application, the more information you can expect 
	to have returned from the backtrace functions
	>> For debugging larger codebases, you may achieve bug-hunting success more quickly 
	using a full debugging extension, such as Xdebug, or an integrated development 
	environment (IDE), such as NetBeans, 
		+) supports setting breakpoints
		+) stepping in and out of blocks of code
		+) watching the evolution of variables...
> If all you need is a little more information than you can get from sprinkling print: 
	'Here I am on line ' . LINE; statements throughout your code, debug_print_back trace()


2. option) debug_backtrace() - Instead of outputting the backtrace, debug_backtrace() 
returns it as an array, one element per stack frame. 
	>> useful if you only need to print certain elements of the backtrace, or you
	want to manipulate it programmatically

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method


*debug_print_backtrace - prints a backtrace
*debug_backtrace - generates a backtrace
*count - count all elements in an array, or something in an object

*/


/*Use debug_print_backtrace()*/
function stooges() {
	print "woo woo woo!\n";
	larry();
}

function larry() {
	curly();
}

function curly() {
	moe();
}

function moe() {
	debug_print_backtrace();
}

stooges();
/*
OUTPUT:
woo woo woo! 
#0 moe() called at [C:\wamp\www\dwwithphp\index.php:23] 
#1 curly() called at [C:\wamp\www\dwwithphp\index.php:19] 
#2 larry() called at [C:\wamp\www\dwwithphp\index.php:15] 
#3 stooges() called at [C:\wamp\www\dwwithphp\index.php:30]
*/



/*Using debug_backtrace()*/
function print_parsed_backtrace() {
	$backtrace = debug_backtrace();
	
	for($i = 1, $j = count($backtrace); $i < $j; $i++) {
		$frame = $backtrace[$i];
		
		if(isset($frame['class'])) {
			$function = $frame['class'] . $frame['type'] . $frame['function'];
		} else {
			$function = $frame['function'];
		}
		
		print $function . '()';
		
		if($i != ($j - 1)) {
			print ', ';
		}
	}
}


function stooges() {
	print "woo woo woo!\n";
	Fine:larry();
}


class Fine {
	static function larry() {
		$brothers = new Howard;
		$brothers->curly();
	}
}


class Howard {
	
	function curly() {
		$this->moe();
	}
	
	function moe() {
		print_parser_backtrace();
	}
}

stooges();
/*
OUTPUT:
woo woo woo!
Howard->moe(), Howard->curly(), Fine::larry(), stooges()
*/

?>
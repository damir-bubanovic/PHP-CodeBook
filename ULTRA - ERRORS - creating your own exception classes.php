<?php 
/*

!!ERRORS - CREATING YOUR OWN EXCEPTION CLASSES!!

> You want control over how (or if) error messages are displayed to users, even though
you’re using several third-party libraries that each have their own views on handling
errors

> Use PHP 5’s support for exceptions to create your own exception handler
that will do your bidding when errors occur in third-party libraries

> ADVANTAGE of CustomException class 
	+) log everything you can about what happened
	+) be as cool as possible from the user’s perspective
	
> Primary difference between a standard error handler and exceptions is the concept of recovery. 
	>> The idea is that your custom handler can contain a clean-up routine that checks the state 
	of the applicationat the time that the custom exception is caught, cleans up as best as it can, 
	and dies gracefully.


> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

*__construct - this function creates an object (function to do something)
*__toString - allows a class to decide how it will react when it is treated like a string
    		  This method must return a string
*file_get_contents - reads entire file into a string

*/


class CustomException extends Exception {
	
	public function __construct($e) {
		// make sure everything is assigned properly
		parent::__construct($e->getMessage(), $e->getCode());
		
		// log what we know
		$msg = "------------------------------------------------\n";
		$msg .= __CLASS__ . ": [{$this->code}]: {$this->message}\n";
		$msg .= $e->getTraceAsString() . "\n";
		
		error_log($msg);
	}
	
	
	// overload the __toString() method to suppress any "normal" output
	public function __toString() {
		return $this->printMessage();
	}
	
	
	// map error codes to output messages or templates
	public function printMessage() {
		$usermsg = '';
		$code = $this->getCode();
		
		switch($code) {
			case SOME_DEFINED_ERROR_CODE:
				$usermsg = 'Ooops! Sorry about that.';
				break;
			case OTHER_DEFINED_ERROR_CODE:
				$usermsg = "Drat";
				break;
			default:
				$usermsg = file_get_contents('/templates/general_error.html');
				break;
		}
		return $usermsg;
	}
	
	
	// static exception_handler for default exception handling
	public static function exception_handler($exception) {
		throw new CustomException($exception);
	}
}

// make sure to catch every exception
set_exception_handler('CustomException::exception_handler');
try {
	$obj = new CoolThirdPartyPackage();
} catch(CustomException $e) {
	print $e;
}


/*
> Exceptions are a common construct in many other languages, they’re used to deal gracefully 
with unforeseen error conditions.
	>> useful when including third-party library code in your scripts when you’re not 100%
	 confident how that code will behave in unpredictable circumstances npr:
	 	+) loss of database connectivity, 
		+) unresponsive remote API server,
		+) similar acts of randomness
		+) ...


USE try/catch structure you use to create a sandboxed section of your script where things 
can go horribly wrong without hurting anything else
*/
try {
	// do something
	$obj = new CoolThing();
} catch(CustomException $e) {
	// at this point, the CoolThing wasn't cool
	print $e;
}



/*Exceptions can also be used to easily recover from an error in the midst of an application’s
flow. 
	> npr. a try block can have multiple catch blocks that are somewhat neater than a bunch of 
	if/else/else/else blocks*/
try {
	// do something
	$obj = new CoolThing();
} catch(PossibleException $e) {
	// we thought this could possibly happen
	print "<!-- caught exception $e! -->";
	$obj  =new PlanB();
} catch(AnotherPossibleException $e) {
	// we knew about this possibility as well
	print "<!-- aha! caught exception $e -->";
	$obj = new PlanC();
} catch(CustomException $e) {
	// if all else fails, go to clean-up
	$e->cleanUp();
	$e->bailOut();
}

?>
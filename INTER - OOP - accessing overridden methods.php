<?php 
/*

!!ACCESS OVERIDDEN METHOD!!

> parent::methodName();

*/

/*Access a method in the parent class that’s been overridden in the child*/
class shape {
	function draw() {
		// write to screen
	}
}

class circle extends shape {
	
	function draw($origin, $radius) {
		/*validate data*/
		if($radius > 0) {
			parent::draw();
			return true;
		} else {
			return false;
		}
	}	
}
?>
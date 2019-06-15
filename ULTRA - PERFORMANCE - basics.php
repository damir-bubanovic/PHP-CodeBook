<?php 
/*

!!PERFORMANCE - BASICS!!

> PHP is pretty speedy. 
	>> Slow parts of your PHP programs:
		+) external resources—waiting for a database query to finish 
		+) contents of a remote URL to be retrieved
		
	+> Optimize too early and you’ll spend too much time nitpicking over details that may not be 
	important in the big picture
	+) Optimize too late and you may find that you have to rewrite large chunks of your application
		
		
> As you tweak your code, you’re not just adjusting raw execution time—you’re 
also affecting code size, readability, and maintainability.


> Installing a code accelerator is the best thing you can do to improve performance
	>> As of PHP 5.5, PHP bundles and builds the Zend OPcache PHP accelerator
	
> One of the most common bottlenecks in many PHP scripts is misuse of regular expressions

*/

?>
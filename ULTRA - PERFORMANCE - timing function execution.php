<?php 
/*

!!PERFORMANCE - TIMING FUNCTION EXECUTION!!

> You have a function and you want to see how long it takes to execute

> Compare time in milliseconds before running the function against the time in milliseconds
after running the function to see the elapsed time spent in the function itself

> The dark side of optimization with head-to-head tests like these, though, is that you
need to figure in how frequently the function is called in your code and how readable
and maintainable the alternative is

*uniqid - generate a unique ID
*php_uname - returns information about the operating system PHP is running on
*microtime - return current Unix timestamp with microseconds
*md5 - calculate the md5 hash of a string
*bin2hex - convert binary data into hexadecimal representation
*mhash - computes hash
*hash - generate a hash value (message digest)

*/


/*EXAMPLE*/
// create a long nonsense string
$long_str = uniqid(php_uname('a'), true);

// start timing from here
$start = microtime(true);

// function to test
$md5 = md5($long_str);
$elapsed = microtime(true) - $start;

print "That took $elapsed seconds.\n";




/*To determine how much time a single function takes to execute, you may not need a
full benchmarking package. 
Instead, you can get the information you need from the microtime() function*/

/*Here are three ways to produce the exact same MD5 hash in PHP*/
// PHP's basic md5() function
$hashA = md5('optimize this!');

// MD5 by way of the mhash extension
$hashB = bin2hex(mhash(MHASH_MD5, 'optimize this!'));

// MD5 with the hash() function
$hashC = hash('md5', 'optimize this!');

?>
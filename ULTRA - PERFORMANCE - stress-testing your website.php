<?php 
/*

!!PERFORMANCE - STRESS-TESTING YOUR WEBSITE!!

> You want to find out how well your website performs under a heavy load

> Use a stress-testing and benchmarking tool to simulate a variety of load levels


> Stress testing is frequently confused with benchmarking, and it is important to recognize
the difference between the two activities.
	1) Benchmarking a website is often a somewhat casual activity when performed by an
	individual developer. 
		+) The most commonly used tool is the Apache HTTP server bench marking tool, ab, 
		which is designed to test how many requests per second an HTTP server is capable of serving
	2) Stress testing is a testing technique whose intent is to break your web application. 
		>> By testing to a breaking point, you can identify and repair weaknesses in your application,
		or gain a better understanding of when you will need to add additional hardware. 
		>> When combined with code profiling, you can also get an idea of what part of your application
		will need to scale first; 
			>>> npr. will you need to add more servers to your database cluster before you need to add 
			more frontend web server machines?
		+) An excellent open source tool for stress testing is Siege. 
		+) Lincoln Stein’s torture.pl script is a good alternative. 
*/

?>
<?php 
/*

!!PERFORMANCE - PROFILING WITH A DEBUGGER EXTENSION!!

> You want a robust solution for profiling your applications so that 
you can continually monitor where the program spends most of its time

> Use Xdebug, available from PECL. 
	>> With Xdebug installed, adding xdebug.profil er_enable=1 to your php.ini configuration dumps a 
	trace file to disk. 
	>> Parsing that trace file with a tool gives you a breakdown of how time was spent during that 
	run of the PHP script
	>> To conditionally generate this data, set xdebug.profiler_enable to off and xde bug.profiler_enable_trigger to on. 
	In this configuration, Xdebug will only profile when you pass in a GET, POST, or Cookie variable named XDEBUG_PROFILE 
	set to any value

> For complex applications, profiling dumps can be quite large; this prevents you from running out of disk space. 
> Also, though not ideal, in the event you cannot replicate a problem in your testing environment, you can more safely
run Xdebug in production

> The output files generated by Xdebug can be stored anywhere you want them, as long as it’s writable by PHP. 
	>> Set the directory using the xdebug.profiler_output_dir configuration variable and the filename using 
	xdebug.profiler_output_name
	>> By default, the output filename is cachegrind.out. followed by the process ID
	
> Process the output files with an application to more easily view and understand the data.
	>> The longest-running functions are good places to start when looking for opportunities to optimize
	
> A popular tool is KCachegrind, a GUI application used to drill down deeply into applications
to determine where hotspots and bottlenecks are occurring

*/


/*As a (simplistic) example, this code prints the first 50 factorial numbers*/
function factorial($x) {
	return ($x == 1) ? 1 : $x * factorial($x - 1);
}

for($i = 1; $i <= 50; $i++) {
	print "$i: " . factorial($i) . "\n";
}


/*Inspecting profiling results in QCachegrind*/
function factorial($x) {
	static $cache = [];
	
	if(isset($cache[$x])) {
		return $cache[$x];
	}
	
	$cache[$x] = (($x == 1) ? 1 : $x * factorial($x - 1));
	return $cache[$x];
}

for($i = 1; $i <= 50; $i++) {
	print "$i: " . factorial($i) . "\n";
}

?>
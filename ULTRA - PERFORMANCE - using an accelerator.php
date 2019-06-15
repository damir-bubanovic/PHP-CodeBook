<?php 
/*

!!PERFORMANCE - USING AN ACCELERATOR!!

> want to increase performance of your PHP applications

> Use the Zend OPcache code-caching PHP accelerator to allow PHP to avoid 
compiling scripts into opcodes on each request

> Though PHP 5.5 builds Zend OPcache, you still need to turn it on by editing your php.ini
file to add a reference to the full path of the extension: 
	zend_extension=/path/to/php/lib/php/extension/debug-non-zts-20121212/opcache.so

> Although you should see a large improvement immediately, you can further improve
performance with additional tuning. 
	>> As a start, update your production configuration parameters to:
		opcache.memory_consumption=128
		opcache.interned_strings_buffer=8
		opcache.max_accelerated_files=4000
		opcache.revalidate_freq=60
		opcache.fast_shutdown=1
		opcache.enable_cli=1


LOOK UP - more on the topic Zend Opcache

*/

?>
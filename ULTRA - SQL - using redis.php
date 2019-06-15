<?php 
/*

!!SQL - USING REDIS!!

> want to use the Redis key-value store from your PHP program

*/


/*If you can install PECL extensions, install the redis extension and then use it as follows*/
$redis = new Redis();
$redis->connect('127.0.0.1');
$redis->set('counter', 0);
$redis->incrBy('counter', 7);
$counter = $redis->get('counter');
print $counter;


/*If you can’t, use the Predis library*/
require 'Predis/Autoloader.php';
Predis\Autoloader::register();

$redis = new Predis\Client(array('host' => '127.0.0.1'));
$redis->set('counter', 0);
$redis->incrBy('counter', 7);
$counter = $redis->get('counter');
print $counter;


/*To install the redis extension, use the pecl command:*/
pecl install redis

/*To install Predis, use pear:*/
pear channel-discover pear.nrk.io
pear install nrk/Predis

?>
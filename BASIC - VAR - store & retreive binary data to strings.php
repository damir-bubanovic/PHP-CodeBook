<?php 
/*

!!STORE BINARY DATA TO STRINGS!!

*pack - Pack data into binary string
	> string pack ( string $format [, mixed $args [, mixed $... ]] )
	> pogledaj format characters na php.net
*unpack - Unpack data from binary string
	> array unpack ( string $format , string $data )
	> pogledaj format characters na php.net

*/


/*Pack*/
$packed = pack('S4',1974,106,28225,32725);

/*Unpack*/
$nums = unpack('S4',$packed);
?>
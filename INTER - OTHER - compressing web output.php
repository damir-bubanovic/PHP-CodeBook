<?php 
/*

!!COMPRESSING WEB OUTPUT!!

> send compressed content to browsers that support automatic decompression
> at higher compression levels, less data needs to be sent from the server to the browser, but more server CPU time must be used to compress the data

*/


/*Add this setting to your php.ini file*/
zlib.output_compression = 1


/*Adjust the compression level with the zlib.output_compression_level configuration directive*/
; minimal compression
zlib.output_compression_level=1

; maximal compression
zlib.output_compression_level=9
?>
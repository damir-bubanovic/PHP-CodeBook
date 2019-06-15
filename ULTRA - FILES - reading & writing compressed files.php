<?php 
/*

!!FILES - READING & WRITING COMPRESSED FILES!!

> You want to read or write compressed files

> Use the compress.zlib or compress.bzip2 stream wrapper with the standard file functions

> In addition to the stream wrappers, which allow access to compressed local files, there
are stream filters that compress (or uncompress) arbitrary streams on the fly. The
zlib.deflate and zlib.inflate filters compress and uncompress data according to
the zlib “deflate” algorithm. The bzip2.compress and bzip2.uncompress filters do the
same for the bzip2 algorithm

*fopen - opens file or URL
*fgets - gets line from file pointer
*fclose - closes an open file pointer
*stream_filter_append - attach a filter to a stream
*fread - binary-safe file read

*/


/*To read data from a gzip-compressed file*/
$file = __DIR__ . '/lots-of-data.gz';

$fh = fopen("compress.zlib://$file", 'r') or die("Can't open: $php_errormsg");
if($fh) {
	while($line = fgets($fh)) {
		// $line is the next line of uncompressed data
	}
	fclose($fh) or die("Can't close: $php_errormsg");
}



/*Each stream filter must be applied to a stream after it is created. This example 
uses the bzip2 stream filters to read compressed data from a URL*/
$fp = fopen('http://www.example.com/something-compressed.bz2', 'r');

if($fp) {
	stream_filter_append($fp, 'bzip2.uncompress');
	
	while(!feof($fp)) {
		$data = fread($fp);
		// do something with $data;
	}
	fclose($fp);
}

?>
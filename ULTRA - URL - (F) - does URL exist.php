<?php 
/*

!!DOES URL EXIST!!

*str_replace - replace all occurrences of the search string with the replacement string
*strstr - find the first occurrence of a string
*explode - split a string by string
*fsockopen - open Internet or Unix domain socket connection
*fputs - binary-safe file write (fwrite)
*fread - binary-safe file read

*/

function url_exists($url) {
	$url = str_replace('http://', '', $url);
	
	if(strstr($url, '/')) {
		$url = explode('/', $url, 2);
		$url[1] = '/' . $url[1];
	} else {
		$url = array($url, '/');
	}
	
	$fh = fsockopen($url[0], 80);
	if($fh) {
		fputs($fh, 'GET ' . $url[1] . " HTTP/1.\nHost:" . $url[0] . "\n\n");
		if(fread($fh, 22) == 'HTTP/1.1 404 Not Found') {
			return FALSE;
		} else {
			return TRUE;
		}
	} else {
		return FALSE;
	}
}
?>
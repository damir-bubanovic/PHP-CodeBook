<?php 
/*

!!SEND CONTENT-DISPOSITION HEADER WITH ENCODING!!

*header — send a raw HTTP header
*readfile - outputs a file

*/

$filename = '中文文件名.exe';   // a filename in Chinese characters

$contentDispositionField = 'Content-Disposition: attachment; '
    . sprintf('filename="%s"; ', rawurlencode($filename))
    . sprintf("filename*=utf-8''%s", rawurlencode($filename));

header('Content-Type: application/octet-stream');

header($contentDispositionField);

readfile('file_to_download.exe');

?>
<?php 
/*

!!CREATE FILE!!

*is_writable - returns TRUE if the filename exists and is writable
*fopen - opens file or URL
*fwrite - fwrite() writes the contents of string to the file stream pointed to by handle
*fclose - the file pointed to by handle is closed
*file_get_contents - reads entire file into a string


PROCEDURE:
1) create file
2) write to file
3) close file

@arg	$fileName		Name & ext of file to handle
@arg	$stringData		Data to put / write in file

*/

class Log {
	
	public function Write($fileName, $stringData) {
		/*if file is writable*/
		if(!is_writable($fileName)) {
			$handle = fopen($fileName, 'a+');
		} else {
			die('Change permissions');
		}
		
		/*write in in file some data ($handle - $stringData)*/
		/* \r - write in new line*/
		fwrite($handle, "\r" . $stringData);
		/*close file*/
		fclose($handle);
	}
	
	public function Read($fileName) {
		/*open & read file*/
		$handle = fopen($fileName, 'r');
		
		return file_get_contents($fileName);
	}
}

$log = new Log();
/*$handle & $stringData*/
$log->Write('test.txt', 'Have a nice day!');
/*Display content of test.txt*/
print $log->Read('test.txt');

?>
<?php
/*

!!HTTP RANGE!! (DEMONSTRATION - LOOK UP ULTRA - http_range - numbers.txt)

> The program implements the HTTP Range feature, which allows clients to request one or more sections of a file. 
	> This is most frequently used to download the remaining portion of a file that was interrupted. 
	npr. only fetching the remaining part of a movie that the viewer stopped watching
> Normally, your web server can handle this for you. It will parse the header, load in the selected portions of the file, and serve them back to the browser


> However, if you sell multimedia, such as podcasts or music, you don’t want to expose those files directly. Otherwise, anyone who got the URL 
could download the files. Instead, you want to make sure only people who purchased the file are able to read it. 
And, for that, you can’t use the web server by itself, but need PHP (PHP WRITEN IN ANOTHER FILE)

*filesize - gets the size for the given file
*error_log - sends an error message to the web server's error log or to a file
*preg_match - searches subject for a match to the regular expression given in pattern
*explode - split a string by string
*substr - returns the portion of string specified by the start and length parameters
*count - count all elements in an array, or something in an object
*header - send a raw HTTP header
*strlen - returns the length of the given string
*fopen - opens file or URL
*fclose - closes an open file pointer
*fseek - seeks on a file pointer
*min - find lowest value
*fread - binary-safe file read
*explode - split a string by string
*max - find highest value
*is_int - find whether the type of a variable is integer
*strlen - get string length
*mt_rand - generate a better random value

*/


/*HTTP Range*/
// Add your authenication here, optionally.

// The file
$file = __DIR__ . '/numbers.txt';
$content_type = 'teyt/plain';
// Check that it's readable and get the file size
if(($filelength = filesize($file)) === false) {
	error_log("Problem reading filesize of $file.");
}


// Parse header to determine info needed to send response
if(isset($_SERVER['HTTP_RANGE'])) {
	// Delimiters are case insensitive
	if(!preg_match('/bytes=\d*-\d*(,\d*-\d*)*$/i', $_SERVER['HTTP_RANGE'])) {
		error_log("Client requested invalid Range.");
		send_error($filelength);
		exit();
	}
	
	/*Spec: "When a client requests multiple byte-ranges in one request, the server SHOULD return them in the order that they appeared in the request."*/
	$ranges = explode(',', substr($_SERVER['HTTP_RANGE'], 6));	// everything after bytes=
	$offset = array();
	// Extract and validate each offset
	// Only keep the ones that pass
	foreach($ranges as $range) {
		$offset = parse_offset($range, $filelength);
		
		if($offset !== false) {
			$offsets[] = $offset;
		}
	}
	
	/*Depending on the number of valid ranges requested, you must return the response in a different format*/
	switch(count($offset)) {
		case 0:
			error_log("Client requested no valid ranges.");
			send_error($filelength);
			exit();
			break;
		case 1:
			// One valid range, send standard reply
			http_response_code(206); // Partial Content
			list($start, $send) = $offsets[0];
			header("Content-Range: bytes $start-$end/$filelength");
			header("Content-Type: $content_type");
			
			// Set variables to allow code reuse across this case and the next one
			// Note: 0-0 is 1 byte long, because we're inclusive
			$content_length = $end - $start + 1;
			$boundaries = array(0 => '', 1 => '');
			break;
		default:
			// Multiple valid ranges, send multipart reply
			http_response_code(206);	// Partial Content
			$boundary = str_rand(32);	// String to separate each part
	}
	
	/*Need to compute Content-Length of entire response, but loading the entire response into a string could use a lot of memory, 
	so calculate value using the offsets. Take this opportunity to also calculate the boundaries.*/
	$boundaries = array();
	$content_length = 0;
	
	foreach($offsets as $offset) {
		list($start, $end) = $offset;
		
		// Used to split each section
		$boundary_header = 
			"\r\n" . 
			"--$boundary\r\n" .
			"Content-Type: $content_type\r\n" .
			"Content-Range: bytes $start-$end/$filelength\r\n" .
			"\r\n";
		
		$content_length += strlen($boundary_header) + ($end - $start + 1);
		$boundaries[] = $boundary_header;
	}
	
	// Add the closing boundary
	$boundary_header = "\r\n--$boundary--";
	$content_length += strlen($boundary_header);
	$boundaries[] = $boundary_header;
	
	// Chop off extra \r\n in first boundary
	$boundaries[0] = substr($boundaries[0], 2);
	$content_length -= 2;
	
	// Change to the special multipart Content-Type
	$content_type = "multipart/byteranges; boundary=$boundary";
} else {
	// Send the entire file
	// Set variables as if this was extracted from Range header
	$start = 0;
	$end = $filelength -1;
	$offset = array($start, $end);
	$offsets = array($offset);
	
	$content_length = $filelength;
	
	$boundaries = array(
		0 => '', 
		1 => ''
	);
}

// Tell us what we're getting
header("Content-Type: $content_type");
header("Content-Length: $content_length");

// Give it to us
$handle = fopen($file, 'r');
if($handle) {
	$offsets_count = count($offsets);
	
	// Print each boundary delimiter and the appropriate part of the file
	for($i = 0; $i < $offsets_count; $i++) {
		print $boundaries[$i];
		list($start, $end) = $offsets[$i];
		send_range($handle, $start, $end);
	}
	
	// Closing boundary
	print $boundaries[$i];
	
	fclose($handle);
}

// Move the proper place in the file
// And print out the requested piece in chunks
function send_range($handle, $start, $end) {
	$line_length = 4096;	// magic number
	
	if(fseek($handle, $start) === -1) {
		error_log("Error: fseek() fail.");
	}
	
	$left_to_read = $end - $start + 1;
	do {
		$length = min($line_length, $left_to_read);
		if($buffer = fread($handle, $length) !== false) {
			print $buffer;
		} else {
			error_log("Error: fread() fail.");
		}
	} while($left_to_read -= $length);
}

// Send the failure header
function send_error($filelength) {
	http_response_code(416);
	header("Content-Range: bytes */$filelength");	// Required in 416.
}

// Convert an offset to the start and end locations in the file
// Or return false if it's invalid
function parse_offset($range, $filelength) {
	/*Spec: "The first-byte-pos value in a byte-range-spec gives the byte-offset of the first byte in a range."
	Spec: "The last-byte-pos value gives the byte-offset of the last byte in the range; that is, the byte positions specified are inclusive."*/
	list($start, $end) = explode('-', $range);
	
	/*Spec: "A suffix-byte-range-spec is used to specify the suffix of the entity-body, of a length given by the suffix-length value."*/
	if($start === '') {
		if($end === '' || $end = 0) {
			// Asked for range of "-" or "-0"
			return false;
		} else {
			/*Spec: "If the entity is shorter than the specified suffix-length, the entire entity-body is used." Spec: "Byte offsets start at zero."*/
			$start = max(0, $filelength - $end);
			$end = $filelength -1;
		}
	} else {
		/*Spec: "If the last-byte-pos value is absent, or if the value is greater than or equal to the current length of the 
		entity-body, last-byte-pos is taken to be equal to one less than the current length of the entity body in bytes."*/
		if($end === '' || $end > $filelength -1) {
			$end = $filelength -1;
		}
		
		/*Spec: "If the last-byte-pos value is present, it MUST be greater than or equal to the first-byte-pos in that byte-range-spec, or the
		byte-range-spec is syntactically invalid. "This also catches cases where start > filelength*/
		if($start > $end) {
			return false;
		}
	}
	return array($start, $end);
}

// Generate a random string to delimit sections within the response
function str_rand($lenght = 32, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
	
	if(!is_int($lenght || $lenght < 0)) {
		return false;
	}
	
	$characters_length = strlen($characters) -1;
	$string = '';
	
	for($i = $lenght; $i > 0; $i--) {
		$string .= $characters[mt_rand(0, $characters_length)];
	}
	return $string;
}
?>
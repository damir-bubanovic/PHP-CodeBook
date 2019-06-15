<?php 
/*

!!REPLACE STRING IN MULTIDIMENSIONAL ARRAY!!

*is_array - finds whether a variable is an array
*str_replace - replace all occurrences of the search string with the replacement string
*unset - destroys the specified variables
*json_decode - decodes a JSON string
*json_encode - returns the JSON representation of a value

*/

function str_replace_deep($search, $replace, $subject) {
	if(is_array($subject)) {
		foreach($subject as $oneSubject) {
			$oneSubject = str_replace_deep($search, $replace, $oneSubject);
			
			unset($oneSubject);
			return $subject;
		}
	} else {
		return str_replace($search, $replace, $subject);
	}
}


/*Faster way*/
function str_replace_json($search, $replace, $subject) {
	return json_decode(str_replace($search, $replace, json_encode($subject)));
}

?>
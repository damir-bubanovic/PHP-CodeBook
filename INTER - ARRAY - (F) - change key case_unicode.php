<?php 
/*

!!CHANGE KEY CASE UNICODE!!

*mb_convert_case - performs case folding on a string, converted in the way specified by mode
	> for mode look up on PHP.net
*array_change_key_case - returns an array with all keys from array lowercased or uppercased

*/


/*Changes the case of all keys in an array*/
function array_change_key_case_unicode($array, $c = CASE_LOWER) {
    $c = ($c == CASE_LOWER) ? MB_CASE_LOWER : MB_CASE_UPPER;
    foreach($array as $key => $value) {
        $ret[mb_convert_case($key, $c, "UTF-8")] = $value;
    }
    return $ret;
}

$array = array("FirSt" => 1, "yağ" => "Oil", "şekER" => "sugar");
print_r(array_change_key_case($array, CASE_UPPER));
print_r(array_change_key_case_unicode($array, CASE_UPPER));

/*
Array
(
    [FIRST] => 1
    [YAğ] => Oil
    [şEKER] => sugar
)
Array
(
    [FIRST] => 1
    [YAĞ] => Oil
    [ŞEKER] => sugar
)
*/
?>
<?php 
/*

!!IS VARIABLE A STRING!!

*is_string - find whether the type of a variable is string
	> bool is_string ( mixed $var )
> ALERT < 
	Using is_string() on an object will always return false

*/


$values = array(false, true, null, 'abc', '23', 23, '23.5', 23.5, '', ' ', '0', 0);

foreach ($values as $value) {
    print "is_string(";
    var_export($value);
    print ") = ";
    print var_dump(is_string($value));
}

/*
is_string(false) = bool(false)
is_string(true) = bool(false)
is_string(NULL) = bool(false)
is_string('abc') = bool(true)
is_string('23') = bool(true)
is_string(23) = bool(false)
is_string('23.5') = bool(true)
is_string(23.5) = bool(false)
is_string('') = bool(true)
is_string(' ') = bool(true)
is_string('0') = bool(true)
is_string(0) = bool(false)
*/

?>
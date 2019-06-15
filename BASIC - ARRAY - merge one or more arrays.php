<?php 
/*

!!MERGE ARRAYS!!

*array_merge - merge one or more arrays
	> array array_merge ( array $array1 [, array $... ] )

> ALERT < 
	In some situations, the union operator ( + ) might be more useful to you than array_merge.  
	The array_merge function does not preserve numeric key values.  If you need to preserve the 
	numeric keys, then using + will do that.

*/

/*Array_merge*/
$array1 = array("color" => "red", 2, 4);
$array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);
$result = array_merge($array1, $array2);
print_r($result);

/*works with both predefined arrays and arrays defined in place using array()*/
$p_languages = array('Perl', 'PHP');
$p_languages = array_merge($p_languages, array('Python'));
print_r($p_languages);


/*Array merge with + */
$array1[0] = "zero";
$array1[1] = "one";

$array2[1] = "one";
$array2[2] = "two";
$array2[3] = "three";

$array3 = $array1 + $array2;
?>
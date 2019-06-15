<?php 
/*

!!UNSET A VARIABLE AMOUNT OF VALUES FROM A ONE-DIMENSIONAL ARRAY BY KEY!!

> returns the array itself if no further parameter than the array is given, false with no params - does not change the source array
*func_get_args - returns an array comprising a function's argument list
*array_shift - shift an element off the beginning of array
*unset - destroys the specified variables

*/


function array_remove() {
	if($stack = func_get_args()) {
		$input = array_shift($stack);
		
		foreach($stack as $oneStack) {
			unset($input[$oneStack]);
		}
		return $input;
	}
	return false;
}

 
$a = array('a'=>'fun', 'b'=>3.14, 'sub'=> array('1', '2', '3'), 'd'=>'what', 'e' => 'xample', 5 => 'x');
print_r($a);
print_r(array_remove($a, 'd', 'b', 5, 'sub'));

  
/*
Array
(
    [a] => fun
    [b] => 3.14
    [sub] => Array
        (
            [0] => 1
            [1] => 2
            [2] => 3
        )

    [d] => what
    [e] => xample
    [5] => x
)
Array
(
    [a] => fun
    [e] => xample
)  
*/
?>
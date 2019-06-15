<?php 
/*

!!SECURITY - ENSURING INPUT IS FILTERED!!

> You want to filter all input prior to use

> Using strict naming convention, is great for input that was filtered
> Always initializing $clean to an empty array ensures that data cannot be injected into array
	>> you must explicitly add it

*filter_input_array - gets external variables and optionally filters them

*/


/*Initialize an empty array in which to store filtered data. 
After you’ve proven that something is valid, store it in this array*/
$filters = array(
	'name'	=>	array(
						'filter'	=>	FILTER_VALIDATE_REGEXP,
						'options'   =>	array('regexp' => '/^[a-z]+$/i')
					),
	'age' 	 =>	array(
						'filter'	=>	FILTER_VALIDATE_INT,
						'options'   =>	array('min_range' => 13)
					)
);

$clean = filter_input_array(INPUT_POST, $filters);

?>
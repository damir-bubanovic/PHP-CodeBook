	<!--LOOK UP _BASIC - sort array.php-->

<?php
/*

!!SORT ARRAY BY SPECIFIC KEY. MAINTAIN INDEX ASSOCIATION!!

*count - count all elements in an array, or something in an object
*is_array - finds whether a variable is an array
*asort - sort an array and maintain index association
*arsort - sort an array in reverse order and maintain index association

*/


function array_sort($array, $on, $order = SORT_ASC) {
	$new_array = array();
	$sortable_array = array();
	
	if(count($array) > 0) {
		foreach($array as $key => $value) {
			if(is_array($value)) {
				foreach($value as $key2 => $value2) {
					if($key2 == $on) {
						$sortable_array[$key] = $value2;
					}
				}
			}
		}
		switch($order) {
			case SORT_ASC:
				asort($sortable_array);
				break;
			case SORT_DESC:
				arsort($sortable_array);
				break;
		}
		foreach($sortable_array as $key => $value) {
			$new_array[$key] = $array[$key];
		}
	}
	return $new_array;
}



$people = array(
    12345 => array(
        'id' => 12345,
        'first_name' => 'Joe',
        'surname' => 'Bloggs',
        'age' => 23,
        'sex' => 'm'
    ),
    12346 => array(
        'id' => 12346,
        'first_name' => 'Adam',
        'surname' => 'Smith',
        'age' => 18,
        'sex' => 'm'
    ),
    12347 => array(
        'id' => 12347,
        'first_name' => 'Amy',
        'surname' => 'Jones',
        'age' => 21,
        'sex' => 'f'
    )
);

print_r(array_sort($people, 'age', SORT_DESC)); // Sort by oldest first
print_r(array_sort($people, 'surname', SORT_ASC)); // Sort by surname

/*
Array
(
    [12345] => Array
        (
            [id] => 12345
            [first_name] => Joe
            [surname] => Bloggs
            [age] => 23
            [sex] => m
        )

    [12347] => Array
        (
            [id] => 12347
            [first_name] => Amy
            [surname] => Jones
            [age] => 21
            [sex] => f
        )

    [12346] => Array
        (
            [id] => 12346
            [first_name] => Adam
            [surname] => Smith
            [age] => 18
            [sex] => m
        )

)
Array
(
    [12345] => Array
        (
            [id] => 12345
            [first_name] => Joe
            [surname] => Bloggs
            [age] => 23
            [sex] => m
        )

    [12347] => Array
        (
            [id] => 12347
            [first_name] => Amy
            [surname] => Jones
            [age] => 21
            [sex] => f
        )

    [12346] => Array
        (
            [id] => 12346
            [first_name] => Adam
            [surname] => Smith
            [age] => 18
            [sex] => m
        )

)
*/

?>
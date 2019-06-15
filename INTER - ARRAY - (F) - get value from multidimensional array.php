<?php 
/*

!!GET VALUE FROM MULTIDIMENSIONAL ARRAY!!

*array_values - return all the values of an array
*array_walk_recursive - apply a user function recursively (repeating) to every member of an array
*array_push - push one or more elements onto the end of array
*array_pop - pop the element off the end of array
*count - count all elements in an array, or something in an object

*/


/*Get all values from specific key in a multidimensional array*/
function array_value_recursive($key, array $arr){
    $val = array();
    array_walk_recursive($arr, function($v, $k) use($key, &$val){
        if($k == $key) array_push($val, $v);
    });
    return count($val) > 1 ? $val : array_pop($val);
}

$arr = array(
    'foo' => 'foo',
    'bar' => array(
        'baz' => 'baz',
        'candy' => 'candy',
        'vegetable' => array(
            'carrot' => 'carrot',
        )
    ),
    'vegetable' => array(
        'carrot' => 'carrot2',
    ),
    'fruits' => 'fruits',
);

var_dump(array_value_recursive('carrot', $arr)); // array(2) { [0]=> string(6) "carrot" [1]=> string(7) "carrot2" }
var_dump(array_value_recursive('apple', $arr)); // null
var_dump(array_value_recursive('baz', $arr)); // string(3) "baz"
var_dump(array_value_recursive('candy', $arr)); // string(5) "candy"
var_dump(array_value_recursive('pear', $arr)); // null



/*
Get specific values from array
- with simple if shorthand
*/
$data = [
	[
		'wd-mountgeo.jpg',
		'Izrada Web Stranica',
		'Korak naprijed prema Online poslovanju sa personaliziranim i kreativnim web stranicama / aplikacijama'
	],
	[
		'gd-exploziv.jpg',
		'Grafički Dizajn',
		'Unikatni dizajnerska rješenja od kojih čovjek zastane i promisli'
	],
	[
		'pm-table.jpg',
		'Upravljanje Projektima',
		'Visoko kvalitetni i kompetitivni projekti za prijavu na natječaje hrvatskih i europskih fondova'
	]
];


@for ($i = 0; $i < count($data); $i++)
	<div class="item {{ ($i == 0) ? 'active' : '' }}">
		<!-- CAROUSEL IMAGE & CAPTION -->
		<img src="{{ asset('img/nnh/carousel/' .  $data[$i][0]) }}">
		<div class="carousel-caption">
			<h1>{{ $data[$i][1] }}</h1>
			<p>{{ $data[$i][2] }}</p>
		</div>
	</div>
@endfor
?>
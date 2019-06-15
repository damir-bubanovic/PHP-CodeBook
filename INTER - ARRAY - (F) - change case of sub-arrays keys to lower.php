<?php 
/*

!!CHANGE CASE OF SUB-ARRAY KEYS TO LOWER!!

*array_keys - return all the keys or a subset of the keys of an array
*strtolower - make a string lowercase
*is_array - finds whether a variable is an array
*unset - destroys the specified variables

*/



/*change case of sub-arrays keys to lower*/
$array = array(
	"First" => "val1",
	"SecoNd" => "val2",
	"third" => array(
				"third-INner1" => "val3.1"
				),
	"fourth" => array(
				"FouthINNer1" => "val4.1",
				"FourthINNER2" => "val4.2"
				)
);

print_r($array);


$key = array_keys($array);

foreach($key as $ki) {
	
    $klower = strtolower($ki);
    $val = $array[$ki];
	
    if(is_array($val)) {
        foreach($val as $kinner => $vinner) {            
            $tl = strtolower($kinner);
            unset($val[$kinner]);
            $val[$tl] = $vinner; 
        }
    }
	
    unset($array[$ki]);
    $array[$klower] = $val; 
}

print "<br> After Changing Key to-LowerCase : <br>";
print_r($array);

?>
<?php 
/*

!!CREATE MULTI-ARRAY UNIQUE FOR ANY SINGLE KEY INDEX!!

*in_array - checks if a value exists in an array

*/


/*I want to create multi dimentional unique array for specific code*/
$details = array( 
    0 => array(
			"id" => "1", 
			"name" => "Mike",
			"num" => "9876543210"
			), 
    1 => array(
			"id" => "2",
			"name" => "Carissa",
			"num" => "08548596258"
			), 
    2 => array(
			"id" => "1",
			"name" => "Mathew",
			"num" => "784581254"
			) 
);


/*You can make it unique for any field like id, name or num*/
function unique_multidim_array($array, $key) { 
    $temp_array = array(); 
    $i = 0; 
    $key_array = array(); 
    
    foreach($array as $val) { 
        if (!in_array($val[$key], $key_array)) { 
            $key_array[$i] = $val[$key]; 
            $temp_array[$i] = $val; 
        } 
        $i++; 
    } 
    return $temp_array; 
} 

$details = unique_multidim_array($details,'id'); 

/*
$details = array( 
    0 => array("id"=>"1","name"=>"Mike","num"=>"9876543210"), 
    1 => array("id"=>"2","name"=>"Carissa","num"=>"08548596258"), 
);
*/
?>
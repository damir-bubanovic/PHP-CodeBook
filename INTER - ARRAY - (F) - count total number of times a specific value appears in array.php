<?php 
/*

!!COUNT TOTAL NUMBER OF TIMES A SPECIFIC VALUE ARREARS IN ARRAY!!

*/


function array_value_count ($match, $array) { 
    $count = 0; 
    
    foreach($array as $key => $value) { 
        if($value == $match) { 
            $count++; 
        } 
    } 
    
    return $count; 
}
?>
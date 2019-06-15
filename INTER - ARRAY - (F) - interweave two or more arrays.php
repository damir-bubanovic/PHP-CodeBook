<?php 
/*

!!INTERWEAVE TWO OR MORE ARRAYS!!

> Interlace the contents of an array (cross or be crossed intricately together; interweave)
> Takes an array, splits it in half, then takes it in turns to push an item from each split array back onto a new array

*/


/*array_interlace, but I need to pass more than two arrays*/
function array_interlace() { 
    $args = func_get_args(); 
    $total = count($args); 

    if($total < 2) { 
        return FALSE; 
    } 
    
    $i = 0; 
    $j = 0; 
    $arr = array(); 
    
    foreach($args as $arg) { 
        foreach($arg as $v) { 
            $arr[$j] = $v; 
            $j += $total; 
        } 
        
        $i++; 
        $j = $i; 
    } 
    
    ksort($arr); 
    return array_values($arr); 
} 



$a = array('a', 'b', 'c', 'd'); 
$b = array('e', 'f', 'g'); 
$c = array('h', 'i', 'j'); 
$d = array('k', 'l', 'm', 'n', 'o'); 

print_r(array_interlace($a, $b, $c, $d)); 

/*
Array 
( 
    [0] => a 
    [1] => e 
    [2] => h 
    [3] => k 
    [4] => b 
    [5] => f 
    [6] => i 
    [7] => l 
    [8] => c 
    [9] => g 
    [10] => j 
    [11] => m 
    [12] => d 
    [13] => n 
    [14] => o 
) 
*/
?>
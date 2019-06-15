<?php 
/*
!!BASIC - OTHER - BREAK & CONTINUE!!

> break -> 	leaves your loop
		->	break ends execution of the current for, foreach, while, do-while or switch structure
> continue -> 	skips any code for the remainder of that loop and goes on 
				to the next loop, so long as the condition is still true
*/


$stack = array('first', 'second', 'third', 'fourth', 'fifth'); 

foreach($stack AS $v){ 
    if($v == 'second')continue; 
    if($v == 'fourth')break; 
    echo $v.'<br>'; 
} 
/* 

first 
third 

*/ 

$stack2 = array('one'=>'first', 'two'=>'second', 'three'=>'third', 'four'=>'fourth', 'five'=>'fifth'); 
foreach($stack2 AS $k=>$v){ 
    if($v == 'second')continue; 
    if($k == 'three')continue; 
    if($v == 'fifth')break; 
    echo $k.' ::: '.$v.'<br>'; 
} 
/* 

one ::: first 
four ::: fourth 

*/ 

?>
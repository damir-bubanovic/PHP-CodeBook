<?php 
/*

!!FIND PHRASE & PROCESS IT!!

1) with strpos and strlen find starting position of wanted string
2) trim the whitespace and apply to another string

*/


$sentence = "Today is Christmas Day";

$position = strpos($sentence, "is");
$start = $position + strlen("is");

$finish = trim(substr($sentence, $start));
print "You are a $finish freak";
// You are a Christmas Day freak
?>
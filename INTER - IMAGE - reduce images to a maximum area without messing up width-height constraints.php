<?php 
/*

!!REDUCE IMAGE TO A MAX AREA WITHPUT MESSING UP WIDTH-HEIGTH CONSTANTS!!

*list - assign variables as if they were an array
*getimagesize - get the size of an image
*sqrt - square root

*/


/*reduce images to a maximum area without messing up width/height constraints*/
list($width_orig, $height_orig) = getimagesize($img);

$max_a = 500000; // maximum area in pixels

$width = $width_orig;
$height = $height_orig;

$area = $width * $height;
if($area > $max_a) { 
    $mult = sqrt($max_a) / sqrt($height * $width);
    $width *= $mult;
    $height *= $mult;
}

?>
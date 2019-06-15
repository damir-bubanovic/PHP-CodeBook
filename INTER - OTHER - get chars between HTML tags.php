<?php
/*

!!INTER - OTHER - GET CHARS BETWEEN HTML TAGS!!

> great for files & outside web pages

*/

function getTextBetweenTags($string, $tagname) {
    $pattern = "/<$tagname ?.*>(.*)<\/$tagname>/";
    preg_match($pattern, $string, $matches);
    return $matches[1];
}

$str = '<textformat leading="2"><p align="left"><font size="10">get me</font></p></textformat>';
$txt = getTextBetweenTags($str, "font");
echo $txt;
?>
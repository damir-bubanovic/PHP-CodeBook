<?php 
/*

!!GRAPHICS - GENERATING BAR CHARTS FROM POLL RESULTS!!

> When displaying the results of a poll, it can be more effective to generate a 
colorful bar chart instead of just printing the results as text

> Use GD to create an image that displays the cumulative responses to a poll question

*array_sum - calculate the sum of values in an array
*ImageCreateTrueColor - create a new true color image
*ImageFilledRectangle - draw a filled rectangle
*explode - split a string by string
*wordwrap - wraps a string to a given number of characters
*count - count all elements in an array, or something in an object
*ImageCopy - copy part of an image
*header - send a raw HTTP header
*ImagePNG - output a PNG image to either the browser or a file
*ImageDestroy - destroy an image

*/


/*Example 17-1. Graphical bar charts*/
function bar_chart($question, $answers) {
	
	// define colors to draw the bars
	$colors = array(0xFF6600, 0x009900, 0x3333CC,0xFF0033, 0xFFFF00, 0x66FFFF, 0x9900CC);
	$total = array_sum($answers['votes']);
	
	// define spacing values and other magic numbers
	$padding = 5;
	$line_width = 20;
	$scale = $line_width * 7.5;
	$bar_height = 10;
	$x = $y = $padding;
	
	// allocate a large palette for drawing, since you don't know
	// the image length ahead of time
	$image = ImageCreateTrueColor(150, 500);
	ImageFilledRectangle($image, 0, 0, 149, 499, 0xE0E0E0);
	$black = 0x000000;
	
	// print the question
	$wrapped = explode("\n", wordwrap($question, $line_width));
	foreach ($wrapped as $line) {
		ImageString($image, 3, $x, $y , $line, $black);
		$y += 12;
	}
	
	$y += $padding;
	
	
	// print the answers
	for ($i = 0; $i < count($answers['answer']); $i++) {
		
		// format percentage
		$percent = sprintf('%1.1f', 100*$answers['votes'][$i]/$total);
		$bar = sprintf('%d', $scale*$answers['votes'][$i]/$total);
		
		// grab color
		$c = $i % count($colors); // handle cases with more bars than colors
		$text_color = $colors[$c];
		
		// draw bar and percentage numbers
		ImageFilledRectangle($image, $x, $y, $x + $bar, $y + $bar_height, $text_color);
		ImageString($image, 3, $x + $bar + $padding, $y, "$percent%", $black);
		$y += 12;
		
		// print answer
		$wrapped = explode("\n", wordwrap($answers['answer'][$i], $line_width));
		foreach ($wrapped as $line) {
			ImageString($image, 2, $x, $y, $line, $black);
			$y += 12;
		}
		$y += 7;
	}
	
	// crop image by copying it
	$chart = ImageCreateTrueColor(150, $y);
	ImageCopy($chart, $image, 0, 0, 0, 0, 150, $y);
	
	// PHP 5.5+ supports
	// $chart = ImageCrop($image, array('x' => 0, 'y' => 0,
	// 'width' => 150, 'height' => $y));
	// deliver image
	header ('Content-type: image/png');
	ImagePNG($chart);
	// clean up
	ImageDestroy($image);
	ImageDestroy($chart);
}


/*To call this program, create an array holding two parallel arrays: $answers['answ
er'] and $answer['votes']. Element $i of each array holds the answer text and the
total number of votes for answer $i*/
// Act II. Scene II.
$question = 'What a piece of work is man?';

$answers['answer'][] = 'Noble in reason';
$answers['votes'][] = 29;

$answers['answer'][] = 'Infinite in faculty';
$answers['votes'][] = 22;

$answers['answer'][] = 'In form, in moving, how express and admirable';
$answers['votes'][] = 59;

$answers['answer'][] = 'In action how like an angel';
$answers['votes'][] = 45;

bar_chart($question, $answers);

?>
	<!--LOOK UP - _BASIC - RSS - youtube video example.php, youtube_videos.php, objects explained.php-->
	<!--USE WITH _RSS newsfeed.php-->

<?php
/*Owen Youtube keyword search URL*/
define('YOUTUBE_URL', 'http://gdata.youtube.com/feeds/api/videos/-/alien/abduction/head/first');
/*Number of videos to be displayed is stored as a constant*/
define('NUM_VIDEOS', 5);

// Read the XML data into an object
/*The simplexml_load_file() function is used to request the XML data from YouTube.*/
$xml = simplexml_load_file(YOUTUBE_URL);

/*Check to see how many videos were actually returned by YouTube by counting the number of <entry> tags.*/
$num_videos_found = count($xml->entry);

if ($num_videos_found > 0) {
	echo '<table><tr>';
	/*Loop through the video data one entry at a time.*/
		for ($i = 0; $i < min($num_videos_found, NUM_VIDEOS); $i++) {
			
		// Get the title
		$entry = $xml->entry[$i];
		/*Grab all of the children for this entry that are in the Yahoo! media namespace, media.*/
		$media = $entry->children('http://search.yahoo.com/mrss/');
		/*Extract the title of the video entry, which is stored in the <media:title> tag.*/
		$title = $media->group->title ;
		
		// Get the duration in minutes and seconds, and then format it
		/*Grab all of the children for this entry that are in the YouTube namespace, yt.*/
		$yt = $media->children('http://gdata.youtube.com/schemas/2007');
		$attrs = $yt->duration->attributes();
		/*Get the duration of the video in seconds from the <yt:duration> tag, and then convert it to minutes.*/
		$length_min = floor($attrs['seconds'] / 60);
		$length_sec = $attrs['seconds'] % 60;
		$length_formatted = $length_min . (($length_min != 1) ? ' minutes, ':' minute, ') .
		$length_sec . (($length_sec != 1) ? ' seconds':' second');
		
		// Get the video URL
		/*Grab the video link (URL) from the url attribute of the <media:player> tag.*/
		$attrs = $media->group->player->attributes();
		$video_url = $attrs['url'];
		
		// Get the thumbnail image URL
		/*Extract the first thumbnail image URL from the url attribute of the <media:thumbnail> tag.*/
		$attrs = $media->group->thumbnail[0]->attributes();
		$thumbnail_url = $attrs['url'];
		
		// Display the results for this entry
		/*Format the video results as a table cell with the video title, length, and thumbnail image.*/
		echo '<td style="vertical-align:bottom; text-align:center" width="' . (100 / NUM_VIDEOS) .
		'%"><a href="' . $video_url . '">' . $title . '<br /><span style="font-size:smaller">' .
		$length_formatted . '</span><br /><img src="' . $thumbnail_url . '" /></a></td>';
		}
	echo '</tr></table>';
	}
	else {
		echo '<p>Sorry, no videos were found.</p>';
}
?>
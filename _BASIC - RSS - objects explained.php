	<!--LOOK UP - _BASIC - RSS - youtube video example.php, youtube_videos.php, _RSS - newsfeed youtube videos.php _RSS newsfeed.php-->

<?php 
1) definiramo konstantu - to je youtube search
define('YOUTUBE_URL', 'http://gdata.youtube.com/feeds/api/videos/-/alien/abduction/head/first');
2) ovo je PHP object od type simplexml_load_file koji sadržava sve elemente XML data iz Youtube video response*/
$xml = simplexml_load_file(YOUTUBE_URL);

3) pristupamo podacima koristeći object properties
	$entries = $xml->entry
		□ ovo acceses sve entry elemente od dokumenta
		□ -> operator daje pristupanje property unutar objekta
		□ pošto ima višestruke entry elemente u $entries onda se ovo pohranjuje kao array objekta, kao. $row[ ]
		□ svaki video <entry></entry> možeš pristupiti tako da indexiraš array, npr prvi <entry> tag je prvi item arraya

► XML data možemo vizualizirati kao hijararhiju i kolekciju objekata u PHP-u (parent child relationships)
	> kod se zasniva na snažnom odnosu title / group / entry objekata
/*dolazimo do child objekta odnosno object title*/
echo $entry->group->title;

► attributes() metoda putem koje dolazimo do vrijednosti XML attributa za određeni element
/*attributes() metoda putem kojeg dolazimo do arraya attributes za objekt (element)*/
$attrs = $entry->group->duration->attributes();
print $attrs['seconds'];

/*The children() method returns an array containing all of the child elements that are within the specified namespace.*/
$media = $entry->children('http://search.yahoo.com/mrss/');
/*All tags starting with “<media:”belong to this namespace.*/
xmlns:media='http://search.yahoo.com/mrss/'
/*This namespace is for tags starting in “<yt:”.*/
xmlns:yt='http://gdata.youtube.com/schemas/2007'

/*code for duration in seconds of a video clip*/
/*This is the URL for the namespace as listed in the <feed> tag at the beginning of the document.*/
$yt = $media->children('http://gdata.youtube.com/schemas/2007');
/*Grab all of the attributes for the <yt:duration> tag.*/
$attrs = $yt->duration->attributes();
/*The name of the attribute is used as the key for accessing the attribute array.*/
echo $attrs[' '];
?>
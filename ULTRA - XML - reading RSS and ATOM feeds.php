<?php 
/*

!!XML - READING RSS & ATOM FEEDS!!

> want to retrieve RSS and Atom feeds and look at the items. This allows 
you to incorporate newsfeeds from multiple websites into your application

> Use the MagpieRSS parser. Here’s an example that reads the RSS feed for the php.announce mailing list

*/

require __DIR__ . '/magpie/rss_fetch.inc';

$feed = 'http://news.php.net/group.php?group=php.announce&format=rss';

$rss = fetch_rss( $feed );

print "<ul>\n";
foreach ($rss->items as $item) {
	print '<li><a href="' . $item['link'] . '">' . $item['title'] . "</a></li>\n";
}
print "</ul>\n";


/*Atom is a similar XML syndication format. It extends many of the concepts in RSS,
including a way to read and write Atom data*/
/*Using MagpieRSS, retrieving and parsing RSS and Atom feeds are simple*/
$feed = 'http://news.php.net/group.php?group=php.announce&format=rss';

$rss = fetch_rss($feed);


/*This example reads in the RSS feed for the php.announce mailing list. The feed is then
parsed by fetch_rss() and stored internally within $rss*/
/*Each RSS item is then retrieved as an associative array using the items property*/
print "<ul>\n";
foreach ($rss->items as $item) {
	print '<li><a href="' . $item['link'] . '">' . $item['title'] . "</a></li>\n";
}
print "</ul>\n";


/*Each channel also has an entry with information about the feed*/
/*To retrieve this data, access the channel attribute*/
$feed = 'http://news.php.net/group.php?group=php.announce&format=rss';

$rss = fetch_rss($feed);
print "<ul>\n";

foreach ($rss->channel as $key => $value) {
	print "<li>$key: $value</li>\n";
}
print "</ul>\n";

?>
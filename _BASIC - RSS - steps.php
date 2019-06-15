	<!--BASIC STEPS for RSS-->
	<!--LOOK UP - _RSS - newsfeed.php, newsfeed youtube videos-->

<?php 
/*1. - set the content type of the document to XML*/
header('Content-Type: text/xml');

/*2. - generate XML directive to indicate that this is a XML document*/
print '<?xml version="1.0" encoding="utf-8"?>';

/*3. - Generate the static RSS code that doesn't come the database npr. <rss>*/
<rss version="2.0">
	<channel>
		<title>...
		<link>...
		<description>...
		<language>...
		...
		/*This code is always the same*/

/*4. Query the database for data*/
first_name
last_name
description
what_happend

/*5. - Loop throug the data generating RSS code for each news item*/
<item>
	<title>...
	<link>...
	<pubDate>....
	<description>...
</item>

/*6. - Generate the static RSS code required to finish up the document, including closing channel i rss tags*/
	</channel>
</rss>

/*7. - provide link from index.php to newsfeed.php*/
<a href="newsfeed.php"><img	src="rssicon.png" alt="Syndicate alien abductions" /><a>
?>
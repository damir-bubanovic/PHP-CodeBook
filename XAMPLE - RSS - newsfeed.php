	<!--USE WITH _RSS - newsfeed youtube videos.php-->
	<!--LOOK UP - _BASIC - RSS - steps.php, youtube videos.php-->

<!--XML directive that identifies this document contains XML code-->
<?php header('Content-Type: text/xml'); ?>
<?php print '<?xml version="1.0" encoding="utf-8"?>'; ?>
<rss version="2.0">
	<!--If you have one category than use one channel, if you have different categories have multiple channels-->
	<!--Grou of related news items-->
	<channel>
		<!--Title tag applies to the channel as a whole-->
		<title>Alien Abducted Me - Newsfeed</title>
		<!--Link points to web site associated with the newsfeed-->
		<link>http://alienasabductedme.com</link>
		<!--Description if standard-->
		<description>Aliens abduction reports from around the world courtesy of Owen and his abducted dog Fang.</description>
		<!--You can create newsfeed for different languages-->
		<language>en-us</language>

<?php 
/*Database connection variables*/
require_once('connectvars.php');

/*Connect to the database*/
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

/*Retrieve the data from MySQL*/
$query = "SELECT abduction_id, first_name, last_name, DATE_FORMAT(when_it_happend, '%a, %d %b %Y %T') " .
"AS when_it_happend_rfc, alien_description, what_they_did FROM aliens_abduction ORDER BY when it happened DESC";
$data = mysqli_query($dbc, $query);

/*Loop through arrays of data formating it as RSS*/
while($row = mysqli_fetch_array($data)) {
	/*Display each row as an RSS item*/
	print '<item>';
	print '	<title>' . $row['first_name'] . ' ' . $row['last_name'] . ' - ' . substr($row['alien_description'], 0, 32) . '...</title>';
	print '	<link>http://www.alienasabductedme.com/index.php?abduction_id=' . $row['abduction_id'] . '</link>';
	print ' <pubDate>' . $row['when_it_happend_rfc'] . ' ' . date('T') . '</pubDate>';
	print ' <description>' . $row['what_they_did'] . '</description>';
	print '</item>';
}
?>		

	</channel>
<!--Standard close tag-->
</rss>


<!--Put link to RSS feed in index.php-->
<p>
	<a href="newsfeed.php">
	<img style="vertical-align:top; border:none"
	src="rssicon.png" alt="Syndicate alien abductions" />
	Click to syndicate the abduction news feed.
	</a>
</p>
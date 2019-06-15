<?php 
/*

!!XML - GENERATING XML AS A STING!!

> want to generate XML. 
	>> npr. you want to provide an XML version of your data for another program to parse
> Loop through your data and print it out surrounded by the correct XML tags

> Printing out XML manually mostly involves lots of foreach loops as you iterate through arrays. 
> However, there are a few tricky details:
	1) you need to call header() to set the correct Content-Type header for the document (text/xml)
	2) depending on your settings for the short_open_tag configuration directive, trying to print the XML declaration 
	may accidentally turn on PHP processing. Because the <? of <?xml version="1.0"?> is the short PHP open tag, to print 
	the declaration to the browser you need to either disable the directive or print the line from within PHP
	3) entities must be escaped. For example, the & in the show Law & Order needs to be &amp;. 
	Call htmlspecialchars() to escape your data

*/


header('Content-Type: text/xml');
print '<?xmp version="1.0"?>' . "\n";
print "<shows>\n";

$shows = array(
			array(
				'name'	 =>	'Modern Family',
				'channel'  =>	'ABC',
				'start'    =>	'9:00 PM',
				'duration' =>	'30'
			),
			array(
				'name'	 =>	'Law & Order: SVU',
				'channel'  =>	'NBC',
				'start'    =>	'9:00 PM',
				'duration' =>	'60'
			)
);

foreach($shows as $show) {
	print " <show>\n";
	
	foreach($show as $tag => $data) {
		print " <$tag>" . htmlspecialchars($data) . "</$tag>\n";
	}
	
	print " </show>\n";
}

print "</shows>\n";


/*The output from the example in the Solution is shown*/
/*Tonight’s TV listings*/
?>

<?xml version="1.0"?>
<shows>
    <show>
        <name>Modern Family</name>
        <channel>ABC</channel>
        <start>9:00 PM</start>
        <duration>30</duration>
    </show>
    <show>
        <name>Law &amp; Order: SVU</name>
        <channel>NBC</channel>
        <start>9:00 PM</start>
        <duration>60</duration>
    </show>
</shows>
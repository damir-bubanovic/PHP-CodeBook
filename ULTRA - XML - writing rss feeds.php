<?php 
/*

!!XML - WRITING RSS FEEDS!!

> want to generate RSS feeds from your data. This will allow you to syndicate your content

*/


/*Use this class*/
class rss2 extends DOMDocument {
	
	private $channel;
	
	public function __construct($title, $link, $description) {
		parent::__construct();
		$this->formatOutput = true;
		
		$root = $this->appendChild($this->createElement('rss'));
		$root->setAttribute('version', '2.0');
		
		$channel= $root->appendChild($this->createElement('channel'));
		$channel->appendChild($this->createElement('title', $title));
		$channel->appendChild($this->createElement('link', $link));
		$channel->appendChild($this->createElement('description',$description));
		
		$this->channel = $channel;
	}
	
	
	public function addItem($title, $link, $description) {
		$item = $this->createElement('item');
		$item->appendChild($this->createElement('title', $title));
		$item->appendChild($this->createElement('link', $link));
		$item->appendChild($this->createElement('description', $description));
		$this->channel->appendChild($item);
	}
}

$rss = new rss2('Channel Title', 'http://www.example.org','Channel Description');

$rss->addItem('Item 1', 'http://www.example.org/item1', 'Item 1 Description');

$rss->addItem('Item 2', 'http://www.example.org/item2', 'Item 2 Description');

print $rss->saveXML();


/*RSS is XML, so you can leverage all the XML-generation features of the DOM extension.
The code in the Solution extends the DOMDocument class to build up a DOM tree by
creating elements and appending them in the appropriate structure*/

/*The class constructor sets up the <rss> and <channel> elements. It takes three arguments—
the channel title, link, and description*/
public function __construct($title, $link, $description) {
	
	parent::__construct();
	$this->formatOutput = true;
	
	$root = $this->appendChild($this->createElement('rss'));
	$root->setAttribute('version', '2.0');
	
	$channel= $root->appendChild($this->createElement('channel'));
	$channel->appendChild($this->createElement('title', $title));
	$channel->appendChild($this->createElement('link', $link));
	$channel->appendChild($this->createElement('description', $description));
	
	$this->channel = $channel;
}

/*Inside the method, you call the parent::__construct() method to invoke the actual
DOMDocument::__construct().*/

/*With the main content defined, use the addItem() method to add item entries*/
public function addItem($title, $link, $description) {
	$item = $this->createElement('item');
	$item->appendChild($this->createElement('title', $title));
	$item->appendChild($this->createElement('link', $link));
	$item->appendChild($this->createElement('description', $description));
	$this->channel->appendChild($item);
}



/*basic RSS 2.0 class is finished. Use it like this*/
$rss = new rss2('Channel Title', 'http://www.example.org', 'Channel Description');

$rss->addItem('Item 1', 'http://www.example.org/item1', 'Item 1 Description');

$rss->addItem('Item 2', 'http://www.example.org/item2', 'Item 2 Description');

print $rss->saveXML();
?>

<?xml version="1.0"?>
<rss version="2.0">
    <channel><title>Channel Title</title>
    <link>http://www.example.org</link>
    <description>Channel Description</description>
    
    <item>
        <title>Item 1</title>
        <link>http://www.example.org/item1</link>
        <description>Item 1 Description</description>
    </item>
    
    <item>
        <title>Item 2</title>
        <link>http://www.example.org/item2</link>
        <description>Item 2 Description</description>
    </item>
    </channel>
</rss>
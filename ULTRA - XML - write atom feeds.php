<?php 
/*

!!XML - WRITING ATOM FEEDS!!

> want to generate Atom feeds from your data. This will allow you to syndicate your content

*/


/*Use this class*/
class atom1 extends DOMDocument {

	private $ns;

	public function __construct($title, $href, $name, $id) {
		
		parent::__construct();
		
		$this->formatOutput = true;
		$this->ns = 'http://www.w3.org/2005/Atom';
		
		$root = $this->appendChild($this->createElementNS($this->ns, 'feed'));
		$root->appendChild($this->createElementNS($this->ns, 'title', $title));
		
		$link = $root->appendChild($this->createElementNS($this->ns, 'link'));
		$link->setAttribute('href', $href);
		
		$root->appendChild($this->createElementNS($this->ns, 'updated', date(DATE_ATOM)));

		$author = $root->appendChild($this->createElementNS($this->ns, 'author'));
		$author->appendChild($this->createElementNS($this->ns, 'name', $name));
		
		$root->appendChild($this->createElementNS($this->ns, 'id', $id));
	}
	
	
	public function addEntry($title, $link, $summary) {
		
		$entry = $this->createElementNS($this->ns, 'entry');
		$entry->appendChild($this->createElementNS($this->ns, 'title', $title));
		$entry->appendChild($this->createElementNS($this->ns, 'link', $link));
		
		$id = uniqid('http://example.org/atom/entry/ids/');
		
		$entry->appendChild($this->createElementNS($this->ns, 'id', $id));
		$entry->appendChild($this->createElementNS($this->ns, 'updated', date(DATE_ATOM)));
		$entry->appendChild($this->createElementNS($this->ns, 'summary', $summary));
		
		$this->documentElement->appendChild($entry);
	}
}

$atom = new atom1('Channel Title', 'http://www.example.org', 'John Quincy Atom', 'http://example.org/atom/feed/ids/1');
$atom->addEntry('Item 1', 'http://www.example.org/item1', 'Item 1 Description', 'http://example.org/atom/entry/ids/1');
$atom->addEntry('Item 2', 'http://www.example.org/item2', 'Item 2 Description', 'http://example.org/atom/entry/ids/2');

print $atom->saveXML();


/*The atom1 class is structured similar to the rss2 class*/

/*The Atom specification is more complex than RSS. It requires you to place elements inside a namespace and also forces 
the generation of unique identifiers for a feed and individual items, along with the last updated times for those entries*/

/*Also, though its general structure is similar to RSS, it uses different terminology. The
root element is now a feed and an item is now an entry. You don’t need a feed description,
but you do need an author. And inside the entries, the description is a
summary.*/

/*Last, there is no concept of a channel. Both feed data and entries are located directly
under the document element*/

/*Here’s the updated constructor*/
public function __construct($title, $href, $name, $id) {
	
	parent::__construct();
	
	$this->formatOutput = true;
	$this->ns = 'http://www.w3.org/2005/Atom';

	$root = $this->appendChild($this->createElementNS($this->ns, 'feed'));
	$root->appendChild($this->createElementNS($this->ns, 'title', $title));

	$link = $root->appendChild($this->createElementNS($this->ns, 'link'));
	$link->setAttribute('href', $href);
	
	$root->appendChild($this->createElementNS($this->ns, 'updated', date(DATE_ATOM)));
	
	$author = $root->appendChild($this->createElementNS($this->ns, 'author'));
	$author->appendChild($this->createElementNS($this->ns, 'name', $name));
	
	$root->appendChild($this->createElementNS($this->ns, 'id', $id));
}



/*The addItem() method is renamed to addEntry() to be consistent with the Atom specification*/
public function addEntry($title, $link, $summary, $id) {
	
	$entry = $this->createElementNS($this->ns, 'entry');
	$entry->appendChild($this->createElementNS($this->ns, 'title', $title));
	$entry->appendChild($this->createElementNS($this->ns, 'link', $link));
	$entry->appendChild($this->createElementNS($this->ns, 'id', $id));
	$entry->appendChild($this->createElementNS($this->ns, 'updated', date(DATE_ATOM)));
	$entry->appendChild($this->createElementNS($this->ns, 'summary', $summary));
	
	$this->documentElement->appendChild($entry);
}


/*Everything comes together like this*/
$atom = new atom1('Channel Title', 'http://www.example.org', 'John Quincy Atom', 'http://example.org/atom/feed/ids/1');
$atom->addEntry('Item 1', 'http://www.example.org/item1', 'Item 1 Description', 'http://example.org/atom/entry/ids/1');
$atom->addEntry('Item 2', 'http://www.example.org/item2', 'Item 2 Description', 'http://example.org/atom/entry/ids/2');

print $atom->saveXML();
?>

<?xml version="1.0"?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <title>Channel Title</title>
    <link href="http://www.example.org"/>
    <updated>2006-10-23T22:33:59-07:00</updated>
    
    <author>
    	<name>John Quincy Atom</name>
    </author>
	<id>http://example.org/atom/feed/ids/1</id>
    <entry>
        <title>Item 1</title>
        <link>http://www.example.org/item1</link>
        <id>http://example.org/atom/entry/ids/1</id>
        <updated>2014-10-23T20:23:32-07:00</updated>
        <summary>Item 1 Description</summary>
    </entry>
    <entry>
        <title>Item 2</title>
        <link>http://www.example.org/item2</link>
        <id>http://example.org/atom/entry/ids/2</id>
        <updated>2014-10-23T21:53:44-07:00</updated>
        <summary>Item 2 Description</summary>
    </entry>
</feed>
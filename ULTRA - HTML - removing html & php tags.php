<?php 
/*

!!REMOVING HTML & PHP TAGS!!

> want to remove HTML and PHP tags from a string or file. For example, you want to make sure there 
is no HTML in a string before printing it or PHP in a string before passing it to eval()

> Use strip_tags() or filter_var() to remove HTML and PHP tags from a string
> Both strip_tags() and the string.strip_tags filter can be told not to remove certain tags

*strip_tags - strip HTML and PHP tags from a string
*filter_var - filters a variable with a specified filter
*fopen - opens file or URL
*stream_filter_append - attach a filter to a stream
*stream_get_contents - reads remainder of a stream into a string
*trim - strip whitespace (or other characters) from the beginning and end of a string

*/


/*Removing HTML and PHP tags*/
$html = '<a href="http://www.oreilly.com">I <b>love computer books.</b></a>';
$html .= '<?php echo "Hello" ?>';
print strip_tags($html);
print "\n";
print filter_var($html, FILTER_SANITIZE_STRING);


/*To strip tags from a stream as you read it, use the string.strip_tags stream filter*/
/*Removing HTML and PHP tags from a stream*/
$stream = fopen(__DIR__ . '/elephant.html', 'r');
stream_filter_append($stream, 'string.strip_tags');
print stream_get_contents($stream);


/*Removing some HTML and PHP tags from a stream*/
$stream = fopen(__DIR__ . '/elephant.html', 'r');
stream_filter_append($stream, 'string.strip_tags', STREAM_FILTER_READ, 'b,i');
print stream_get_contents($stream);


/*A more robust approach that avoids the problems that could result from strip_tags()
reacting poorly to a broken tag or not removing a dangerous attribute is to allow only
a whitelist of known-good tags and attributes in your stripped HTML. With this approach,
you don’t remove bad things (which leaves you open to the possibility that your
list of bad things is incomplete) but instead only keep good things*/
/*“Stripping” tags with a whitelist*/
class TagStripper {
	
	protected $allowed = array(
		/* Allow <a/> and only an "href" attribute */
		'a'	=>	array('href' => true),
		/* Allow <p/> with no attributes */
		'p' 	=>    array()
		);
	
		
	public function strip($html) {
		/* Tell Tidy to produce XHTML */
		$xhtml = tidy_repair_string($html, array('output-xhtml' => true));
		
		/* Load the dirty HTML into a DOMDocument */
		$dirty = new DOMDocument;
		$dirty->loadXml($xhtml);
		$dirtyBody = $dirty->getElementsByTagName('body')->item(0);
		
		/* Make a blank DOMDocument for the clean HTML */
		$clean = new DOMDocument();
		$cleanBody = $clean->appendChild($clean->createElement('body'));
		
		/* Copy the allowed nodes from dirty to clean */
		$this->copyNodes($dirtyBody, $cleanBody);
		
		/* Return the contents of the clean body */
		$stripped = '';
		foreach ($cleanBody->childNodes as $node) {
			$stripped .= $clean->saveXml($node);
		}
		return trim($stripped);
	}
	
	
	protected function copyNodes(DOMNode $dirty, DOMNode $clean) {

		foreach ($dirty->attributes as $name => $valueNode) {
			/* Copy over allowed attributes */
			if (isset($this->allowed[$dirty->nodeName][$name])) {
				$attr = $clean->ownerDocument->createAttribute($name);
				$attr->value = $valueNode->value;
				$clean->appendChild($attr);
			}
		}
		
		foreach ($dirty->childNodes as $child) {
			/* Copy allowed elements */
			if (($child->nodeType == XML_ELEMENT_NODE) && (isset($this->allowed[$child->nodeName]))) {
				$node = $clean->ownerDocument->createElement($child->nodeName);
				$clean->appendChild($node);
				
				/* Examine children of this allowed element */
				$this->copyNodes($child, $node);
				
			} else if ($child->nodeType == XML_TEXT_NODE) { /* Copy text */
				$text = $clean->ownerDocument->createTextNode(
				$child->textContent);
				$clean->appendChild($text);
			}
		}
	}
	
}

/*TagStripper in action*/
?>

$html=<<<_HTML_
<a href=foo onmouseover="bad()" >this is some</b>
stuff
<p>This should be OK, as <a href="beep">well</a> as this. </p>
<script>alert('whoops')<p>This gets removed.</p></script>
<p>But this <script>bad</script> stuff has the script removed.</p>
_HTML_;

<?php
$ts = new TagStripper();
print $ts->strip($html);

/*
Prints:
<a href="foo">this is some stuff</a>
<p>This should be OK, as <a href="beep">well</a> as this.</p>
<p>But this stuff has the script removed.</p>
*/
?>
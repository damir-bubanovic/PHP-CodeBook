<?php 
/*

!!PROGRAM: DOM EXPLORER!!

> The dom-explorer.php program provides a shell-like prompt to let you explore an HTML 
document interactively. 
	>> It reads an HTML document from a provided URL, parses it into a DOMDocument, 
	and then gives you a prompt at which you can enter commands to see the node structure 
	and contents of the documents.
	>> Additionally, dom-explorer.php uses the Readline word-completion features to more
	easily enter node locations. Enter a few characters and hit Tab to see a list of nodes 
	that match the characters you’ve typed


> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method

*file_get_contents - reads entire file into a string 
*explode - split a string by string
*array_shift - shift an element off the beginning of array
*is_callable - verify that the contents of a variable can be called as a function
*implode - join array elements with a string
*strlen - get string length
*substr - return part of a string

*/
?>

% php dom-explorer.php http://www.php.net
/html > ls
head body
/html > ls head
title style[1] comment()[1] style[2] comment()[2] meta link[1] link[2] link[3] ↵
script[1] link[4] script[2]
/html > cat head/title
PHP: Hypertext Preprocessor
/html > cd body
/html/body > ls
text()[1] div[1] text()[2] div[2] text()[3] div[3] text()[4] div[4] text()[5] ↵
div[5] text()[6] div[6] text()[7] script comment()
/html/body > cd div[2]
/html/body/div[2] > ls
a text()[1] div text()[2]
/html/body/div[2] > cat a
/html/body/div[2] > cat div
downloads |
documentation | faq
| getting help | mailing lists | licenses | wiki
| reporting bugs | php.net sites | conferences | my
php.net
/html/body/div[2] > exit

<?php 
/*dom-explorer.php*/
/* Need to specify a URL on the commandline */
isset($argv[1]) or die("No URL specified");

/* Load the HTML and start the command loop */
$explorer = new DomExplorer($argv[1]);
$explorer->loop();


class DomExplorer {
	
	public function __construct($url) {
		$html = file_get_contents($url);
		
		if(false === $html) {
			throw new Exception("Can't retrieve $url");
		}
		
		/* Turn the HTML into valid XHTML */
		$clean = tidy_repair_string($html, array('output-xhtml' => true));
		
		/* Load it into a DOMDocument, hiding any libxml warnings*/
		$this->doc = new DOMDocument();
		libxml_use_internal_errors(true);
		
		if(false === $this->doc->loadHtml($clean)) {
			throw new Exception("Can't parse {$url} as HTML");
		}
		libxml_use_internal_errors(false);
		$this->currentNode = $this->doc->documentElement;
		$this->x = new DOMXPath($this->doc);
	}
	

	public function loop() {
		
		/* The "completion" function will provide tab-completion at the prompt */
		readline_completion_function(array($this, 'completion'));
		
		while (true) {
			
			/* Use the current node as part of the prompt */
			$line = readline($this->currentNode->getNodePath() . ' > ');
			readline_add_history($line);
			
			/* The first word typed in is the command, the rest are arguments */
			$parts = explode(' ', $line);
			$cmd = array_shift($parts);
			
			/* Each command is a method, so call it if it exists */
			$cmd_function_name = "cmd_$cmd";
			
			if (is_callable(array($this, $cmd_function_name))) {
				try {
					$this->$cmd_function_name($parts);
				} catch(Exception $e) {
					print $e->getMessage() . "\n";
				}
			}
			else {
				print "Unknown Command: $line\n";
			}
		}
	}
	

	/*Command: exit the program*/
	protected function cmd_exit($args) {
		exit();
	}

	
	/* Command: list all nodes under the current node or a specified node*/
	protected function cmd_ls($args) {
		
		if(isset($args[0]) && strlen($args[0])) {
			$node = $this->resolvePath($args[0]);
		} else {
			$node = $this->currentNode;
		}
		
		print implode(' ' , $this->getChildNodePaths($node)) . "\n";
	}



	/*Command: change to a new current node*/
	protected function cmd_cd($args) {
		
		/* If an argument is provided, use it */
		if (isset($args[0]) && strlen($args[0])) {
			$this->currentNode = $this->resolvePath($args[0]);
		} else { /* Otherwise go back to the "root" */
			$this->currentNode = $this->doc->documentElement;
		}
	}



	/*Command: print the text content of a node*/
	protected function cmd_cat($args) {
		
		if(isset($args[0]) && strlen($args[0])) {
			$node = $this->resolvePath($args[0]);
			print $node->textContent . "\n";
		} else {
			throw new Exception("cat requires an argument");
		}
	}


	/*Get all the paths of the nodes under the provided
	node, trimming off the path of the current node from
	the paths of the child nodes*/
	protected function getChildNodePaths($node) {
		$children = array();
		$curdir = $node->getNodePath();
		
		foreach($node->childNodes as $node) {
			$path = $node->getNodePath();
			$sub = substr($path, strlen($curdir) + 1);
			$children[] = $sub;
		}
		
		return $children;
	}


	/*When tab is pressed, return an array of child
	node paths as possible completion targets*/
	protected function completion($str, $index) {
		return $this->getChildNodePaths($this->currentNode);
	}


	/*Resolve an xpath expression relative to the current
	node, and make sure it only matches 1 target node*/
	protected function resolvePath($arg) {
		$matches = $this->x->query($arg, $this->currentNode);
		
		if($matches === false) {
			throw new Exception("Bad expresion: $arg");
		}
		
		if($matches->length == 0) {
			throw new Exception("No match for $arg");
		}
		
		if($matches->length > 1) {
			throw new Exception("{$matches->length} matches for arg");
		}
		
		return $matches->item(0);
	}
}

?>
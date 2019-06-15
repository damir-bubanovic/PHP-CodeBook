<?php 
/*

!!CALL A METHOD ON AN OBJECT RETURNED BY ANOTHER METHOD!!

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)

*/

/*Call the second method directly from the first*/
$orange = $fruit->get('citrus')->peel();



/*You can design your classes to facilitate chaining calls repeatedly as 
if you’re writing a sentence. This is known as a fluent interface*/

/*Good illustration of the design practices*/
class Tweet {
	protected $data;
	
	public function from($from) {
		$data['from'] = $from;
		return $this;
	}
	
	public function withStatus($status) {
		$data['status'] = $status;
		return $this;
	}
	
	public function inReplyToId($id) {
		$data['id'] = $id;
		return $this;
	}
	
	public function send() {
		// Generate Twitter API request using info in $data
		// POST https://api.twitter.com/1.1/statuses/update.json
		// with http_build_query($data)
		return $id;
	}
}
	

/*Using classes*/
$tweet = new Tweet;
$tweet  ->from('@rasmus')
		->withStatus('PHP 6 released! #php')
		->send();

$reply = new Tweet;
$id = $reply->withStatus('I <3 Unicode')
		->from('@a')
		->inReplyToId($id)
		->send();

?>
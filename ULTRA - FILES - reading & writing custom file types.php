<?php 
/*

!!FILES - READING & WRITING CUSTOM FILE TYPES!!

> You want to use PHP’s standard file access functions to provide access to data that might
not be in a file. 
	>> npr. you want to use file access functions to read from and write to shared memory. 
	>> or npr. or you want to process file contents when they are read before they reach PHP
	
> Stream wrappers handle the details of moving data back and forth between PHP and your custom 
location or your custom format. 
	>> This class implements the methods PHP needs to access your custom data stream: 
	opening, closing, reading, writing, and so on.
	>> A particular wrapper is registered with a particular prefix. You use that prefix when
	passing a filename to fopen(), include(), or any other PHP file-handling function to
	ensure that your wrapper is invoked.
> Stream wrappers are handy for nonfile data sources, but they can also be used to preprocess
file contents on their way into PHP. Example below demonstrates a clever example of this as 
applied to templating. 
	>> With short_open_tags turned off, printing an object instance variable in a template 
	requires the comparatively verbose <?php echo $this->property; ?>. 
	>> This solution uses a stream wrapper that allows the @ character to stand in for echo $this->.
	

> VISIBILITY
	- public		can be accessed everywhere
	- private		can only be accessed by the class that defines it
	- protected		can be accessed only within the class itself and by inherited classes (children)
	- static		properties or methods as static makes them accessible without needing an instantiation of the class
						> pseudo-variable $this is not available inside the method


*stream_register_wrapper - register a URL wrapper implemented as a PHP class
							- use stream_wrapper_register instead
*fopen - opens file or URL
*fwrite - binary-safe file write
*time - return current Unix timestamp
*fclose - closes an open file pointer
*str_replace - replace all occurrences of the search string with the replacement string
*file_get_contents - reads entire file into a string
*stat - gives information about a file
*ini_get - gets the value of a configuration option
*preg_replace - perform a regular expression search and replace
*strlen - get string length
*dirname - returns a parent directory's path
*in_array - checks if a value exists in an array
*stream_get_wrappers - retrieve list of registered streams
*stream_wrapper_register - register a URL wrapper implemented as a PHP class

*/


/*Use the PEAR Stream_SHM module, which implements a stream wrapper that reads
from and writes to shared memory*/
require_once 'Stream/SHM.php';
stream_register_wrapper('shm', 'Stream_SHM') or die("can't register shm");
$shm = fopen('shm://0xabcd','c');
fwrite($shm, "Current time is: " . time());
fclose($shm);


/*stream wrapper code
- to convert markup of mostly PHP templates into PHP prior to include()*/
class ViewStream {
	// Current stream position
	private $pos = 0;	
	// Data for streaming
	private $data = 0;
	// Stream stats
	private $stat;
	
	
	// Opens the script file and converts markup.
	public function stream_open($path, $mode, $options, &$opened_path) {
		// get the view script source
		$path = str_replace('view://', '', $path);
		$this->data = file_get_contents($path);
		
		/*If reading the file failed, update our local stat store
		to reflect the real stat of the file, then return on failure*/
		if($this->data === false) {
			$this->stat = stat($path);
			return false;
		}
		
		
		/*Convert <?= ?> to long-form <?php echo ?> 		
		We could also convert <%= like the real T_OPEN_TAG_WITH_ECHO but 
		that's not necessary		
		It might be nice to also convert PHP code blocks <? ?> but
		let's quit while we're ahead. It's probably better to keep
		the <?php for larger code blocks but that's your choice. If
		you do go for it, explicitly check for <?xml as this will
		probably be the biggest headache.
		*/
		if(!ini_get('short_open_tag')) {
			$find = '/\<\?\= (.*)? \?>/';
			$replace = "<?php echo \$1 ?>";
			$this->data = preg_replace($find, $replace, $this->data);
		}
		
		/*Convert @$ to $this->		
		We could make a better effort at only finding @$ between <?php ?>
		but that's probably not necessary as @$ doesn't occur much in the wild
		and there's a significant performance gain by using str_replace().*/
		$this->data = str_replace('@$', '$this->', $this->data);
		
		
		/*file_get_contents() won't update PHP's stat cache, so performing
		another stat() on it will hit the filesystem again. Since the file
		has been successfully read, avoid this and just fake the stat
		so include() is happy.*/
		$this->stat = array('mode' => 0100777, 'size' => strlen($this->data));
		
		return true;
	}
	
	
	// Read from the stream
	public function stream_read($count) {
		$ret = substr($this->data, $this->pos, $count);
		$this->pos += strlen($ret);
		
		return $ret;
	}
	
	
	// Tells the current position in the stream
	public function stream_tell() {
		return $this->pos;
	}
	
	
	// Tells if we are at the end of the stream.
	public function stream_eof() {
		return $this->pos >= strlen($this->data);
	}
	
	
	// Stream statistics
	public function stream_stat() {
		return $this->stat;
	}
	
	
	// Seek to a specific point in the stream.
	public function stream_seek($offset, $whence) {
		switch($whence) {
			case SEEK_SET:
				if(offset < strlen($this->data) && $offset >= 0) {
					$this->pos = $offset;
					return true;
				} else {
					return false;
				}
				break;
			case SEEK_CUR:
				if($offset >= 0) {
					$this->pos += $offset;
					return true;
				} else {
					return false;
				}
				break;
			case SEEK_END:
				if(strlen($this->data) + $offset >= 0) {
					$this->pos = strlen($this->data) + $offset;
					return true;
				} else {
					return false;
				}
				break;
			default:
				return false;
		}
	}
}

/*And a sample template:*/
?>

<html> <?= @$hello ?> </html>

<?php 
/*They work together as so*/
/** Stream wrapper */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'ViewStream.php';


/*A very dumb template class just to demonstrate the concept*/
class IdiotSavant {
	
	public function __construct() {
		if(!in_array('view', stream_get_wrappers())) {
			stream_wrapper_register('view', 'ViewStream');
		}
	}
	
	public function render($filename) {
		include 'view://' . dirname(__FILE__) . DIRECTORY_SEPERATOR . $filename . '.html';
	}
}


// Create a new view
$view = new IdiotSavant();

// Assign the variable "hello" to the scope of the view
$view->hello = 'Hello, World!';

// Render the view from a template. Outputs "<html> Hello, World! </html>"
$view->render('ExampleTemplate');

?>
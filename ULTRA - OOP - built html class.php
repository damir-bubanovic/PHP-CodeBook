<?php 
/*Code to built the html class*/
class html {
	/*first - class properties (variables) are defined first*/
	private $tag;
	/*second - define the method (class function)*/
	function __construct() {
		/*third - class constructor, builds to the top of HTML page*/
		/*each time class is constructed*/
		$this->tag = "<HTML>";
		$this->tag .= "<HEAD>";
		$this->tag .= "<title>$title</title>";
		$this->tag .= "</HEAD><BODY>";
		print $this->tag;
		return;
	}
	
	function page_end() {
		/*end of HTML page, close the body and the html tags*/
		$this->tag = "</BODY></HTML>";
		return $this->tag;
	}
	
	function RawText($textString, $textColor="black", $bgcolor='', $fontSize="", $fontWeight="normal") {
		// this method is for sending raw unformatted text to the browser
		$this->tag = "<span style='color: $textColor ; background-color: $bgcolor ;
		font-size: $fontSize ; font-weight: $fontWeight'>" ;
		$this->tag .= "$textString";
		$this->tag .= "</span>" ;
		return $this->tag ;
	}
	
	function Image($source, $title="", $height="", $width="", $align="center", $border=0, $valign="middle",
	$class="", $id="", $name="", $onType1="", $onAction1="", $onType2="", $onAction2="", $onType3="", $onAction3="") {
	// this method is for adding images to the html page, it has
	// room for up to 3 onactions (onclick, onblur, onmouseup, etc)for each method call
		$this->tag = '<img src="' . $source . '" ' ;
		if ($name) $this->tag .= 'name="' . $name . '" ' ;
		if ($height == "") $height = "16" ;
		if ($width == "") $width = "16" ;
		$this->tag .= 'height="' . $height . '" width="' . $width . '" ' ;
		$this->tag .= 'border="' . $border . '" ' ;
		if ($class) $this->tag .= 'class="' . $class . '" ' ;
		if ($id) $this->tag .= 'id="' . $id . '" ' ;
		if ($title) $this->tag .= 'title="' . $title . '" alt="' . $title . '" ' ;
		if ($align) $this->tag .= 'align="' . $align . '" ' ;
		if ($valign) $this->tag .= 'valign="' . $valign . '" ' ;
		if ($onType1) $this->tag .= $onType1 . '="' . $onAction1 . '" ' ;
		if ($onType2) $this->tag .= $onType2 . '="' . $onAction2 . '" ' ;
		if ($onType3) $this->tag .= $onType3 . '="' . $onAction3 . '" ' ;
		$this->tag .= "/>" ;
		return $this->tag ;
	}

	function Spacer($spaces = 1) {
		$this->tag = "";
		for ($i=1 ; $i <= $spaces ; $i++) {
			$this->tag .= "&nbsp;" ;
		}
		return $this->tag;
	}
	
	function NewLine($number = 1) {
		$this->tag = '';
		for ($i=1 ; $i <= $number ; $i++) {
			$this->tag .= "<br/>" ;
		}
		return $this->tag;
	}
};
?>
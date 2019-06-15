<?php 
/*Code to built table class*/
class table {
	private $tag ;
	
	function Begin($border=0, $align="center", $width='100%', $cellpadding=2, $cellspacing=2, $class='', $id='', $bgcolor='', $style='') {
		$this->tag = '<table ' ;
		if ($align) $this->tag .= 'align="' . $align . '" ' ;
		if ($width) $this->tag .= 'width="' . $width . '" ' ;
		if ($border > 0) $this->tag .= 'border="' . $border . '" ' ;
		if ($cellpadding > 0) $this->tag .= 'cellpadding="' . $cellpadding . '" ' ;
		if ($cellspacing > 0) $this->tag .= 'cellspacing="' . $cellspacing . '" ' ;
		if ($class) $this->tag .= 'class="' . $class . '" ' ;
		if ($id) $this->tag .= 'id="' . $id . '" ' ;
		if ($bgcolor) $this->tag .= 'bgcolor="' . $bgcolor . '" ' ;
		if ($style) $this->tag .= 'style="' . $style . '" ' ;
		$this->tag .= ">" ;
		return $this->tag ;
	}
	
	function Header($text) {
		$this->tag = '<th>' . $text . '</th>' ;
		return $this->tag ;
	}
	
	function RowOn($align="", $bgcolor="", $class="", $height="") {
		$this->tag = '<tr ' ;
		if ($align) $this->tag .= 'align="' . $align . '" ' ;
		if ($bgcolor) $this->tag .= 'bgcolor="' . $bgcolor . '" ' ;
		if ($class) $this->tag .= 'class="' . $class . '" ' ;
		if ($height) $this->tag .= 'height="' . $height . '" ' ;
		$this->tag .= ">" ;
		return $this->tag ;
	}
	
	function ColumnOn($colspan=1, $align='left', $width="", $rowspan="", $bgcolor="", $class="", $valign="", $height="") {
		$this->tag = '<td ' ;
		if ($align) $this->tag .= 'align="' . $align . '" ' ;
		if ($colspan) $this->tag .= 'colspan="' . $colspan . '" ' ;
		if ($width) $this->tag .= 'width="' . $width . '" ' ;
		if ($rowspan) $this->tag .= 'rowspan="' . $rowspan . '" ' ;
		if ($bgcolor) $this->tag .= 'bgcolor="' . $bgcolor . '" ' ;
		if ($class) $this->tag .= 'class="' . $class . '" ' ;
		if ($height) $this->tag .= 'height"' . $height . '" ';
		if ($valign) $this->tag .= "valign='" . $valign . "'>" ;
		if (!$valign) $this->tag .= "valign='middle'>" ;
		return $this->tag ;
	}
	
	function ColumnOff() {
		$this->tag = '</td>' ;
		return $this->tag ;
	}
	
	function RowOff() {
		$this->tag = '</tr>' ;
		return $this->tag ;
	}
	
	function End() {
		$this->tag = '</table>' ;
		return $this->tag ;
	}
} // end class table
?>
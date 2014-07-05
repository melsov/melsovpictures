<?php

class Size
{
	public $width;
	public $height;
	
	function __construct($w,$h) {
		$this->width = $w;
		$this->height = $h;
	}
	
	public function toStyleString() {
		return "width: ".$this->width."px; height: ".$this->height."px;";
	}
	
	public function toCaptionString() {
		$cmSize = Size::ToCMs(this);	
		$cmSize->removeDecimal();
		$this->removeDecimal();
		return "$this->height X $this->width inches / $cmSize->height x $cmSize->width cm";
	}
	
	public static function ToCMs($size) {
		$w = $size->width * 2.54;
		$h = $size->height * 2.54;
		return new Size($w, $h);
	}
	
	public function removeDecimal() {
		$this->width = floor($this->width);
		$this->height = floor($this->height);
	}
	
	public function smallerDim() {
		return $this->width < $this->height ? $this->width : $this->height ;
	}
	public function isHeightSmaller() {
		return $this->width < $this->height ? FALSE : TRUE;
	}
}
?>
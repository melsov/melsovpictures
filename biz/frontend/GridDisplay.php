<?php
require_once("AutoLoader.php");

class GridDisplay
{
	public $width = 500;
	public $height = 700;
	public $cols = 3;
	public $rows = 5;
	private $contentProvider;
	
	function __construct($formatter)
	{
		$this->setContentProvider($formatter);
	}
	
	public function setContentProvider($formatter) {
		if (!($formatter instanceof iContentProvider)) {
			throw new Exception("need a grid formatter");
		}
		$this->contentProvider = $formatter;
	}
	
	public function getContentProvider() { return $this->contentProvider; }
	
	private function tileWidth() {
		return $this->width/$this->cols;
	}
	
	private function tileHeight() {
		return $this->height/$this->rows;
	}
	
	private function gridItemSize() {
		$size = new Size($this->tileWidth(), $this->tileHeight());
		return $size;
	}
	
	public function getHTML()
	{
		$html = "";
		$count = 0;
		$this->contentProvider->setSize($this->gridItemSize());
		
		for($i=0;$i<$this->rows;++$i)
		{
			$html .= "\t<div style='float: left; width: 100%; border: ".Debug::Border()."; text-align: center; '  >";
			for($j=0;$j<$this->cols;++$j)
			{
				$html .= "\t\t ".$this->contentProvider->getHTML(new LookupPosition($count++))." \n";
			}
			$html .= "\t</div>\n";
			$html .= "<br />";
		}
		
		return $html;
	}
	
}


?>
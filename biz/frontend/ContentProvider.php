<?php
/**
 * provides html content to a display (example: a grid display)
 */
 
 require_once("AutoLoader.php");
 // require_once 'GridDisplay.php';
 

class ContentProvider implements iContentProvider
{
	public $size;
	public $queryMaker;
	private $dataRows = null;
	
	function __construct($queryMaker_) {
		$this->queryMaker = $queryMaker_;
	}

	public function getHTML($lookup_position)
	{
		$result = "";
		$rows = $this->getDataRows();
		
		$index = $lookup_position->index;
		if ($rows == null || count($rows) <= $index) return $result;
		
		$color = $this->sillyColor($index);
		$result = "<div style='float:left; background-color:$color; ".$this->size->toStyleString()." ' >";
		$contentItem = $rows[$index]; 
		$result .= $this->imgTagWithContentItem($contentItem);
		$result .= $contentItem->artworkData->getCaption();
		$result .= "blah: $index";
		$result .= "</div>";
		
		return "$result";
	}

	private function imgTagWithContentItem($contentItem) 
	{
		$src = $contentItem->contentData->src;

		$tag = "<img src='".SiteConstants::ContentURLWithSrc($src)."' ";
		// TODO: this size algo doesn't really do the trick. (fix)
		if ($this->size != null) {
			$hw_ = "";
			if ($this->size->isHeightSmaller()) {
				$hw = " height='".$this->size->height."' ";
			} else {
				$hw = " width='".$this->size->width."' ";
			}
			$tag .= $hw; 
		}
		return $tag." />";
	}

	
	public function setSize($size) {
		if (!($size instanceof Size)) throw new Exception("Content provider needs a Size class object for its size.", 1);
		$this->size = $size;
	}
	
	private function getDataRows() {
		if ($this->dataRows == null) {
			$result = $this->queryMaker->getContentItemsData();
			$datars = array();
			while($_row = $result->fetch_assoc())
			{
				$contentItem = ContentItem::ContentItemWithCapsTableRow($_row);
				$datars[] = $contentItem;
			}
			$this->dataRows = $datars;
		}
		return $this->dataRows;
	}

	private function sillyColor($i) {
		if ($i % 2 == 0)
			return "#F00";
		return "#03F";
	}
	
}


?>
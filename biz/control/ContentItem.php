<?php
class ContentItem
{
	public $contentData;
	public $artworkData;
	
	function __construct($contentData_, $artworkData_) {
		$this->setContentData($contentData_);
		$this->setArtworkData($artworkData_);
	}
	
	public static function ContentItemWithCapsTableRow($row)
	{
		$contentData_ = ContentData::ContentDataWithCapsTableRow($row);
		$artworkData_ = ArtworkData::ArtworkDataWithCapsTableRow($row);
		return new ContentItem($contentData_, $artworkData_);
	}
	
	public function setContentData($cdata) {
		if ($cdata != null && !($cdata instanceof ContentData)) throw new Exception("ContentItem needs a ContentData type object", 1);
		$this->contentData =$cdata;		
	}
	
	public function setArtworkData($awdata) {
		// if ($awdata != null && !($$awdata instanceof ArtworkData)) throw new Exception("ContentItem needs a ArtworkData type object", 1);
		$this->artworkData =$awdata;		
	}	

}
?>
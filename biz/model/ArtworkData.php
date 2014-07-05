<?php
class ArtworkData
{
	public $title;
	public $sizeInches;
	public $year;
	public $media;
	public $notes;
	
	function __construct() {
		
	}
	
		
	public static function ArtworkDataWithCapsTableRow($row)
	{
		$artworkData_ = new ArtworkData();				
		$artworkData_->title = $row['section'];
		$artworkData_->year = $row['cateogy'];
		$artworkData_->media= $row['src'];
		$artworkData_->notes = $row['notes'];
		$size = new Size($row['width'], $row['height']); 
		$artworkData_->sizeInches = $size;
		return $artworkData_;
	}
	
	public function getCaption() {
		$size_str = $this->sizeInches->toCaptionString();
		$caption = "$this->title $this->year. $size_str $this->media. $this->notes";
		return $caption;
	}
	
}
?>

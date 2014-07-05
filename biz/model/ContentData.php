<?php
class ContentData
{
	public $section;
	public $category;
	public $src = "";
	public $id = -1;
	
	function __construct() {
	}
	
	public static function ContentDataWithCapsTableRow($row)
	{
		$contentData_ = new ContentData();				
		$contentData_->section = $row['section'];
		$contentData_->category = $row['category'];
		$contentData_->src = $row['src'];
		$contentData_->id = $row['id'];
		return $contentData_;
	}
	
	public static function ContentDataFromURLQueryString()
	{
		$contentData_ = new ContentData();				
		$contentData_->section = $_GET['sec'];
		$contentData_->category = $_GET['category'];
		$contentData_->src = null;
		$contentData_->id = $_GET['id'];
		// TODO: page info? prev/next page etc.?
		return $contentData_;
	}
}
?>
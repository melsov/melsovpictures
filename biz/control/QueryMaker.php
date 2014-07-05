<?php
require_once("AutoLoader.php");

class QueryMaker
{
	public $contentItem;
	private $dbHandle;
	public $tableName = "caps";
	
	function __construct($dbHandle_, $contentItem_){
		$this->setContentItem($contentItem_);
		$this->dbHandle = $dbHandle_;
	}	
	
	public function setContentItem($cItem) {
		if ($cItem != null && !($cItem instanceof ContentItem)) throw new Exception("Query Maker needs a ContentItem type object", 1);
		$this->contentItem =$cItem;		
	}
	
	public function getContentItemsData() {
		$query = $this->getContentItemsQueryString();
		$rows = $this->dbHandle->query($query);
		return $rows;
	}
	
	private function getContentItemsQueryString() {
		$q = "SELECT * FROM ".$this->tableName;
		if ($this->contentItem == null) return $q;
		
		$q .= " WHERE";
		
		$cdata = $this->contentItem->contentData;
		
		if ($cdata->id != -1) {
			$q .= " id='".$cdata->id."'";
			return $q;
		}
		
		if ($cdata->section != null) {
			$q .= " section='".$cdata->section."'";
			if ($cdata->category != null) {
				$q .= " AND category='".$cdata->category."'";
			}
		}
		
		return $q;
	}
}
?>
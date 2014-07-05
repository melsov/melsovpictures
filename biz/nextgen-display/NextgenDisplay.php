<?php

include_once("wp-admin/includes/file.php");
class NextgenDisplay
{
	private $ngendata;
	public function __construct($_nextgen_data){
		$this->ngendata = $_nextgen_data;
		
		//....
		$this->wpGalleryRelPath();
	}
	
	private function displayMode() {
		if ($this->ngendata->image != "") {
			return 3;
		} if ($this->ngendata->gallery != "") {
			return 2;
		}
		return 1;
	}
	public function display() {
		$display_mode = $this->displayMode();
		if ($display_mode == 3) {
			$this->singleImage();
		} else {
			$this->galleryDisplay();
		}
	}
	
	private function galleryURL() {
		return $this->wpBaseURL()."/".$this->wpGalleryRelPath()."/".$ngendata->gallery;
	}
	private function galleryRootPath() {
		return $this->wpRootPath().$this->wpGalleryRelPath()."/".$ngendata->gallery;
	}
	private function wpGalleryRelPath() {
		return "wp-content/gallery";
	}
	private function wpRootPath() {
		return get_home_path();
	}
	private function wpBaseURL() {
		return get_home_url();
	}
	private function imagePath() {
		if ($this->ngendata == null || $this->ngendata->image == "") return FALSE;
		return $this->galleryRootPath()."/".$this->ngendata->image;
	}
	private function imageURL() {
		if ($this->ngendata == null || $this->ngendata->image == "") return FALSE;
		return $this->galleryURL()."/".$this->ngendata->image;
	}
	
	private function singleImage() {
		
	}
	
	private function galleryDisplay() {
		
	}
}
?>
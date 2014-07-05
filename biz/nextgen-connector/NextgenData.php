<?php


class NextgenData
{
	public $album;
	public $gallery;
	public $image;
	private $ngen_gallery_obj;
	
	public function __construct() {
		
	}
	
	public static function FromURL($url) {
		$nd = new NextgenData();
		$nd->album = NextgenData::getAlbumFromURL($url);
		$nd->gallery = NextgenData::getGalleryFromURL($url);
		$nd->image = NextgenData::getImageFromURL($url);
		$nd->setNGenObject(NextgenData::GetCurrentGallery($nd->gallery));		
		return $nd;
	}
	public function setNGenObject($ngen_obj) {
		$this->ngen_gallery_obj = $ngen_obj;
	}
	public function galID() {
		if ($this->ngen_gallery_obj != null) return $this->ngen_gallery_obj->gid;
		return null; 
	}
	public function galleryObject() {
		return $this->ngen_gallery_obj;
	}
	
	private static function getAlbumFromURL($url) { return getGalleryNameFromURL($url, 1); }
	private static function getImageFromURL($url) { return getGalleryNameFromURL($url, 4); }
	
	private static function getGalleryFromURL($url, $wantAlbum=2) 
	{
		$urls = NextgenData::urlAsArray($url);
		$i=0;
		foreach ($urls as $key => $str) {
			if ($str=="nggallery") {
				$i=$key;
				$i+= $wantAlbum; // ? 1 : 2;
				break;
			}
		}
		if ($i < count($urls)) {
			$name = $urls[$i];
			$names = explode('?', $name);
			return $names[0];
		}
		return "";
	}
	private static function urlAsArray($url) {
		return explode('/', $url);
	}
	private static function GetCurrentGallery($galName) {
		global $nggdb;
		$gals = $nggdb->find_all_galleries();
		foreach ($gals as $key => $gal) {
			if (strtolower($galName) == strtolower($gal->slug)) {
				return $gal;  
			}
		}
		return null;
	}
	public function toString() {
		return sprintf(
	    "album: %s : gallery: %s galID: %s ",$this->album, $this->gallery, $this->galID()
		);
	}
	public function debug() { echo $this->toString(); }
}
?>
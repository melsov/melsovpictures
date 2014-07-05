<?php

class NextgenDatabaseHelper
{
	public static function ImagesForGalID($gid) 
	{
		global $nggdb;
		$ims = $nggdb->get_ids_from_gallery($gid);
		
		echo "<br>";
		foreach ($ims as $key => $im) {
			if ($i = $nggdb->find_image($im)) {
				print $i->get_href_thumb_link(); 
			} else {
				print "*****NO IMAGE*******";
			}
			echo "<br />";
		}
		
	}
	
	private static function IsImage($path) {
		if (exif_imagetype($path)) return TRUE;
		return FALSE;
	}
	
}
?>
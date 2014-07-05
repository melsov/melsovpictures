<?php
class SiteConstants
{
	public static $ContentURLBase = "http://www.johnnewsom.info/ww/ww/Content";
	
		
	public static function ContentURLWithSrc($src) {
		return SiteConstants::$ContentURLBase."/".$src;
	} 
}
?>
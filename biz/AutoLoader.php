<?php


// set_include_path(get_include_path().PATH_SEPARATOR.)
spl_autoload_register('autoloader::classLoader');

class autoloader
{
	
	private static $www_path;
	private static $doc_root;
	private static $_dirs;
	
	public static function classLoader($class_name)
	{
		// loading logic
		$filename = $class_name.'.php';
		if (!self::check_is_file($filename))
		{
			echo "<br>auto loader fail? this was not a file: ".$filename;
			return;
		}
		
		include $filename;
	}
	
	public static function init()
	{
		self::$doc_root = $_SERVER['DOCUMENT_ROOT'];
		self::$www_path = "ww/ww";
		if ("/Applications/MAMP/htdocs" == $_SERVER['DOCUMENT_ROOT'])
			self::$www_path = "jntwoo/ww";
		
		self::$_dirs = array(
			'.',
			 'phps', 
			 'phps/model',
			 'phps/view',
			 'els', 
			 'control',
			 'frontend',
			 'model' );
		
		$include_string = get_include_path();
		foreach (self::$_dirs as $sub_path) {
			$include_string .= PATH_SEPARATOR.self::full_www_path()."/".$sub_path;
		}
		set_include_path($include_string);
	}
	
	public static function check_is_file($filename) {
		foreach (self::get_include_paths() as $inc_path) {
			if (is_file($inc_path."/".$filename))
				return TRUE;
		}
		return FALSE;
	}
	
	public static function get_include_paths() {
		$result = array();
		foreach (self::$_dirs as $sub_path) {
			$result[] = self::full_www_path()."/".$sub_path;
		}
		return $result;
	}
	
	private static function full_www_path() {
		return self::$doc_root."/".self::$www_path;
	}
	
}
autoloader::init();

?>
<?php
class Codexscape_Loader
{
	public static function registerAutoload($class = "Codexscape_Loader")
	{
		if (!function_exists('spl_autoload_register'))
		{
			throw new Exception('spl_autoload does not exist in this PHP installation.');
		}
		
		spl_autoload_register(array($class, 'autoload'));
	}
	
	public static function autoload($class)
	{
		$file = str_replace("_", "/", $class).".php";
		require_once($file);
	}
}
?>
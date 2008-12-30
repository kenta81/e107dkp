<?php
/* DO NOT EDIT THIS FILE UNLESS YOU ABSOLUTELY KNOW WHAT YOU ARE DOING. */
// Ensure that all the required directories are on the include path.
set_include_path(dirname(__FILE__)."/library".PATH_SEPARATOR.
				 dirname(__FILE__)."/models".PATH_SEPARATOR.
				 dirname(__FILE__)."/tables".PATH_SEPARATOR.
				 get_include_path());

// Register the autoloader for the Codexscape library.
require_once("Codexscape/Loader.php");
Codexscape_Loader::registerAutoload();
?>
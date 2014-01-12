<?php 

$config = dirname(__FILE__).DIRECTORY_SEPARATOR.'protected'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR;

if ( $_SERVER['SERVER_NAME'] == 'localhost' ) {
	$config .= 'development.php';
	if (!ini_get('display_errors')) ini_set('display_errors', 1);	
}
else $config .= 'production.php';

// modify this path as appropriate
$bg = dirname(__FILE__).DIRECTORY_SEPARATOR.'/../../app.php';
require_once($bg);
BG::createWebApplication($config)->buildPage();
?>
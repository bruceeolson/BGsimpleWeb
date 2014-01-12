<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" data-json='<?php echo BG::app()->jsParams();?>'>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="some key words" />
    <meta name="description" content="something about page - <?php echo BG::app()->page;?>" />
    
    <title><?php echo BG::app()->pageTitle; ?></title>
    
	<link rel="stylesheet" type="text/css" href="<?php echo BG::app()->baseUrl;?>/css/main.css" media="all" />
</head>

<body>

<div id="pageContainer"> 
    
	<div id="header">
    	<ul id="mainMenu" class="clearfix">
        	<li><?php echo BG::app()->link('About','/About');?></li>
        	<li><a href="<?php echo BG::app()->baseUrl;?>/Contact">Contact</a></li>
        </ul>
    </div>
 

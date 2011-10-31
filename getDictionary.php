<?php
//getDictionary.php
require 'lib/func.joomlaajax.php';
defined('_JEXEC') or die('Restricted access');
jimport('joomla.environment.request');
$ac = & JFactory::getUser();
$us = $ac->get('username');
$name = JRequest::getVar('name');
$url = "julius/user/$us/package/dic/$name.xml";
$xml = simplexml_load_file($url);
echo $xml->asXML();
?>
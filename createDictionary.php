<?php
require 'lib/func.joomlaajax.php';
require_once 'lib/func.createDictionary.php';
defined('_JEXEC') or die('Restricted access');
jimport('joomla.environment.request');
$url = JRequest::getVar('url');
$c = new createDictionary($url);
$c->create();
echo "true";
?>

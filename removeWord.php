<?php

//addWord.php
require 'lib/func.joomlaajax.php';
defined('_JEXEC') or die('Restricted access');
require 'lib/func.wordXML.php';
jimport('joomla.environment.request');
?>
<?php

/////////////////Request Values/////////////////////////////////////////////////
$id = JRequest::getVar('wordid');
///////////////////Add XML DB//////////////////////////////////////////////////
$ac = & JFactory::getUser();
$us = $ac->get('username');
$url = "julius/user/$us/word.xml";
$w = new word($url);
$result = $w->remove($id);
print_r($result);
//////////////////END///////////////////////////////////////////////////////////
?>

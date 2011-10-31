<?php

//addWord.php
require 'lib/func.joomlaajax.php';
defined('_JEXEC') or die('Restricted access');
require 'lib/func.wordXML.php';
jimport('joomla.environment.request');
?>
<?php

/////////////////Request Values/////////////////////////////////////////////////
$data['wordid'] = JRequest::getVar('wordid');
$data['text'] = JRequest::getVar('text');
$data['pronun'] = JRequest::getVar('pronun');
$data['output'] = JRequest::getVar('output');
///////////////////Add XML DB//////////////////////////////////////////////////
$ac = & JFactory::getUser();
$us = $ac->get('username');
$url = "julius/user/$us/word.xml";
$w = new word($url);
$result = $w->update($data);
print_r($result);
//if ($result) {
//    echo "true";
//}else{
//    echo "false";
//}
//////////////////END///////////////////////////////////////////////////////////
?>

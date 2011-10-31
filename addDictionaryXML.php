<?php

//addDictionaryXML.php
require 'lib/func.joomlaajax.php';
defined('_JEXEC') or die('Restricted access');
jimport('joomla.environment.request');
/////////////////Request Values/////////////////////////////////////////////////
$data = JRequest::getVar('data');
$pk = JRequest::getVar('pk');
$ac = & JFactory::getUser();
$us = $ac->get('username');
$list = split(" ", $data);
$url = "julius/user/$us/package/dic/$pk.xml";
$str = "<?xml version=\"1.0\" encoding=\"utf-8\"?><dictionary>";
foreach ($list as $w) {
    $str .= '<wordid>' . $w . '</wordid>';
}
$str .= '</dictionary>';
$cmd = "echo '".$str."' > " . $url;
exec($cmd);
?>
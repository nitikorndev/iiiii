<?php

require '../lib/func.joomlaajax.php';
require '../lib/func.connection.php';
jimport( 'joomla.environment.request' );
/////////////////INPUT//////////////////////////////////////////////////////////
$connect = new connection;
$db = $connect->getDB();
$row = new JObject();
$row->id = JRequest::getVar('id');
$row->level = JRequest::getVar('type');
$row->expire = JRequest::getVar('expire');
$db->updateObject('jos_users_detail', $row, 'id');
echo 'true';
?>
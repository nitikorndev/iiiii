<?php

require '../lib/func.joomlaajax.php';
require '../lib/func.connection.php';
jimport( 'joomla.environment.request' );
/////////////////INPUT//////////////////////////////////////////////////////////
$connect = new connection;
$db = $connect->getDB();
$row = new JObject();
$row->id = JRequest::getVar('id');
$row->password = sha1(JRequest::getVar('password'));
$db->updateObject('jos_users_detail', $row, 'id');
echo 'true';
?>
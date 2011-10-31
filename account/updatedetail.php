<?php

require 'checkAll.php';
require '../lib/func.joomlaajax.php';
require '../lib/func.connection.php';
jimport( 'joomla.environment.request' );
/////////////////INPUT//////////////////////////////////////////////////////////
$list['password'] = JRequest::getVar('password');
$list['mail'] = JRequest::getVar('mail');
/////////////////CHECK//////////////////////////////////////////////////////////
$check = new checkAll();
$check->start($list);
$connect = new connection;
$db = $connect->getDB();
$row = new JObject();
$row->id = JRequest::getVar('id');
$row->password = sha1($list['password']);
$row->fname = JRequest::getVar('fname');
$row->lname = JRequest::getVar('lname');
$row->mail = $list['mail'];
$db->updateObject('jos_users_detail', $row, 'id');
echo 'true';
?>
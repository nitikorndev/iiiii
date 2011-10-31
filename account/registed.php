<?php
//Registed.php
require 'checkAll.php';
require '../lib/func.joomlaajax.php';
require '../lib/func.connection.php';
jimport( 'joomla.environment.request' );
/////////////////INPUT//////////////////////////////////////////////////////////
$list['username'] = JRequest::getVar('user');
$list['password'] = JRequest::getVar('pass');
$list['password2'] = JRequest::getVar('pass2');
$list['mail'] = JRequest::getVar('mail');
/////////////////CHECK//////////////////////////////////////////////////////////
$check = new checkAll();
$check->start($list);
if($list['password']==$list['password2']&&$check->status()){
$connect = new connection;
$db = $connect->getDB();
$query = "SELECT username FROM jos_users_detail WHERE username = '".$list['username']."'";
$db->setQuery($query);
$result = $db->query();
$num = $db->getNumRows();
if($num<1){
///////////////////////////Create data object//////////////////////////////////
$row = new JObject();
$row->username = $list['username'];
$row->level = JRequest::getVar('level');
$row->password = sha1($list['password']);
$row->apikey = strtolower(sha1($list['username'])."".substr(crypt($list['password'],0,5)));
$row->fname = JRequest::getVar('fname');
$row->lname = JRequest::getVar('lname');
$row->mail = $list['mail'];
$row->expire = JRequest::getVar('exp');
$db->insertObject('jos_users_detail', $row);

function full_copy( $source, $target ) {
	if ( is_dir( $source ) ) {
		@mkdir( $target );
		$d = dir( $source );
		while ( FALSE !== ( $entry = $d->read() ) ) {
			if ( $entry == '.' || $entry == '..' ) {
				continue;
			}
			$Entry = $source . '/' . $entry; 
			if ( is_dir( $Entry ) ) {
				full_copy( $Entry, $target . '/' . $entry );
				continue;
			}
			copy( $Entry, $target . '/' . $entry );
		}
 
		$d->close();
	}else {
		copy( $source, $target );
	}
}

mkdir("../julius/user/".$row->username);
$source ="../julius/user/test";
$destination = "../julius/user/".$row->username;
full_copy($source, $destination);

echo "true";
}
}
/////////////////////////END////////////////////////////////////////////////////
?>

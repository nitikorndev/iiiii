<?php
require '../lib/func.joomlaajax.php';
require '../lib/func.connection.php';
jimport( 'joomla.environment.request' );
$user1 = JRequest::getVar('user');
$connect = new connection;
$db = $connect->getDB();
$query = "SELECT username FROM jos_users_detail WHERE username = '".$user1."'";
$db->setQuery($query);
$result = $db->query();
$num = $db->getNumRows();
if($num>0){
    echo "true";
}else{
    echo "false";
}
?>
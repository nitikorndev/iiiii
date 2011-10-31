<?php
//createPackage.php
require 'lib/func.joomlaajax.php';
defined('_JEXEC') or die('Restricted access');
jimport('joomla.environment.request');
?>
<?php

/////////////////Request Values/////////////////////////////////////////////////
$name = JRequest::getVar('name');
///////////////////Add XML DB//////////////////////////////////////////////////
$ac = & JFactory::getUser();
$us = $ac->get('username');
$url = "julius/user/$us/package.xml";
$status = false;
if(is_file($url)){
    $db = simplexml_load_file($url);    
    foreach($db->children() as $child){
        if($name==$child){
            $status = true;
        }
    }
    if($status){
       echo "true"; 
    }else{
        $xml = simplexml_load_file($url);
        $child = new SimpleXMLElement($xml->asXML());
        $child->addChild("package",$name);
        $child->asXML($url);
        
$url2 = "julius/user/$us/package/dic/$name.xml";
$str2 = "<?xml version=\"1.0\" encoding=\"utf-8\"?><dictionary><wordid></idword></dictionary>";
$cmd2 = "echo '".$str2."' > " . $url2;
exec($cmd2);

    }
}else{
     $cmd = "echo '<?xml version=\"1.0\" encoding=\"utf-8\"?><packages><package>$name</package></packages>' > " . $url;
     exec($cmd);
     
$url2 = "julius/user/$us/package/dic/$name.xml";
$str2 = "<?xml version=\"1.0\" encoding=\"utf-8\"?><dictionary><word></word></dictionary>";
$cmd2 = "echo '".$str2."' > " . $url2;
exec($cmd2);
}
//////////////////END///////////////////////////////////////////////////////////
?>

<?php
//uploadWave.php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.environment.request');
$ac = & JFactory::getUser();
$us = $ac->get('username');
?>
<?php
        $w = date("W");
        $url = "media/system/php/julius/user/$us/wav/$w";
        if(!is_dir($url)){
            mkdir($url);
        }
        $t = time();
        $m = round(rand(11, 99));
        $n = round(rand(11, 99));
        $name = $m."".$n.""."$t";
        echo $_FILES["file"]["tmp_name"];
        if(move_uploaded_file($_FILES["file"]["tmp_name"],"$url/$name.wav"))
        {

        }

?>

<?php
$data->apikey = $_REQUEST['apikey'];
$data->package = $_REQUEST['package'];
require 'lib/func.wordXML.php';
$us = "";
$conn = mysql_connect('localhost','root','asdf');
mysql_select_db('asr_web');
$query ="SELECT * FROM jos_users_detail WHERE id AND apikey = '".$data->apikey."'";
$result = mysql_query($query,$conn);
while ($list = mysql_fetch_array($result)){
 $us = $list['username'];
$id = $data->package;
$w = date("W");
$url = "julius/user/$us/wav/$w";
if (!is_dir($url)) {
    mkdir($url);
}
$t = time();
$name = ord($_FILES["wav_in"]["name"][0]).$t.$_FILES["wav_in"]["size"];
$wav = "$url/$name.wav";
if (move_uploaded_file($_FILES["wav_in"]["tmp_name"], $wav)) {
    $j = new Julius('julius');
    $j->isolated_config($us, $id, $wav);
    $url2 = $j->process($us, $id);
    $j->filter($url2, $id, $us);
}
}
mysql_close($conn);
class Julius {

    var $at;
    public function __construct($at) {
        $this->at = $at;
    }
 function isolated_config($account, $id, $wav) {
        $cmd = "echo $wav > $this->at/user/$account/$id.xml.scp";
        exec($cmd);
    }
    function process($account, $id) {
///////////////////RUN Julius///////////////////////////////////////////////////
        $cmd2 = "./$this->at/julius ";
        $cmd2 .= "-C $this->at/user/$account/$id.xml.config ";
        $cmd2 .= "< $this->at/user/$account/$id.xml.scp > ";
        $cmd2 .= "$this->at/user/$account/$id.xml.out";
        exec($cmd2);
        return "$this->at/user/$account/$id.xml.out";
    }

    function filter($url, $id, $account) {
/////////////////////////////Filter Output//////////////////////////////////////
        $cmd = "cat " . $url . " | grep sentence";
        $str = exec($cmd);
        $str = substr($str, 12, (strlen($str)));
        $str = substr($str, 0, strlen($str) - 1);
        $url = "$this->at/user/$account/word.xml";
        $w = new word($url);
        $data = $w->get();
        foreach ($data as $v) {
            if (strip_tags($v[wordid]) == $str) {
                header ("Content-Type:text/xml"); 
                echo '<?xml version="1.0" encoding="utf-8"?>';
                $str = "<result>";
                $str .= '<recognize>'.strip_tags($v[output]).'</recognize>';
                $str .= '</result>';
                echo $str;
            }
        }
    }

}
?>


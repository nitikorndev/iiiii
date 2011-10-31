<?php
//word.php
class word {

/////////XML DB////////////////////////////////////////////////////////////////
    var $db;
    var $url;

///////////Load XML/////////////////////////////////////////////////////////////
    function __construct($url) {
        $this->url = $url;
        if (!is_file($url)) {
            $cmd = "echo '<?xml version=\"1.0\" encoding=\"utf-8\"?><words></words>' > " . $url;
            exec($cmd);
        }
    }

//////////Get Arrar From XML////////////////////////////////////////////////////
    function get() {
        $this->db = simplexml_load_file($this->url);
        $data = array();
        $buff = array();
        $i = 0;
        foreach ($this->db->children() as $child) {
            foreach ($child->children() as $var) {
                $buff[$var->getName()] = $var->asXML();
            }
            $data[$i] = $buff;
            $i++;
        }
        return $data;
    }

///////////Add Word to XML//////////////////////////////////////////////////////
    function add($data) {
        $this->db = simplexml_load_file($this->url);
        $child = new SimpleXMLElement($this->db->asXML());

        for ($i = 0;$i<count($child->word);$i++){
            if($child->word[$i]->id==$data['id']){
                return false;
            }
        }
        $child->addChild("word");
        $len = count($child->word)-1;
        $node = $child->word[$len];
        foreach ($data as $key => $var) {
            $node->addChild($key, $var);
        }
        $child->asXML($this->url);
        return true;
    }

}

///////////////////END//////////////////////////////////////////////////////////
?>

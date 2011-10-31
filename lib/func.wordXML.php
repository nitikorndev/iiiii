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
//////////Update From XML////////////////////////////////////////////////////
    function update($data) {
        $this->db = simplexml_load_file($this->url);
        $child = new SimpleXMLElement($this->db->asXML());
        for ($i = 0;$i<count($child->word);$i++){
            if($child->word[$i]->wordid==$data['wordid']){
                $child->word[$i]->text = $data['text'];
                $child->word[$i]->pronun = $data['pronun'];
                $child->word[$i]->output = $data['output'];
            }
        }
        $child->asXML($this->url);
        return true;
    }
 //////////remove From XML////////////////////////////////////////////////////
    function remove($id) {
        $this->db = simplexml_load_file($this->url);
        $child = new SimpleXMLElement($this->db->asXML());
        for ($i = 0;$i<count($child->word);$i++){
            if($child->word[$i]->wordid==$id){
                unset($child->word[$i]);
            }
        }
        $child->asXML($this->url);
        return true;
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
            if($child->word[$i]->wordid==$data['wordid']){
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

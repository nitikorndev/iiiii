<?php
class createDictionary {

/////////XML DB////////////////////////////////////////////////////////////////
    var $db;
    var $db2;
    var $url;

///////////Load XML/////////////////////////////////////////////////////////////
    function __construct($url) {
        $this->url = $url;
        if (is_file($url)) {
            $ac = & JFactory::getUser();
            $us = $ac->get('username');
            $this->db = simplexml_load_file($url);
            $this->db2 = simplexml_load_file("julius/user/$us/word.xml");
        }
    }
    function create() {
        $str = "";
        foreach ($this->db->children() as $child) {
            foreach ($this->db2->children() as $child2) {

                if($child2->wordid->asXML()==$child->asXML()){
                          $str .= ($child."    [(".$child.")]    ".$child2->pronun."\n");  
                  continue;
                }
            }
        }
     $str .= ("!ENTER    [!ENTER]    sil\n!EXIT    [!EXIT]    sil\n");    
     $cmd = "echo '".$str."' > " . $this->url.".dict";
     exec($cmd);
  
    }

}
/////////////////END////////////////////////////////////////////////////////
?>

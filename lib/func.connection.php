<?php
defined('_JEXEC') or die('Restricted access');
class connection {

    function &getDB() {
        $db = null;

        if (!$db) {
            $db = & JFactory::getDBO();
        }
        return $db;
    }

}
?>
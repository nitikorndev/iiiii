<?php
//checkAll.php
class checkAll {
//////////////VARIABLE///////////////////////////////////////////////////////
    var $err;

    function start($list) {
        $i = 0;
        foreach ($list as $key => $data) {
            $this->err[$i] = ($this->_Name($data) ? true : false);
            $this->err[$i+1] = ($this->_Null($data) ? true : false);
            $i++;
        }
    }
///////////////GET RESULT///////////////////////////////////////////////////
    function status() {
        foreach ($this->err as $key => $var) {
            if ($var) {
                return false;
            }
        }
        return true;
    }
////////////////CHECK//////////////////////////////////////////////////////
    function _Name($str) {
        $test = "abcdefghijklmnopqrstuvwxvzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_@.";
        for ($i=0;$i<strlen($str);$i++){
        $count = 0;
        for ($j=0;$j<strlen($test);$j++) {
            if($str[$i]==$test[$j]){
                $count = 1;
            }
        }
        if($count==0){
            return true;
        }        
        }
        return false;
    }

    function _Null($str) {
        return (strlen($str) < 1 ? true : false);
    }

}
///////////////////////////END/////////////////////////////////////////////////
?>

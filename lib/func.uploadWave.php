<?php

$u = new upload;
$account = 'admin';
$u->folder($account);
class upload {
    function folder($account){
        $name = date("W");
        if(!is_dir("/julius/user/$account/wav/$name")){
            mkdir("/julius/user/$account/wav/$name");
        }

    }
}

?>

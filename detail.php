<style type="text/css">
    @import url("media/system/css/css1.css");
</style>
<style type="text/css">
    #box{ display:none;}
    div#box{  width:600px; border-radius:10px; border: 10px; border-style:solid; border-color:#dedede;}
    span.t3{ font-size: 10pt; font-weight:bold;}
    span.t4{ font-size: 10pt;}
</style>
<script type="text/javascript">
    function object2String(data){
        var value = "";
        for(var i in data){
            value += (i+"="+data[i]+"&");
        }
        var len = value.length;
        value = value.substr(0, len-1);
        return value;
    }
    var state = false;
    var state2 = false;
    jQuery(document).ready(function(){
        jQuery('#edit').click(function(){
            jQuery('#close').toggle("fast");
            jQuery('span.textedit').toggle("fast");
            jQuery('span.formedit').toggle("fast");
            
            if(state2){
                state2 = false;
                if(confirm('กรุณายืนยันอีกครั้ง')==false){
                    {
                        return false;
                    }
                }
                var data = new Object;
                data.id = jQuery('#id').val();
                data.fname = jQuery('#fname').val();
                data.lname = jQuery('#lname').val();
                data.mail = jQuery('#mail').val();
            
                var str = object2String(data);
                jQuery.ajax( {
                    type : 'post',
                    url : 'media/system/php/account/updatedetail.php',
                    data : str,
                    success : function(msg) {
                    }
                });	
            }else{
                state2 = true;
            }
            
        });
        jQuery('#close').click(function(){
            jQuery('#close').toggle("fast");
            jQuery('span.textedit').toggle("fast");
            jQuery('span.formedit').toggle("fast");
        });
        jQuery('#close2').click(function(){
            jQuery('#close2').toggle("fast");
            jQuery('span.textedit2').toggle("fast");
            jQuery('span.formedit2').toggle("fast");
        });
        jQuery('#edit2').click(function(){
            jQuery('#close2').toggle("fast");
            jQuery('span.textedit2').toggle("fast");
            jQuery('span.formedit2').toggle("fast");
            if(jQuery('#tep').is(':hidden')){
                
                if(confirm('กรุณายืนยันอีกครั้ง')==false){
                    {
                        return false;
                    }
                }

                var data = new Object;
                data.id = jQuery('#id').val();
                data.password = jQuery('#password').val();

                var str = object2String(data);
                jQuery.ajax( {
                    type : 'post',
                    url : 'media/system/php/account/updatedetail2.php',
                    data : str,
                    success : function(msg) {
                    }
                });	
            }
        });
    });
</script>
<p class="t">ข้อมูลส่วนบุคคล</p><br>
<div>
    <table width="500px"><tr><td>
                <?php
                defined('_JEXEC') or die('Restricted access');
                require 'lib/func.connection.php';
                $ac = & JFactory::getUser();
                $us = $ac->get('username');
                $connect = new connection;
                $db = $connect->getDB();

                $query = "SELECT * FROM jos_users_detail WHERE username = '" . $us . "'";
                $db->setQuery($query);
                $result = $db->loadAssocList();
                foreach ($result as $var) {
                    ?>
            <tr>
                <td width="150px" height="40px"><span class="t3">ยูสเซอร์เนม </span></td>
                <td><span class="t4"><?php echo $var[username]; ?><input type="hidden" id="id" value="<?php echo $var[id]; ?>"></span></td>
            </tr>
            <tr>
                <td width="150px" height="40px"><span class="t3">รหัสผ่าน </span></td>
                <td><span id="tep" class="t4 textedit2"><?php echo '********'; ?> &nbsp; &nbsp;</span><span id="sid" class="formedit2" style=" display:none;"><input class="input_u2" type="password" id="password" size="20px"></span><input type="button" class="button" id="edit2" value="แก้ไข"><input type="button" class="button" id="close2" value="ยกเลิก" style=" display:none;"></td>
            </tr>
            <tr>
                <td width="150px" height="40px"><span class="t3">ชื่อ-สกุล </span></td>
                <td><span class="t4 textedit"><?php echo $var[fname] . " " . $var[lname]; ?></span><span class="formedit" style=" display:none;"><input class="input_u2" type="text" id="fname" size="20px" value="<?php echo $var[fname]; ?>"><input class="input_u2" type="text" id="lname" size="20px" value="<?php echo $var[lname]; ?>"></span></td>
            </tr>
            <tr>
                <td width="150px" height="40px"><span class="t3">อีเมลล์ </span></td>
                <td><span class="t4 textedit"><?php echo $var[mail]; ?></span><span class="formedit" style=" display:none;"><input class="input_u2" type="text" id="mail" size="30px" value="<?php echo $var[mail]; ?>"></span></td>
            </tr>
            <tr>
                <td width="150px" height="40px"><span class="t3">API-Key </span></td>
                <td><span class="t4"><?php echo $var[apikey]; ?></span></td>
            </tr>
            <tr>
                <td width="150px" height="40px"><span class="t3">วันหมดอายุ: </span></td>
                <td><?php echo $var[expire]; ?></td>
            </tr>
            <tr>
                <td width="150px" height="50px"></td>
                <td><input type="button" class="button" id="edit" value="แก้ไข">
                    <input type="button" class="button" id="close" value="ยกเลิก"  style=" display:none;">
                </td>
            </tr>
            <?php
        }
        ?>
        </td></tr></table>
</div>
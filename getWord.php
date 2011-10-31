<style type="text/css">
    div.edit{
        position:absolute;
        width: 150px;
        top: 0px;
        left: 0px;
        display:none;
        background-color:lightcyan;
        border-radius:10px;
        opacity:0.8;

    }
    a.head{
        font-weight:bold;
        font-size: 10pt;
    }
    input.fedit{
        border: 0px;
    }
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
    var last;
    jQuery(document).ready(function(){
      
        jQuery('tr.tab').click(function(){
            var id = jQuery(this).attr('name');
            var position = jQuery(this).position();
            
            if(id!=last)
                jQuery('div.edit').hide();
            
            jQuery('div #edit'+id).css('top',position.top-20).css('left',position.left-150).toggle("slow");
            last = id;
        });
        jQuery('div.edit input[type=button]').click(function(){
            var id = jQuery(this).attr('name');
            var buff = new Array;
            var input = new Object;
            var i = 0;
            var err = '';
            var status = true;
            jQuery('#edit'+id).find('input').each(function(){
                buff[i] = jQuery(this).val();
                i++;
            });
            input.wordid = id;
            input.text = buff[0];
            input.pronun = buff[1];
            input.output = buff[2];

            if(CheckNull(input.wordid) || CheckNull(input.text) || CheckNull(input.pronun) ||CheckNull(input.output)){
                err += " ข้อมูลไม่ครบ";
                status = false;
            }
            if(status){
                var str = object2String(input);
                jQuery.ajax( {
                    type: "POST",
                    url: "media/system/php/updateWord.php",
                    data: str,
                    cache : false,
                    success : function(msg) {
                        if(msg=='1'){
                            reWord();
                            jQuery('#edit'+id).css('background-color','write');
                        }else{
                            jQuery('#edit'+id).css('background-color','red');
                        }
                    }
                });
            }else{
                jQuery(this).css('background-color','red');
            }
        });
        jQuery('img.del').click(function(){
            if(confirm('กรุณายืนยันอีกครั้ง')==false)
            {
                return false;
            }
            var id = jQuery(this).attr('id');
            var input = new Object;
            input.wordid = id;
            var str = object2String(input);
            jQuery.ajax( {
                type: "POST",
                url: "media/system/php/removeWord.php",
                data: str,
                cache : false,
                success : function(msg) {
                    if(msg=='1'){
                        reWord();
                        jQuery('#edit'+id).css('background-color','write');
                                        
                    }else{
                        jQuery('#edit'+id).css('background-color','red');
                    }
                }
            });
        });       
    });
</script>
<?php
require 'lib/func.joomlaajax.php';
require 'lib/func.wordXML.php';
defined('_JEXEC') or die('Restricted access');
$ac = & JFactory::getUser();
$us = $ac->username;
$url = "julius/user/$us/word.xml";
$w = new word($url);
$data = $w->get();
echo "<table width='100%' cellpadding='0' cellspacing='0' border='0'><tr>
    <td><a class='head'>รหัสคำ</a></td>
    <td><a class='head'>คำศัพท์</a></td>
    <td><a class='head'>สัญลักษณ์หน่วยเสียง</a></td>
    <td><a class='head'>ผลลัพท์</a></td>
    <td><a class='head'>ลบ</a></td></tr>";
foreach ($data as $list) {
    echo "<tr class='tab' name='" . strip_tags($list['wordid']) . "'>
    <td>&nbsp;" . strip_tags($list['wordid']) . "</td>
        <td>" . strip_tags($list['text']) . "</td>
            <td>" . strip_tags($list['pronun']) . "</td>
                <td>" . strip_tags($list['output']) . "</td>
                    <td><img class='del' id='" . strip_tags($list['wordid']) . "' src='media/system/images/delete.gif'></td></tr>";
}
echo "</table>";
foreach ($data as $list) {
    ?>

    <div class="edit" id="edit<?php echo strip_tags($list['wordid']); ?>">
        <table width="150px">
            <tr><td><center><a class='head'>รหัสคำ&nbsp;[<?php echo strip_tags($list['wordid']); ?>]</a><br><br><a class='head'>คำศัพท์</a></td></tr>
                <tr><td><input class="fedit" type="text" id="text" value="<?php echo strip_tags($list['text']); ?>"></td></tr>
                <tr><td><center><a class='head'>สัญลักษณ์หน่วยเสียง</a></td></tr>
                    <tr><td><input class="fedit" type="text" id="pronun" value="<?php echo strip_tags($list['pronun']); ?>"></td></tr>
                    <tr><td><center><a class='head'>ผลลัพท์</a></td></tr>
                        <tr><td><input class="fedit" type="text" id="output" value="<?php echo strip_tags($list['output']); ?>"></td></tr>
                        <tr><td><center><input class="button" type="button" id="subedit" name="<?php echo strip_tags($list['wordid']); ?>" value="แก้ไข"></td></tr>
                        </table>
                        </div>
                        <?
                    }?>
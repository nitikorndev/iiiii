<?php
//formDictionary.php
defined('_JEXEC') or die('Restricted access');
require_once 'lib/func.wordXML.php';
/////////////////////IMPORT CSS////////////////////////////////////////////////////////
?>
<style type="text/css">
    @import url("media/system/css/css1.css");
</style>
<script type="text/javascript" src="media/system/js/run.js"></script>
<script type="text/javascript" src="media/system/js/checkAll.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#add").click(function () {
            var status = true;
            var err = "";
            var input = new Object;
            input.name = jQuery.trim(jQuery("#nameDic").val());
            input.detail = jQuery.trim(jQuery("#deteilDic").val());
            input.dic = jQuery("##dictionaryList2 option").val();
            if(CheckNull(input.name) || CheckNull(input.detail) ||(input.dic.length<1)){
                err += " ข้อมูลไม่ครบ";
                status = false;
            }else{
                if(CheckName(input.name)){
                    err += " ข้อมูลไม่ถูกต้อง";
                    status = false;
                }
            }

            if(status){
                if(confirm('กรุณายืนยันอีกครั้ง')==false)
                {
                    return false;
                }
     		var POST = "POST";
                var URL = "media/system/php/addDictionary.php";
                var DATA = input;
                var YES = 'สร้าง Dictionary สำเร็จ';
                var NO = 'สร้าง Dictionary ไม่สำเร็จ';
                var SHOW = "status";
                RUN(POST,URL,DATA,YES,NO,SHOW);      
            }else{
                jQuery("#status").hide("fast");
                jQuery("#status").html('<center><span class="mess">'+err+'</span>');
                jQuery("#status").show("slow");
            }
        });
        jQuery("#left").click(function () {
            
            jQuery('#dictionaryList option:selected').each(function(){
                var id = jQuery(this).val();
                var text = jQuery(this).text();
                if(id==null){
                    return false;
                }
                jQuery("#dictionaryList2").append('<option value="'+id+'">'+text+'</option>');
                jQuery(this).remove();
            });

        });
        jQuery("#leftall").click(function () {
            
            jQuery('#dictionaryList option').each(function(){
                var id = jQuery(this).val();
                var text = jQuery(this).text();
                if(id==null){
                    return false;
                }
                jQuery("#dictionaryList2").append('<option value="'+id+'">'+text+'</option>');
                jQuery(this).remove();
            });

        });
        jQuery("#rigth").click(function () {
            jQuery('#dictionaryList2 option:selected').each(function(){
                var id = jQuery(this).val();
                var text = jQuery(this).text();
                if(id==null){
                    return false;
                }
                jQuery("#dictionaryList").append('<option value="'+id+'">'+text+'</option>');
                jQuery(this).remove();
            });
        });   
        jQuery("#rigthall").click(function () {
            jQuery('#dictionaryList2 option').each(function(){
                var id = jQuery(this).val();
                var text = jQuery(this).text();
                if(id==null){
                    return false;
                }
                jQuery("#dictionaryList").append('<option value="'+id+'">'+text+'</option>');
                jQuery(this).remove();
            });
        });        
    });
</script>
<p class="t">จัดการ Dictionary</p>
<div id="allWord">
    <p class="t2">รายการ Dictionary</p>
        <div id="Diclist"></div>
</div>
<p class="t2">สร้าง Dictionary</p>
<div id="divDictionary">
    <table>
        <tr><td>ชื่อ Dictionary :</td><td colspan="3"><input type="text" class="input_u" id="nameDic" size="40px">* หมายเหตุ: รองรับเฉพาะอักษร A-Z,a-z,0-9 เท่านั้น</td></tr>
        <tr><td>คำอธิบาย</td><td colspan="3"><input type="text" class="input_u" id="deteilDic" size="40px">*</td></tr>
        <tr><td>คำภายใน Dictionary :</td><th><center>คำที่มีในคลังคำศัพท์</th><td></td><th><center>คำที่เลือก</th></tr>
                <tr>
                    <td></td>
                    <td>
                        <?php
                        $ac = & JFactory::getUser();
                        $us = $ac->username;
                        $url = "media/system/php/julius/user/$us/word.xml";
                        $w = new word($url);
                        $data = $w->get();
                        ?>
                        <select id="dictionaryList" size="20" style="width: 200px" multiple="multiple">
                            <?php
                            foreach ($data as $k => $list) {
                                ?>
                                <option value="<?php echo $k; ?>">
                                    <?php echo $list['wordid'] . " " . $list['text'] . " ( ผลลัพท์ : " . $list['output'] . " )"; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="button" class="button" id="left" value=" > "><br>
                        <input type="button" class="button" id="rigth" value=" < "><br>
                        <input type="button" class="button" id="leftall" value=">>"><br>
                        <input type="button" class="button" id="rigthall" value="<<"><br>
                    </td>
                    <td>                
                        <select id="dictionaryList2" size="20" style="width: 200px" multiple="multiple">
                        </select>
                    </td>
                </tr>
                <tr><td></td><td></td><td></td><td></td></tr>
                <tr><td><input type="button" class="button" id="add" value="สร้าง"></td><td></td><td></td><td></td></tr>
                </table>
                </div>
                <div id="status"></div>

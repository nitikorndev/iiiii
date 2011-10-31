<?php
//formWord.php
defined('_JEXEC') or die('Restricted access');
require_once 'lib/func.wordXML.php';
/////////////////////IMPORT CSS////////////////////////////////////////////////////////
?>
<style type="text/css">
    @import url("media/system/css/css1.css");
</style>
<style type="text/css">
    #box{ display:none;}
    div#box{  width:800px; border-radius:10px; border: 0px; border-style:solid; border-color:#dedede;}
    p.t3{font-size:12pt; font-weight:bold;}
    tr.tab{ background-color:#ffffff;}
    tr.tab:hover{ background-color:#eeeeee; cursor:pointer;}
</style>
<script type="text/javascript" src="media/system/js/run.js"></script>
<script type="text/javascript" src="media/system/js/run_1.js"></script>
<script type="text/javascript" src="media/system/js/checkAll.js"></script>
<script type="text/javascript">
        function reWord(){
                var input = new Object;
                input.id = "1";
     		var POST = "POST";
                var URL = "media/system/php/getWord.php";
                var DATA = input;
                var YES = 'อัพเดทสำเร็จ';
                var NO = 'อัพเดทไม่สำเร็จ';
                var SHOW = "status2";
                RUN2(POST,URL,DATA,YES,NO,SHOW);
    }
    function delay(){
        setTimeout("reWord();",2000);
    }
    jQuery(document).ready(function(){
        jQuery('#box').show("slow");
        delay();
        jQuery("#add").click(function () {
            var status = true;
            var err = "";
            var input = new Object;
            input.id = jQuery.trim(jQuery("#id").val());
            input.text = jQuery.trim(jQuery("#text").val());
            input.symbol = jQuery.trim(jQuery("#symbol").val());
            input.result = jQuery.trim(jQuery("#result").val());

            if(CheckNull(input.id) || CheckNull(input.text) || CheckNull(input.symbol) ||CheckNull(input.result)){
                err += " ข้อมูลไม่ครบ";
                status = false;
            }else{
                if(CheckName(input.id)||CheckName(input.text)){
                    err += " ข้อมูลไม่ถูกต้อง";
                    status = false;
                }
            }

            if(status){
//                if(confirm('กรุณายืนยันอีกครั้ง')==false)
//                {
//                    return false;
//                }
     		var POST = "POST";
                var URL = "media/system/php/addWord.php";
                var DATA = input;
                var YES = 'เพิ่มคำศัพท์สำเร็จ';
                var NO = 'รหัสคำศัพท์นี้มีแล้ว';
                var SHOW = "status";
                RUN(POST,URL,DATA,YES,NO,SHOW);
                delay();
       
            }else{
                jQuery("#status").hide("fast");
                jQuery("#status").html('<center><span class="mess">'+err+'</span>');
                jQuery("#status").show("slow");
            }
            return false;
        });
    });
</script>
<?php php
//////////////////////END JS////////////////////////////////////////////////////////
?>
<div id="box"><center>
<p class="t">คลังคำศัพท์</p><br>
<p class="t3">เพิ่มคำศัพท์</p>
<div id="divWord">
    <table width="700px">
        <tr>
            <td><label>รหัสคำศัพท์</label></td>
            <td><input type="text" class="input_u" name="id" id="id" size="15"> <span>*
                    หมายเหตุ: รองรับเฉพาะอักษร A-Z,a-z,0-9 เท่านั้น</span></td>
        </tr>
        <tr>
            <td><label>คำศัพท์</label></td>
            <td><input type="text" class="input_u" name="text" id="text" size="15">
                <span>*</span></td>
        </tr>
        <tr>
            <td><label>สัญลักษณ์หน่วยเสียง</label></td>
            <td><input type="text" class="input_u" name="symbol" id="symbol" size="15"> <span>*</span></td>
        </tr>
        <tr>
            <td><label>ผลลัพท์</label></td>
            <td><input type="text" class="input_u" name="result" id="result" size="15"> <span>*</span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" class="button" name="add" id="add" value="เพิ่ม"></td></tr>
    </table>
</div>
<div id="status"></div>
<div id="allWord">
    <p class="t3">รายการคำศัพท์</p>
        <div id="wordlist"></div>
</div>
<div id="status2">
</div></div>
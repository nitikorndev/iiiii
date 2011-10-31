<?php
//formDictionary.php
defined('_JEXEC') or die('Restricted access');
require_once 'lib/func.wordXML.php';
/////////////////////IMPORT CSS////////////////////////////////////////////////////////
?>
<style type="text/css">
    @import url("media/system/css/css1.css");
</style>
<style type="text/css">
    div#load{ background:lightsteelblue; width:150px; height:10px; border-radius:30px;}
    div#bar{ border: 5px; border-style:solid; border-color:#999; width:600px; height:10px;  border-radius:30px;}
   div#step{  width:600px; border-radius:10px; border: 0px; border-style:solid; border-color:#dedede;}
   div#step2{ display:none;}
   div#step3{ display:none;}
   div#step4{ display:none;}
   #dictionaryList{ background:#fffafa; font-size: 10pt; border: 1px; border-color:#dedede; border-style:solid;}
   #dictionaryList2{ background:#fffafa; font-size: 10pt; border: 1px; border-color:#dedede; border-style:solid;}
</style>
<script type="text/javascript" src="media/system/js/checkAll.js"></script>
<script type="text/javascript" src="media/system/js/wizardIsoStep.js"></script>
<script type="text/javascript" src="media/system/js/run.js"></script>
<script type="text/javascript" src="media/system/js/checkAll.js"></script>
<script type="text/javascript" src="media/system/js/wizardDictionary.js"></script>
<p class="t">Wizard : Isolated word</p><br>
<table width="600px"><tr><td><center>Package</td><td><center>Dictionary</td><td><center>Language Model</td><td><center>Complete</td></tr></table>
                    <div id="bar"><div id="load">
                        </div></div>
                    <div id="step">
                        <div id="step2">
                            <table>
                                <tr><td><p class="t2">คำภายใน Dictionary :</p></td><th><center>คำที่มีในคลังคำศัพท์</th><td></td><th><center>คำที่เลือก</th></tr>
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
                                                <input type="hidden" name="ac" id="ac" value="<?php echo $us; ?>" />
                                                <select class="t2" id="dictionaryList" size="20" multiple="multiple">
                                                </select>
                                            </td>
                                            <td align="center">
                                                <input type="button" class="button" id="left" value=" > "><br>
                                                <input type="button" class="button" id="rigth" value=" < "><br>
                                                <input type="button" class="button" id="leftall" value=">>"><br>
                                                <input type="button" class="button" id="rigthall" value="<<"><br>
                                            </td>
                                            <td>                
                                                <select id="dictionaryList2" size="20" multiple="multiple">
                                                </select>
                                            </td>
                                        </tr>
                                        <tr><td></td><td>กดต่อไปเพื่อสร้าง Dictionanry</td><td></td><td></td></tr>
                                        <tr><td></td><td></td><td></td><td></td></tr>
                                        </table>
                                        <div id="bt2"><center><input type="button" value="ต่อไป" id="next" class="button"></div>
                                                </div>
                                                <div id="step3">
                                                    <center><p class="t2">กดปุ่ม "ต่อไป" เพื่อสร้าง Language Model</p>
                                                        <div id="bt3"><center><input type="button" value="ต่อไป" class="button" id="next"></div>
                                                                </div>
                                                                <div id="step1">
                                                                    <br><br>
                                                                    <table width="600px"><tr>
                                                                        <tr class="bgcheck"><td align="right" width="200px"><p class="t1"><input type="radio" name="check" id="check" value="select">แก้ไข Package</p></td>
                                                                            <td align="left"><select id="selectPackage" style="width:200px;">
                                                                                    <?php
                                                                                    $ac = & JFactory::getUser();
                                                                                    $us = $ac->get('username');
                                                                                    $url = "media/system/php/julius/user/$us/package.xml";
                                                                                    if (is_file($url)) {
                                                                                        $db = simplexml_load_file($url);

                                                                                        foreach ($db->children() as $child) {
                                                                                            ?>
                                                                                            <option value="<?php echo $child; ?>"><?php echo $child; ?></option>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </td>
                                                                        </tr> <tr class="bgcheck2">
                                                                            <td align="right" width="200px"><p class="t2"><input type="radio" name="check" id="check" value="create" checked="checked">สร้าง Package</p></td>
                                                                            <td align="left">
                                                                                <input type="text" size="30" class="input_u" id="namePackage">
                                                                            </td></tr></table>
                                                                    <div id="bt">
                                                                        <center><input type="button" value="ต่อไป" id="next" class="button"></div>
                                                                            <br><div id="status"></div>            
                                                                    </div>
                                                                    <div id="step4">
                                                                        <center><p class="t" id="end">สร้าง Package Isolate word เรียบร้อย</p>
                                                                            <div id="bt4"><center></div>
                                                                    </div>    
                                                                </div>


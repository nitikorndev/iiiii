<style type="text/css">
    @import url("media/system/css/css1.css");
</style>
<style type="text/css">
    tr.tab{ background-color:#ffffff;}
    tr.tab:hover{ background-color:#eeeeee; cursor:pointer; }
    table{ padding:0px; margin:0px; border:0px; border-style:solid; border-color:#dddddd; border-spacing:0px;}
    #status{
        position:absolute;
        display:none;
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
    jQuery(document).ready(function(){
       
        jQuery('img.add').click(function(){
            var id = jQuery(this).attr('name');
            var day;
            var add;
            var target;
            jQuery('#tr'+id).find('span').each(function(){
                target = jQuery(this);
                day = new Date(jQuery(this).text()+' 00:00:00.000');
            });
            jQuery('#tr'+id).find('select:last').each(function(){
                add = jQuery(this).val()*60*60*24*1000;
            }); 
        
            var date = new Date(((day.getTime())+(add)));
            var year = date.getFullYear();
            var month = date.getMonth()+1;
            var date = date.getDate();

            var formattedTime = year + '-' + month + '-' + date;
            target.text(formattedTime);       
        });
        jQuery('img.save').click(function(){
             if(confirm('กรุณายืนยันอีกครั้ง')==false)
                {
                    return false;
                }
            var at = jQuery(this);
            var id = jQuery(this).attr('name');
            var val1;
            var val2;
            jQuery('#tr'+id).find('select:first').each(function(){
                val1 = jQuery(this).val();             
            });
            jQuery('#tr'+id).find('span').each(function(){
                val2 = jQuery(this).text();
            });
            
            var data = new Object;
            data.id = id;
            data.type = val1;
            data.expire = val2;
            
            var str = object2String(data);
            jQuery.ajax( {
                type: "POST",
                url: "media/system/php/account/updateMember.php",
                data: str,
                cache : false,
                success : function(msg) {
                    var position = at.position();
                    if(msg=='true'){
                        jQuery('#mesg').text("แก้ไขสำเร็จ");
                        jQuery('#status').css('top',position.top).css('left',position.left+50).fadeIn("slow").delay(2000).fadeOut('slow');
                    }else{
                        jQuery('#mesg').text("แก้ไขล้มเหลว");
                        jQuery('#status').css('top',position.top).css('left',position.left+50).fadeIn("slow").delay(2000).fadeOut('slow');
                    }
                }
            });
        });
        
        jQuery('img.export').click(function(){
             if(confirm('กรุณายืนยันอีกครั้ง')==false)
                {
                    return false;
                }
            var at = jQuery(this);
            var id = jQuery(this).attr('name');
            var val1;
            jQuery('#tr'+id).find('input:first').each(function(){
                val1 = jQuery(this).val();             
            });
                jQuery.ajax({
                type: "POST",
                url: "media/system/php/julius/user/export.php",
                data: 'username='+val1,
                cache : false,
                success : function(msg) {
                    var position = at.position();
                    if(msg=='true'){
                        jQuery('#mesg').text('ส่งออกสำเร็จ');
                        jQuery('#status').css('top',position.top).css('left',position.left+70).fadeIn("slow").delay(2000).fadeOut('slow');
                        window.location = "media/system/php/julius/user/"+val1+'.tar.tbz';
                    }else{
                        jQuery('#mesg').text("ส่งออกล้มเหลว");
                        jQuery('#status').css('top',position.top).css('left',position.left+70).fadeIn("slow").delay(2000).fadeOut('slow');
                    }
                }
            });
      });
    });
</script>
<p class="t">จัดการผู้ใช้งาน</p>
<?php
require 'lib/func.joomlaajax.php';
require 'lib/func.connection.php';
defined('_JEXEC') or die('Restricted access');
$connect = new connection;
$db = $connect->getDB();
$query = "SELECT * FROM jos_users_detail";
$db->setQuery($query);
$result = $db->loadAssocList();
?>
<div>
    <table width="800px">
        <tr>
            <td>
        <center><a class="t2">ผู้ใช้งาน</a>
            </td>

            <td>
            <center><a class="t2">ประเภท</a>
                </td>
                <td>
                </td>
                <td>
                <center><a class="t2">วันหมดอายุ</a>
                    </td>
                    <td>
                    </td>
                    <td><center>
                        </td>
                        <td><center><a class="t2">ระงับการใช้งาน</a>
                            </td>
                            <td><center><a class="t2">นำเข้าข้อมูล</a>
                                </td>
                                <td><center><a class="t2">ส่งออกข้อมูล</a>
                                    </td>
                                    </tr>
                                    <?php
                                    foreach ($result as $var) {
                                        if ($var[username] == 'test') {
                                            continue;
                                        }
                                        ?>
                                        <tr class="tab" id="tr<?php echo $var[id]; ?>">
                                            <td>
                                                <input type="hidden" name="userr" value="<?php echo $var[username]; ?>">
                                                <?php echo '[' . $var[id] . ']' . ' ' . $var[fname] . ' ' . $var[lname]; ?>
                                            </td>
                                            <td>
                                                <?php echo $var[level]; ?>
                                            </td>
                                            <td>

                                                <select name="level" id="level">
                                                    <?php
                                                    switch ($var[level]) {

                                                        case 'Member': echo '<option value="Member" SELECTED>Member</option>
                    <option value="Super Member">Super Member</option>
                    <option value="Administrator">Administrator</option>';
                                                            break;
                                                        case 'Super Member': echo '<option value="Member">Member</option>
                    <option value="Super Member" SELECTED>Super Member</option>
                    <option value="Administrator">Administrator</option>';
                                                            break;
                                                        case 'Administrator': echo '<option value="Member">Member</option>
                    <option value="Super Member">Super Member</option>
                    <option value="Administrator" SELECTED>Administrator</option>';
                                                            break;
                                                            ?>  


                                                    <?php } ?>   
                                                </select>

                                            </td>
                                            <td>
                                                <span><?php echo $var[expire]; ?></span>
                                            </td>
                                            <td>
                                                <select id="day<?php echo $var[id]; ?>">
                                                    <option value="1">1 วัน</option>
                                                    <option value="15">15 วัน</option>
                                                    <option value="30">30 วัน</option>
                                                    <option value="60">60 วัน</option>
                                                    <option value="90">90 วัน</option>
                                                    <option value="180">180 วัน</option>
                                                    <option value="360">360 วัน</option>
                                                </select>
                                            </td>
                                            <td><center>
                                            <img class="add" name="<?php echo $var[id]; ?>" src="media/system/images/add.png">
                                            </td>
                                            <td><center>
                                                <img src="media/system/images/lock.png">
                                                </td>
                                                <td><center>
                                                    <img src="media/system/images/import.gif">
                                                    </td>
                                                    <td><center>
                                                        <img class="export" name="<?php echo $var[id]; ?>" src="media/system/images/export.png">
                                                        </td>
                                                        <td><center>
                                                            <img class="save" name="<?php echo $var[id]; ?>" src="media/system/images/save.png">
                                                            </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        </table>    
                                                        </div>
<form action="media/system/php/julius/user/import.php" method="POST" enctype="multipart/form-data">
<input name="username" type="text" value="test2"/>  
<input type="file" name="file_upload"/>
<input type="submit" id="up2" value="import">
</form>           
                                                        <div id="status">
                                                            <span class="mess" id="mesg"></span>
                                                        </div>
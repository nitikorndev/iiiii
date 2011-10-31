
<style type="text/css">
    @import url("media/system/css/css1.css");
</style>
<style type="text/css">
    #box{ display:none;}
    div#box{  width:600px; border-radius:10px; border: 0px; border-style:solid; border-color:#dedede;}

</style>

<script type="text/javascript" src="media/system/js/ajaxfileupload.js"></script>
<script type="text/javascript">
</script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        
        jQuery('#box').show("slow");
         jQuery('#up').click(function(){
             var pk = jQuery('#selectPackage').val();
             var file = jQuery('#fileid').val();
             if(pk==null || file==""){
                jQuery("#status").hide("fast");
                jQuery("#status").html('<center><span class="mess">กรุณากรอกข้อมูลให้ครบ</span>');
                jQuery("#status").show("slow");
                 return false;
             }
         });
    });
</script>
<div id="box">
    <center><p class="t">ทดสอบ Recognition</p><br>
    
        <center> <form action="index.php?option=com_jumi&fileid=16" method="POST" enctype="multipart/form-data"><table width="500px">
           
            <tr><td></td><td> Package : <select name="selectPackage" id="selectPackage" style="width:200px;">
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
                    </select></td></tr>
            <tr><td></td><td>ไฟล์เสียง : <input type="file" name="file" id="fileid" />
                    </td></tr>
        </table>
            <input class="button" type="submit" id="up" value="ประมวลผล"></form>
            <br><br>
    
<div id="status"></div><br>
</div>
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
        jQuery("#dictionaryList").dblclick(function () {
            var id = jQuery('#dictionaryList option:selected').val();
            var text = jQuery('#dictionaryList option:selected').text();
            jQuery("#dictionaryList2").append('<option value="'+id+'">'+text+'</option>');
            jQuery('#dictionaryList option:selected').remove();
        });
        jQuery("#dictionaryList2").dblclick(function () {
            var id = jQuery('#dictionaryList2 option:selected').val();
            var text = jQuery('#dictionaryList2 option:selected').text();
            jQuery("#dictionaryList").append('<option value="'+id+'">'+text+'</option>');
            jQuery('#dictionaryList2 option:selected').remove();
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
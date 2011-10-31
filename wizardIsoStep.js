    jQuery(document).ready(function(){
        jQuery('#step1').hide("fast");
        jQuery('#step1').fadeIn("slow");
        var bt = new Object;
        bt.step1 = jQuery('#step1');
        bt.step2 = jQuery('#step2');
        bt.step3 = jQuery('#step3');
        bt.step4 = jQuery('#step4');

        jQuery('#bt #next').click(function(){
            var ac = jQuery.trim(jQuery("#ac").val());
            var pk = jQuery.trim(jQuery("#selectPackage").val());
            if(jQuery("#check:checked").val()=="create"){
                pk = jQuery.trim(jQuery("#namePackage").val());
                if(pk==""){
                    jQuery("#status").hide("fast");
                    jQuery("#status").html('<center><span class="mess">กรุณาตั้งชื่อ Package</span>');
                    jQuery("#status").show("slow");
                    return false;
                }
                if(CheckName(pk)){
                    jQuery("#status").hide("fast");
                    jQuery("#status").html('<center><span class="mess">ชื่อ Package ไม่ถูกต้อง</span>');
                    jQuery("#status").show("slow");
                    return false;
                }
                jQuery.ajax( {
                    type : 'POST',
                    url : 'media/system/php/createPackage.php',
                    cache : false,
                    data : 'name='+pk,
                    success : function(msg) {
                        if (msg.toString().indexOf("true") >= 0) {
                            jQuery("#status").hide("fast");
                            jQuery("#status").html('<center><span class="mess">Package นี้มีแล้ว</span>');
                            jQuery("#status").show("slow");
                
                        }else{
                            jQuery.ajax( {
                                type: "GET",
                                url: "media/system/php/julius/user/"+ac+"/word.xml",
                                cache : false,
                                dataType: "xml",
                                success : function(msg) {
                                    jQuery(msg).find('word').each(function(){
                                        jQuery("#dictionaryList").append('<option value="'+jQuery(this).find('wordid').text()+'">'+jQuery(this).find('wordid').text()+" "+jQuery(this).find('text').text()+"( ผลลัพท์ : "+jQuery(this).find('output').text()+")"+'</option>');
                                    });
                                }
                            });
                        }
                    }
                }); 

                }else{                
                
            var j = 0;
            var listword = new Array();
            jQuery.ajax({
                type: "GET",
                url: "media/system/php/julius/user/"+ac+"/package/dic/"+pk+".xml",
                cache : false,
                dataType: "xml",
                success : function(msg) {
                    jQuery(msg).find('wordid').each(function(){
                        listword[j] = jQuery(this).text();
                        j++;
                    });
                    jQuery.ajax( {
                        type: "GET",
                        url: "media/system/php/julius/user/"+ac+"/word.xml",
                        cache : false,
                        dataType: "xml",
                        success : function(msg) {
                            jQuery(msg).find('word').each(function(){
                                for(var i in listword){
                                    if(listword[i]==jQuery(this).find('wordid').text()){
                                        jQuery("#dictionaryList2").append('<option value="'+jQuery(this).find('wordid').text()+'">'+jQuery(this).find('wordid').text()+" "+jQuery(this).find('text').text()+"( ผลลัพท์ : "+jQuery(this).find('output').text()+")"+'</option>');
                                    }
                                }
                            });
                            jQuery.ajax( {
                                type: "GET",
                                url: "media/system/php/julius/user/"+ac+"/word.xml",
                                cache : false,
                                dataType: "xml",
                                success : function(msg) {
                                    jQuery(msg).find('word').each(function(){
                                        var ok = true;
                                        for(var i in listword){
                                            if(listword[i]==jQuery(this).find('wordid').text()){
                                                ok = false;
                                            }
                                        }
                                        
                                        if(ok){
                                            jQuery("#dictionaryList").append('<option value="'+jQuery(this).find('wordid').text()+'">'+jQuery(this).find('wordid').text()+" "+jQuery(this).find('text').text()+"( ผลลัพท์ : "+jQuery(this).find('output').text()+")"+'</option>');
                                        }
                                     });
                                }
                            });
                        }
                    }); 
                }
            });    
           }
                                                bt.step1.hide("fast");
                                                bt.step2.fadeIn("slow");
                                                jQuery('div #load').width("300px"); 
        });
 
        jQuery('#bt2 #next').click(function(){
            var pk = jQuery.trim(jQuery("#selectPackage").val());
            if(jQuery("#check:checked").val()=="create"){
                pk = jQuery.trim(jQuery("#namePackage").val());
            }
            var str = "";
            jQuery("#dictionaryList2 option").each(function()
            {
                str += (jQuery(this).val()+" ");
            });
            str = jQuery.trim(str);
            jQuery.ajax( {
                type: "GET",
                url: "media/system/php/addDictionaryXML.php",
                data: "data="+str+"&pk="+pk,
                cache : false,
                success : function(msg) {

                }
            });

                                                bt.step2.hide("fast");
                                                bt.step3.fadeIn("slow")
            jQuery('div #load').width("450px");
        });
        jQuery('#bt3 #next').click(function(){
            var ac = jQuery.trim(jQuery("#ac").val());
            var pk = jQuery.trim(jQuery("#selectPackage").val());
            if(jQuery("#check:checked").val()=="create"){
                pk = jQuery.trim(jQuery("#namePackage").val());
            }
                    jQuery.ajax( {
                    type : 'POST',
                    url : 'media/system/php/createDictionary.php',
                    data : 'url='+"julius/user/"+ac+"/package/dic/"+pk+".xml",
                    success : function(msg) {
                        if (msg.toString().indexOf("true") >= 0) {
                        }else{
                          jQuery("#end").text("ERROR : Can'not Create File."); 
                        }
                        
                     }
                   });
                        
                                                bt.step3.hide("fast");
                                                bt.step4.fadeIn("slow")
            jQuery('div #load').width("600px");
        });    
        
        jQuery('#selectPackage').click(function(){
            jQuery('p.t1 #check').attr('checked',true);            
        });
         jQuery('#namePackage').click(function(){
            jQuery('p.t2 #check').attr('checked',true);            
        });
  
    });
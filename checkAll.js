    function CheckNull(str){
        if(str==""){return true;}        
        return false;
    }    
    function CheckName(str){
        var ok = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_^ ";
        for(var i=0;i<str.length;i++){
            if(ok.indexOf(str.charAt(i)) < 0){
                return true;
            }
        }
        return false;
    }
    function CheckMail(str){
        var regexp = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
        return (regexp.test(str)?false:true);
    }

    function CheckSize(str){
        if(str.length<4){
            return true;
        }
        return false;
    }
 function CheckHave(user){
                    jQuery.ajax({
                    type: "POST",
                    url: "media/system/php/account/checkUser.php",
                    data: "user=" + user,
                    cache : false,
                    success: function (msg) {
                            if(msg=="false"){
                            jQuery("#status").hide("fast");
                            jQuery("#status").html("<center><br><span class='mess2'>ยูสเซอร์นี้สามารถใช้ได้</span>");
                            jQuery("#status").show("slow"); 
                            return true;
                            }else{
                            jQuery("#status").hide("fast");
                            jQuery("#status").html("<center><br><span class='mess'>ยูสเซอร์นี้มีแล้ว</span>");
                            jQuery("#status").show("slow"); 
                            return false;
                        }
                    }
                });   
 }

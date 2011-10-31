//run.js
///////////////////////////Convert Object to String//////////////////////////////////////////////
function object2String(data){
	var value = "";
    for(var i in data){
        value += (i+"="+data[i]+"&");
    }
    var len = value.length;
    value = value.substr(0, len-1);
    return value;
}
///////////////////////////////////Start Ajax////////////////////////////////////////////////////
function RUN(POST, URL, DATA, YES, NO, SHOW) {
    str = object2String(DATA);
    var ms;
    jQuery.ajax( {
        type : POST,
        url : URL,
        data : str,
        success : function(msg) {
            if (msg.toString().indexOf("true") >= 0) {
                jQuery("#" + SHOW).hide("fast");
                jQuery("#" + SHOW).html('<center><span class="mess2">' + YES + '</span>');
                jQuery("#" + SHOW).show("slow");
                for(var i in DATA){
                    jQuery("#"+i).val("");
                }     	
            } else {
                jQuery("#" + SHOW).hide("fast");
                jQuery("#" + SHOW).html('<center><span class="mess">' + NO + '</span>');
                jQuery("#" + SHOW).show("slow");
            }
        }
    });	
}
//////////////////////////////////////////END///////////////////////////////////////
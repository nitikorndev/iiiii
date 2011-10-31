//run.js
///////////////////////////Convert Object to String//////////////////////////////////////////////
function object2String2(data){
    var value = "";
    for(var i in data){
        value += (i+"="+data[i]+"&");
    }
    var len = value.length;
    value = value.substr(0, len-1);
    return value;
}
///////////////////////////////////Start Ajax////////////////////////////////////////////////////
function RUN2(POST, URL, DATA, YES, NO, SHOW) {
    str = object2String2(DATA);
    jQuery.ajax( {
        type : POST,
        url : URL,
        data : str,
        success : function(msg) {
            jQuery("#wordlist").hide("fast");
            jQuery("#wordlist").html(msg);
            jQuery("#wordlist").show("slow");
        }
    });	
}
//////////////////////////////////////////END///////////////////////////////////////
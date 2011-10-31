<link rel="stylesheet" type="text/css" href="media/system/css/ui-lightness/jquery-ui-1.8.16.custom.css">
<style type="text/css">
    @import url("media/system/css/css1.css");
</style> 
<script type="text/javascript" src="media/system/js/jquery-1.6.2.min.js">
</script>
<script type="text/javascript" src="media/system/js/jquery-ui-1.8.16.custom.min.js"></script>
<script>
    $(function() {
        var d=new Date(); 
        var toDay = d.getDate() + '/' + (d.getMonth()+1) + '/' + (d.getFullYear()+543);
        $('#exp').datepicker({ dateFormat: 'yy/mm/dd',
            isBuddhist: true,
            changeYear: true,
            defaultDate: toDay ,
            dayNames: ['อาทิตย์','จันทร์','อังคาร',
                'พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
            dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
            monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม',
                'เมษายน','พฤษภาคม','มิถุนายน',
                'กรกฎาคม','สิงหาคม','กันยายน',
                'ตุลาคม','พฤศจิกายน','ธันวาคม'],
            monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.',
                'พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.',
                'พ.ย.','ธ.ค.']
        });
    });
</script>
<script type="text/javascript" src="media/system/js/checkAll.js"></script>
<script type="text/javascript">
        jQuery(document).ready(function(){
        jQuery("#user1").change(function(){
            CheckHave(jQuery.trim(jQuery("#user1").val()));
        });
        jQuery("#addUserForm").submit(function () {
            
            var user = jQuery.trim(jQuery("#user1").val());
            var pass = jQuery.trim(jQuery("#pass1").val());
            var level = jQuery.trim(jQuery("#level").val());
            var pass2 = jQuery.trim(jQuery("#pass2").val());
            var fname = jQuery.trim(jQuery("#fname").val());
             var lname = jQuery.trim(jQuery("#lname").val());
            var mail = jQuery.trim(jQuery("#mail").val());
            var exp = jQuery.trim(jQuery("#exp").val());
            var status = true;
            var err = "";
            if(CheckNull(user) || CheckNull(pass) || CheckNull(pass2) ||CheckNull(mail) ||CheckNull(fname)||CheckNull(lname)||CheckNull(exp)){
                err += " กรอกข้อมูลไม่ครบ";
                status = false;
            }else{
                if(CheckName(user)){
                    err += " ยูสเซอร์ไม่ถูกต้อง";
                    status = false;
                }
                
                if(CheckSize(user)){
                    err += " ยูสเซอร์เนมน้อยกว่า 4 ตัวอักษร";
                    status = false;
                }
         
            if(pass!=pass2){
                err += " รหัสผ่านไม่ตรงกัน";
                status = false;
            }
            if(CheckMail(mail)){
                err += " อีเมล์ไม่ถูกต้อง";
                status = false;
            }

        }
                    
        if(status)
        {
            if(confirm('Are you sure ?')==false)
            {
                return false;
            }
            jQuery.ajax({
                type: "POST",
                url: "media/system/php/account/registed.php",
                data: "user=" + user + "&level=" + level + "&pass=" + pass + "&pass2=" + pass2 + "&fname=" + fname+ "&lname=" + lname + "&mail=" + mail+ "&exp=" + exp,
                success: function (msg) {
                    if(msg.toString().indexOf("true")>=0){
                        jQuery("#status").hide("fast");
                        jQuery("#status").html("<center><br><span class='mess2'>ลงทะเบียนสำเร็จ</span>");
                        jQuery("#status").show("slow");
                    }else{
                        jQuery("#status").hide("fast");
                        jQuery("#status").html("<center><br><span class='mess'>ลงทะเบียนล้มเหลว</span>");
                        jQuery("#status").show("slow");                            
                    }
                }
            });
        }else{
            jQuery("#status").hide("fast");
            jQuery("#status").html("<center><br><span class='mess'>"+err+"</span>");
            jQuery("#status").show("slow");
        }
        return false;
    });    

});

</script>
<p class="t">แบบฟอร์มลงทะเบียน</p>
<form action="" method="post" name="addUserForm" id="addUserForm" > 
    <table width="350px" border="0" cellpadding="4" cellspacing="2">
        <tr>
            <th >ยูสเซอร์ </th>
            <td ><input type="text" class="input_u" name="user1" id="user1" size="15">
            </td>
        </tr>      
        <tr>
        <tr>
            <th >ประเภท </th>
            <td >
                <select name="level" id="level">
                    <option value="Member">Member</option>
                    <option value="Super Member">Super Member</option>
                    <option value="Administrator">Administrator</option>
                </select>
            </td>
        </tr> 
        <th >รหัสผ่าน </th>
        <td ><input type="password" class="input_u" name="pass1" id="pass1" size="15">
        </td>
        </tr>   
        <tr>
            <th >ยืนยันรหัสผ่าน </th>
            <td ><input type="password" class="input_u" name="pass2" id="pass2" size="15">
            </td>
        </tr>   
        <tr>
            <th >ชื่อ </th>
            <td ><input type="text" class="input_u" name="fname" id="fname" size="15">
            </td>
        </tr>   
                <tr>
            <th >สกุล </th>
            <td ><input type="text" class="input_u" name="lname" id="lname" size="15">
            </td>
        </tr>   
        <tr>
            <th >อีเมล์ </th>
            <td ><input type="text" class="input_u" name="mail" id="mail" size="15">
            </td>
        </tr> 
        <tr>
            <th >วันหมดอายุ </th>
            <td ><input type="text" class="input_u" name="exp" id="exp" size="15">
            </td>
        </tr> 
        <tr>
            <th ></th>
            <td ><input class="button" type="submit"  name="sub" id="sub" value="ลงทะเบียน">
                <input class="button" type="reset"  name="sub" id="sub" value="ล้างข้อมูล">
            </td>
        </tr> 
    </table> 
    <div id="status"></div>  
</form>
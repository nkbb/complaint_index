<?php 
$menu_admin_8 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="fas fa-key"></i> เปลี่ยนรหัสผ่าน</div>
    <div class="admin-body">
        <div  class="row">
            <form id="myForm" action="<?=base_url()?>setting/resetpassword" method="post">
                <input type="hidden" ic="c_pwold" value="N">
                <input type="hidden" id="c_pwnew" value="N">

                <div class="row input-data">
                    <div class="col-md-2"></div>
                    <label class="col-md-2 pl-5">รหัสผ่าน (เดิม)<span class="input-validation">*</span> :</label>
                    <div class="col-md-3">
                        <input type="password" class="form-control" name="old_pw" id="old_pw" onkeyup="checkpwold()"/>
                    </div>
                    <label class="col-md-3 text-danger alert_old"></label>
                </div>
                <div class="row input-data">
                    <div class="col-md-2"></div>
                    <label class="col-md-offset-2 col-md-2 pl-5">รหัสผ่าน (ใหม่)<span class="input-validation">*</span> :</label>
                    <div class="col-md-3">
                        <input type="password" class="form-control" name="pw" id="pw" onkeyup="checkpwnew()"/>
                    </div>
                </div>
                <div class="row input-data">
                    <div class="col-md-2"></div>
                    <label class="col-md-offset-2 col-md-2 pl-5">ยืนยันรหัสผ่าน<span class="input-validation">*</span> :</label>
                    <div class="col-md-3">
                        <input type="password" class="form-control" name="c_pw" id="c_pw" onkeyup="checkpwnew()"/>
                    </div>
                    <label class="col-md-3 text-danger alert_new"></label>
                </div>
            </form>

            <div class="col-md-12 text-center mt-5 ">
                <button onclick="form_submit()" class="btn btn-success">เปลี่ยนรหัสผ่าน</button>
            </div>
            
        </div>
    </div>
  </div>
 
</div>

<script src="<?=base_url()?>../assets/bootstrap/js/sweetalert.min.js"></script>
<link href="<?=base_url()?>../assets/bootstrap/css/sweetalert.css" rel="stylesheet">
<script>

function form_submit(){
    
    if($("#c_pwold").val()=="N" || $("#old_pw").val()==''){
      swal("แจ้งเตือน!", "รหัสผ่านเดิมไม่ถูกต้อง.", "error");
      return false;
    }

    if($("#c_pwnew").val()=="N" || $("#c_pw").val()==''){
      swal("แจ้งเตือน!", "กรุณาตรวจสอบ รหัสผ่านใหม่.", "error");
      return false;
    }

    $("#myForm").submit();
}


function checkpwold(){

    var old_pw = $("#old_pw").val();
    var URL ="<?=base_url()?>setting/checkoldpw";
      $.ajax({
          type: "POST",
          url : URL,
          data : {
            'password': old_pw
          },
          success: function(html) {
            if(html == 'ok'){

              $(".alert_old").html("");
              $("#c_pwold").val("Y");
            }else{
              $(".alert_old").html("รหัสผ่านไม่ถูกต้อง");              
              $("#c_pwold").val("N");
            }

          }
      });

}

function checkpwnew(){
    var pw = $("#pw").val();
    var c_pw = $("#c_pw").val();

    if(pw != c_pw){
      $(".alert_new").html("รหัสผ่าน ไม่เหมือนกัน");
      $("#c_pwnew").val("N");
    }else{
      $(".alert_new").html("");
      $("#c_pwnew").val("Y");
    }
}

</script>

<?php include_once("_inc_footer.php");?>
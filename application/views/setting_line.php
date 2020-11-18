<?php 
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>assets/css/style-admin.css" rel="stylesheet">

<style>
    .input-number { text-align: right; }
</style>
<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="fab fa-line"></i> ตั้งค่าการแจ้งเตือน Line</div>
    <div class="admin-body">
        <div  class="row">
            <form id="myForm" action="<?=base_url()?>setting/line_save" method="post">
                <input type="hidden" name="ind" value="<?=$ind?>" />
                <div class="row input-data">
                    <label class="col-md-3 pl-5">การแจ้งเตือนผ่าน Group Line :</label>
                    <div class="col-md-2">
                        <input type="checkbox" class="form-check-input" id="user_line" name="user_line" <?php if($user_line=="on"){ echo "checked"; }?> />
                        <label class="form-check-label" for="user_line"> ใช้งาน</label>
                    </div>
                </div>
                <div class="row input-data">
                    <label class="col-md-3 pl-5">Line Token :</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="token_line" value="<?=$token_line?>" placeholder="Token Line"/>
                    </div>
                    <div class="col-md-3">
                        <a href="#">ตัวอย่าง การขอ Token Line</a>
                    </div>
                </div>


                <?php if($user_line == 'on' && $token_line != '') {?>
                    <div class="col-md-12 text-center mt-5 ">
                        <h4>ทดสอบการส่ง LINE Group</h4>
                        <div class="offset-md-4 col-md-4">
                            <input type="text" class="form-control" name="msg" id="msg">
                        </div>
                    </div>
                <?php }?>
                
                <div class="col-md-12 text-center mt-5 ">
                    <input type="submit" value="บันทึก" class="btn btn-success">
                    <?php if($user_line == 'on' && $token_line != '') {?>
                        <a href="javascript:testLine()" class="btn btn-primary">ทดสอบ</a>
                    <?php }?>
                    <a href="<?=base_url()?>setting" class="btn btn-light" >ย้อนกลับ</a>
                </div>


               

            </form>
        </div>
    </div>
  </div>
 
</div>
<link href="<?=base_url()?>assets/icheck-1.x/skins/square/green.css" rel="stylesheet">
<script src="<?=base_url()?>assets/icheck-1.x/icheck.js"></script>

<script>
$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-green',
    increaseArea: '20%' // optional
  });
});

function testLine(){
  var msg = $("#msg").val();
  if(!msg){
    alert('กรุณากรอกข้อความที่ต้องการทดสอบ ส่ง LINE Group');
    return false;
  }
  var token = "<?=$token_line?>";
  if(!token){
    alert('ผิดพลาด กรุณาตรวจสอบ Tokne LINE อีกครั้ง');
    return false;
  }

  $.ajax({
    type: "GET",
    dataType: "json",
    contentType: "x-www-form-urlencoded; charset=utf-8",
    cache: false,
    url: "<?=base_url()?>line/testLINE",
    data:{
      'message': msg,
      'token': token,
    },
    success: function(data) {
      if(data.status == 200){
        alert('ส่ง ข้อความสำเร็จ')
      }else if(data.status == 401){
        alert('Token LINE ไม่ถูกต้อง กรุณาตั้งค่าใหม่อีกครั้ง !!!')
      }else{
        alert('ผิดพลาก กรุณาตั้งค่าใหม่อีกครั้ง !!!')
      }
    }
  });
}
</script>
<?php include_once("_inc_footer.php");?>
<?php 
$menu_admin_1 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="fab fa-line"></i> ผูกบัญชี LINE</div>
    <div class="admin-body">
    	<div class="row">
    		<div class="col-md-12 text-center">

    			<div class="mt-4 mb-4">
            <div style="font-size: 64px;margin-bottom: 8px;color: #28a745;"><i class="far fa-check-circle"></i></div>
    				ท่านได้ ตั้งค่า การแจ้งเตือนผ่าน LINE Group เรียบร้อยแล้ว
            <div class="mt-4">
              <p>ทดสอบการส่ง LINE Group<p>
              <div class="offset-md-4 col-md-4">
                <input type="text" class="form-control" name="msg" id="msg">
              </div>
              <div class="text-center mt-2">
                <button type="button" class="btn btn-primary" onClick="testLine()">ทดสอบ</button>
                <a href="<?=base_url()?>line" class="btn btn-light">ย้อนกลับ</a>

              </div>

              <!-- <img src="assets/images/lineoa.png" width='200px'> -->
            </div>
    			</div>
    			
    		</div>
    		
    	</div>

    </div>
  </div>
 
</div>

<script>
function testLine(){
  var msg = $("#msg").val();
  if(!msg){
    alert('กรุณากรอกข้อความที่ต้องการทดสอบ ส่ง LINE Group');
    return false;
  }
  var token = "<?=$token?>";
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
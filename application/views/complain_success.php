<?php 
$menu_admin_1 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="far fa-check-circle"></i> แบบบันทึกข้อร้องเรียน</div>
    <div class="admin-body">
		<div>
	    	<div class="row">
                <div class="col-12 text-center">
                    <h4 style="color:#28a745">บันทึกข้อร้องเรียน เรียบร้อยแล้ว!!!</h4>
                    <div class="mt-3 mb-5">
                        <a href="<?=base_url()?>/main" class="btn btn-light">กลับสู่หน้าหลัก</a>
                    </div>
                </div>
	    	</div>
    	</div>

    </div>
  </div>
 
</div>

<?php include_once("_inc_footer.php");?>
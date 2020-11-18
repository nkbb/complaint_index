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
           			 <div style="font-size: 64px;margin-bottom: 8px;color: #dc3545;"><i class="far fa-times-circle"></i></div>
    				หน่วยของท่าน ปิดการใช้งาน การแจ้งเตือน ผ่าน LINE Group 
					<div class="text-center mt-2">
						<a href="<?=base_url()?>line" class="btn btn-light">ย้อนกลับ</a>	
					</div>
    			</div>
    			
    		</div>
    		
    	</div>

    </div>
  </div>
 
</div>

<script>



</script>
<?php include_once("_inc_footer.php");?>
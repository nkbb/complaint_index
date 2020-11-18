<?php 
$menu_admin_1 = "active";
include_once("_inc_hearder.php");?>
<style>

.button {
  background-color: #00C300; /* Green */
  border: none;
  color: white;
  text-align: center;
  padding: 15px 32px;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  color: #fff;
  border-radius: 5px;
}

.button:hover{ 
	color:#ffff;
	background-color: #00E000;
	text-decoration: none;
}

.button_disable {
  background-color: #C6C6C6; /* Green */
  border: none;
  color: white;
  text-align: center;
  padding: 15px 32px;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  color: #fff;
  border-radius: 5px;
  cursor: not-allowed;
}
.button_disable:hover {
	color:#ffff;
	text-decoration: none;
}

</style>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="fab fa-line"></i> ผูกบัญชี Line</div>
    <div class="admin-body">
    	<div class="row">
    		<div class="col-md-12 text-center">
    			<?php if($check['line_status'] == 1){ ?>
    			<div class="mt-4 mb-4">
    				ท่านได้ผู้บัญชี Line เรียบร้อยแล้ว <br/>หากต้องการผู้บัญชี Account Line ใหม่ กรุณาติดต่อผู้ดูแลระบบ <a href="#">คู่มือการใช้งาน</a> 
    			</div>
    			<a href="#" class="button_disable"> Log in with LINE</a>
    			<?php }else{ ?>
    			<div class="mt-4 mb-4">
    				ผู้ใช้งานสามารถ เข้าสู่ระบบ Line โดยการผู้บัญชี Line <br/>เพื่อรับข้อมูลการแจ้งเตือนการร้องเรียน <a href="#">คู่มือการใช้งาน</a> 
    			</div>
    			<a href="<?=base_url()?>line/login" class="button"> Log in with LINE</a>
    			<?php }?>
    		</div>
    		
    	</div>

    </div>
  </div>
 
</div>

<script>



</script>
<?php include_once("_inc_footer.php");?>
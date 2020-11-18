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
<link href="<?=base_url()?>assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="fab fa-line"></i> ผูกบัญชี Line Group</div>

    <div class="admin-body">
    <div  class="row">
            <form id="myForm" action="<?=base_url()?>line/save" method="post">
                <input type="hidden" name="ind" value="<?=(isset($ind))? $ind: '';?>" />
                <div class="row input-data">
                    <label class="col-md-3 pl-5">การแจ้งเตือนผ่าน Group LINE :</label>
                    <div class="col-md-2">
                        <input type="checkbox" class="form-check-input" id="is_use" name="is_use" value="1" <?php if(isset($is_use) && $is_use == 1 ){ echo "checked"; }?>/>
                        <label class="form-check-label" for="user_line"> ใช้งาน</label>
                    </div>
                </div>
                <div class="row input-data">
                    <label class="col-md-3 pl-5">ชื่อกลุ่ม :</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="name" value="<?=(isset($name))? $name: '';?>"/>
                    </div>
                </div>
                <div class="row input-data">
                    <label class="col-md-3 pl-5">LINE Token :</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="token" value="<?=(isset($token))? $token: '';?>" placeholder="Token Line"/>
                    </div>
                    <div class="col-md-3">
                        <a href="#">ตัวอย่าง การขอ Token LINE</a>
                    </div>
                </div>
                
                <div class="col-md-12 text-center mt-5 ">
                    <input type="submit" value="บันทึก" class="btn btn-success">
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
</script>
<?php include_once("_inc_footer.php");?>
<?php 
$menu_4 = "navbar-active";
include_once("_inc_hearder.php");?>

<div class="container">
    <div class="pt-5 pb-4" id="mainpage">
    
        <div class="row">
            <div class="title col-md-12 text-center">เข้าสู่ระบบ</div>
        </div>

        <div class="row" style="margin: 0 10px 15px 10px;">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <form class="user" action="<?=base_url()?>main/checklogin" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="ชื่อผู้ใช้งาน">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="รหัสผ่าน">
                    </div>
                   
                    <input type="submit" value="เข้าสู่ระบบ" class="btn btn-primary btn-user btn-block" style="margin-bottom: 35px;">
                      
                </form>
            </div>
        </div>
    </div>
   
</div>


<script src="<?=base_url()?>assets/bootstrap/js/sweetalert.min.js"></script>
<link href="<?=base_url()?>assets/bootstrap/css/sweetalert.css" rel="stylesheet">
<script>
$(function(){
    var alerts = "<?=(isset($_GET["alerts"])) ? $_GET['alerts'] : '';?>";
    if(alerts == "error"){
        swal("ผิดพลาด", "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!", "warning");
    }            
})

</script>

<?php include_once("_inc_footer.php");?>

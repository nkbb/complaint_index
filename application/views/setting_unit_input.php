<?php 
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="fas fa-university"></i> จัดการหน่วย</div>
    <div class="admin-body">
        <div  class="row">
            <form id="myForm" action="<?=base_url()?>setting/unit_save" method="post">
            <input type="hidden" name="token" value="<?=(!empty($token)? $token:'')?>" />
                <div class="row input-data">
                    <label class="col-md-2 pl-5">ชื่อหน่วย :</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="name" name="name" value="<?=(!empty($name)? $name:'')?>">
                    </div>
                </div>
                <div class="row input-data">
                    <label class="col-md-2 pl-5">ชื่อย่อ :</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="short_name" name="short_name" value="<?=(!empty($short_name)? $short_name:'')?>">
                    </div>
                </div>
                <div class="row input-data">
                    <label class="col-md-2 pl-5">พื้นที่ :</label>
                    <div class="col-md-4">
                        <select class="form-control" name="area" title="<?=(!empty($area)? $area:'')?>" >
                            <option value="1">หน่วยส่วนกลาง</option>
                            <option value="2">หน่วยบริการ</option>
                            <option value="3">ศูนย์สุขภาพจิต</option>
                        </select>
                    </div>
                </div>

            </form>
                    <div class="col-md-12 text-center mt-5 ">
                        <button onclick="saveData()" type="button" class="btn btn-success">บันทึก</button>
                        <a href="<?=base_url()?>setting/unit" class="btn btn-light">ย้อนกลับ</a>
                    </div>
        </div>
    </div>

  </div>
 
</div>
<script>
function saveData(){
    $("#myForm").submit();
}
</script>
<?php include_once("_inc_footer.php");?>
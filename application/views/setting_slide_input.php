<?php 
$menu_admin_10 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="far fa-images"></i> จัดการภาพสไลด์ (หน้าแรก)</div>
    <div class="admin-body">
         <div  class="row">
            <form id="myForm" action="<?=base_url()?>setting/slide_save" method="post" enctype="multipart/form-data">
                <div class="row input-data">
                    <label class="col-md-2 pl-5">ชื่อหน่วย :</label>
                    <div class="col-md-6">
                        <div class="custom-file">
                                <input type="file" class="custom-file-input" accept=".png, .jpg, .jpeg" id="files" name="file" onchange="shownameimg(event)">
                                <label class="custom-file-label" id="filename" for="validatedCustomFile" style="overflow: hidden; white-space: nowrap;">Choose file...</label>
                                <small class="form-text text-muted">กรุณาเลือกไฟล์รูปภาพ png, jpg ขนาด 1300*500 px</small>
                            </div>
                        </div>
                </div>
            </form>
            <div class="col-md-12 text-center mt-5 ">
                <button onclick="saveData()" type="button" class="btn btn-success">บันทึก</button>
                <a href="<?=base_url()?>setting/slide" class="btn btn-light">ย้อนกลับ</a>
            </div>
        </div>   
    </div>
  </div>
 
</div>
<script src="<?=base_url()?>../assets/bootstrap/js/sweetalert.min.js"></script>
<link href="<?=base_url()?>../assets/bootstrap/css/sweetalert.css" rel="stylesheet">
<script>
    function saveData(){
        if($("#files").val()==""){
            swal("แจ้งเตือน!", "กรุณาเลือกรูปภาพ!", "warning");
        }else{
            $("#myForm").submit();
        }
    }

    function shownameimg(event){
        $("#filename").html(event.target.files[0].name);
    }
</script>
<?php include_once("_inc_footer.php");?>
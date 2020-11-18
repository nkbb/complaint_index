<?php 
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>assets/css/style-admin.css" rel="stylesheet">

<style>
    .input-number { text-align: right; }
</style>
<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="fas fa-cog"></i> หลักเกณฑ์ การร้องเรียน</div>
    <div class="admin-body">
        <div  class="row">
            <form id="myForm" action="<?=base_url()?>setting/complaint_save" method="post">
                <input type="hidden" name="ind" value="<?=$ind?>" />
                <div class="row input-data">
                    <label class="col-md-3 pl-5">รหัส เรื่องร้องเรียน :</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="key_title" value="<?=$key_title?>"/>
                    </div>
                </div>
                <div class="row input-data">
                    <label class="col-md-3 pl-5">หลักเกณฑ์การรับเรื่องร้องเรียน :</label>
                    <div class="col-md-9">
                        <textarea name="conditions" class="ckeditor" id="editor" ><?=$conditions?></textarea>
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
<script type="text/javascript" src="<?=base_url()?>assets/ckeditor/ckeditor.js"></script> 
<?php include_once("_inc_footer.php");?>
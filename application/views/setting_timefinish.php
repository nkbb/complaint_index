<?php 
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<style>
    .input-number { text-align: right; }
</style>
<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="far fa-calendar-minus"></i> ตั้งค่าเวลาดำเนินการ</div>
    <div class="admin-body">
        <div  class="row">
            <form id="myForm" action="<?=base_url()?>setting/time_save" method="post">
                <input type="hidden" name="ind" value="<?=$ind?>" />
                <div class="row input-data">
                    <label class="col-md-3 pl-5">ศูนย์ส่งเรื่อง ภายใน(วัน) :</label>
                    <div class="col-md-3">
                        <input type="number" class="form-control input-number" name="dead_date_send" value="<?=$dead_date_send?>"/>
                    </div>
                </div>
                <div class="row input-data">
                    <label class="col-md-3 pl-5">หน่วยรับเรื่อง ภายใน(วัน) :</label>
                    <div class="col-md-3">
                        <input type="number" class="form-control input-number" name="dead_date_receive" value="<?=$dead_date_receive?>"/>
                    </div>
                </div>
               <!--  <div class="row input-data">
                    <label class="col-md-3 pl-5">หน่วยดำเนินการ ภายใน(วัน)</label>
                    <div class="col-md-3">
                        <input type="number" class="form-control input-number" name="dead_date_answer" value="<?=$dead_date_answer?>"/>
                    </div>
                </div> -->
                <div class="row input-data">
                    <label class="col-md-3 pl-5">ศูนย์ยุติเรื่อง รายงานผู้บริหาร ภายใน(วัน) :</label>
                    <div class="col-md-3">
                        <input type="number" class="form-control input-number" name="dead_date_finish" value="<?=$dead_date_finish?>"/>
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
<?php include_once("_inc_footer.php");?>
<?php 
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="far fa-clipboard"></i> จัดการหัวข้อ แบบประเมิน</div>
    <div class="admin-body">
        <div  class="row">
            <form id="myForm" action="<?=base_url()?>setting/question_save" method="post">
                
                <input type="hidden" name="ind" value="<?=(isset($ind)) ? $ind : '';?>"/>

                <div class="row input-data">
                    <label class="col-md-2 pl-5">หัวข้อ :</label>
                    <div class="col-md-8 form-group mb-0">
                        <input type="text" class="form-control" id="name" name="name" value="<?=(isset($name)) ?  $name : '';?>">
                    </div>
                </div>

             
                <div class="col-md-12 text-center mt-5 ">
                    <input type="submit" class="btn btn-primary" value="บันทึก">
                    <a href="<?=base_url()?>setting/question" class="btn btn-light">ย้อนกลับ</a>
                </div>
            </form>
        </div>
    </div>

  </div>
 
</div>

<script src="<?=base_url()?>assets/cleave-master/cleave.min.js"></script>
<script src="<?=base_url()?>assets/cleave-master/addons/cleave-phone.th.js"></script>
<script>

$(document).ready(function() {
    $(".iderror").hide();
    $("#myForm").bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอก หัวข้อแบบประเมินความพึงพอใจ'
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
        
    });
});
</script>
<?php include_once("_inc_footer.php");?>
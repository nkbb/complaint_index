<?php 
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="far fa-user"></i> จัดการผู้ใช้งาน</div>
    <div class="admin-body">
        <div  class="row">
            <form id="myForm" action="<?=base_url()?>setting/user_save" method="post">
            <input type="hidden" name="c_id" id="c_id" value="N" />
                <div class="row input-data  checkid">
                    <label class="col-md-2 pl-5">ID :</label>
                    <div class="col-md-4  form-group mb-0">
                        <input type="text" class="form-control" id="id" name="id" onblur="CheckID(this.value)">
                    </div>
                    <div class="col-md-4 iderror">
                        <small class="text-danger" style="">ไม่สามารถใช้ ID นี้ได้</small>
                    </div>
                </div>
                <div class="row input-data">
                    <label class="col-md-2 pl-5">Password :</label>
                    <div class="col-md-4 form-group mb-0">
                        <input type="text" class="form-control" id="password" name="password">
                    </div>
                </div>

                <div class="row input-data">
                    <label class="col-md-2 pl-5">ชื่อ ผู้รับผิดชอบ :</label>
                    <div class="col-md-4 form-group mb-0">
                        <input type="text" class="form-control" id="auth_fname" name="auth_fname">
                    </div>
                </div>

                <div class="row input-data">
                    <label class="col-md-2 pl-5">นามสกุล ผู้รับผิดชอบ :</label>
                    <div class="col-md-4 form-group mb-0">
                        <input type="text" class="form-control" id="auth_lname" name="auth_lname">
                    </div>
                </div>

                <div class="row input-data">
                    <label class="col-md-2 pl-5">เบอร์ติดต่อ (มือถือ) :</label>
                    <div class="col-md-4 form-group mb-0">
                        <input type="text" class="form-control cleave-input-phone" id="auth_phone" name="auth_phone">
                    </div>
                </div>

                <div class="row input-data">
                    <label class="col-md-2 pl-5">โทรสาร :</label>
                    <div class="col-md-4 form-group mb-0">
                        <input type="text" class="form-control cleave-input-fax" id="auth_fax" name="auth_fax">
                    </div>
                </div>

                <div class="row input-data">
                    <label class="col-md-2 pl-5">Email :</label>
                    <div class="col-md-4 form-group mb-0">
                        <input type="email" class="form-control" id="auth_email" name="auth_email">
                    </div>
                </div>


                <div class="row input-data">
                    <label class="col-md-2 pl-5">ระดับการเข้าถึง :</label>
                    <div class="col-md-4 form-group mb-0">
                        <select class="form-control" name="level" name="level" title="<?=(!empty($level)? $level:'')?>" onchange="checkLevel(this.value)">
                            <option value="">== กรุณาเลือก ==</option>
                            <option value="user">หน่วย</option>
                            <option value="admin">ศูนย์รับเรือง/ส่วนกลาง</option>
                        </select>
                    </div>
                </div>
                <div class="row input-data selunit" style="display: none;">
                    <label class="col-md-2 pl-5">หน่วย :</label>
                    <div class="col-md-4 form-group mb-0">
                        <select class="form-control " name="unit" id="unit" title="<?=(!empty($unit)? $unit:'')?>" >
                            <option value="">== กรุณาเลือก ==</option>
                            <?php foreach ($unit as $key => $value) {
                               echo "<option value='".$value["ind"]."'>".$value["name"]."</option>";
                            }?>
                        </select>
                    </div>
                </div> 
                <div class="col-md-12 text-center mt-5 ">
                    <input type="submit" class="btn btn-primary" value="บันทึก">
                    <a href="<?=base_url()?>setting/user" class="btn btn-light">ย้อนกลับ</a>
                </div>
            </form>
        </div>
    </div>

  </div>
 
</div>

<script src="<?=base_url()?>assets/cleave-master/cleave.min.js"></script>
<script src="<?=base_url()?>assets/cleave-master/addons/cleave-phone.th.js"></script>
<script>

var cleave = new Cleave('.cleave-input-phone', {
    delimiters: ['-', '-', '-' ],
    blocks: [3, 3, 4 ]
});


var cleave = new Cleave('.cleave-input-fax', {
    delimiters: ['-', '-', '-' ],
    blocks: [2, 3, 4 ]
});

$(document).ready(function() {
    $(".iderror").hide();
    $("#myForm").bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },fields: {
            id: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอก ID'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอก รหัสผ่าน'
                    }
                }
            },
            level: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาเลือกระดับการใช้งาน'
                    }
                }
            },
            auth_fname: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอก ชื่อผู้รับผิดชอบ'
                    }
                }
            },
            auth_lname: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอก นามสกุลผู้รับผิดชอบ'
                    }
                }
            },
            auth_phone: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอก โทรศัพท์ผู้รับผิดชอบ'
                    }
                }
            },
            auth_fax: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอก โทรสารผู้รับผิดชอบ'
                    }
                }
            },
            auth_email: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอก Emailผู้รับผิดชอบ'
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
        var c_id = $("#c_id").val();
        if(c_id != "Y"){
            $(".iderror").show();
            e.preventDefault();
        }
    });
});



function CheckID(val){
    var URL ="<?=base_url()?>setting/checkID?id="+val;
    $.ajax({
            type: "POST",
            url : URL,
            success: function( html ) {
       if(html=='ok'){
          $("#c_id").val("Y");
          $(".iderror").hide();
       }else{
          $(".iderror").show();
          $("#c_id").val("N");
       }
     }
    });
}

function checkLevel(type){
    if(type=='user'){
        $(".selunit").show();
    }else{
        $(".selunit").hide();
    }

}


</script>
<?php include_once("_inc_footer.php");?>
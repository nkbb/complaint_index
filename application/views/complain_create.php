<?php 
$menu_admin_11 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="far fa-paper-plane"></i> รับเรื่องร้องเรียน-ส่งให้หน่วยดำเนินการ</div>
    <div class="admin-body">
        <div class="text-danger ml-5 mb-2">*** กรณีไม่มีข้อมูล ผู้ร้องเรียนไม่ต้องกรอกข้อมูล</div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel-text-header mb-3" style="color:#fff;">
            <p>ข้อมูลผู้ร้องเรียน</p>
          </div>
        </div>
      </div>
      <form id="myForm" action="<?=base_url()?>manage/save" method="post" enctype="multipart/form-data">
            <input type="hidden" name="token" value="<?=$token?>"/>
            <input type="hidden" name="type_add" value="<?php if($this->session->userdata('level')=='user'){ echo '3';}else if($this->session->userdata('level')=='admin'){echo'2';}else if($this->session->userdata('level')=='root'){ echo '2';}else{ echo '2'; }?>"/>
            <div class="row input-data input-row">
                <label class="col-md-2">ปกปิด :</label>
                <div class="col-md-8 form-check">
                    <div>
                        <input type="checkbox" class="form-check-input" id="hide_data" name="status">
                        <label class="form-check-label text-danger" for="hide_data">ถ้าต้องการปกปิด ชื่อและข้อมูลส่วนตัว ให้คลิกที่นี่</label>
                    </div>
                </div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">ชื่อ ผู้ร้องเรียน :</label>
                <div class="col-md-3 form-group mb-0">
                    <input type="text" class="form-control" id="fname" name="fname">
                </div>
                <label class="col-md-2">นามสกุล ผู้ร้องเรียน :</label>
                <div class="col-md-3 form-group mb-0">
                    <input type="text" class="form-control" id="lname" name="lname">
                </div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">เลขบัตรประชาชน :</label>
                <div class="col-md-3 form-group mb-0">
                    <input type="text" class="form-control cleave-input-idcard" id="idcard" name="idcard">
                </div>
                <label class="col-md-2">เพศ :</label>
                <div class="col-md-3 form-group mb-0">
                    <select class="form-control" id="sex" name="sex">
                        <option value="1">ชาย</option>
                        <option value="2">หญิง</option>
                    </select>
                </div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">อาชีพ :</label>
                <div class="col-md-3 form-group mb-0">
                    <input type="text" class="form-control" id="work" name="work">
                </div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">ที่อยู่ :</label>
                <div class="col-md-8 form-group mb-0">
                    <input type="text" class="form-control" id="address" name="address">
                </div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">จังหวัด :</label>
                <div class="col-md-3 form-group mb-0">
                    <select class="form-control" name="province" id="province" onchange="selectAmphur(this.value)">
                        <option value="">== กรุณาเลือก ==</option>
                        <?php foreach($province as $key => $value){
                            echo "<option value='".$value["province_id"]."'>".$value["province_name"]."</option>";
                        }?>
                    </select>
                </div>
                <label class="col-md-2">อำเภอ :</label>
                <div class="col-md-3 form-group mb-0">
                    <select class="form-control" name="amphur" id="amphur" onchange="selectDistrict(this.value)">
                        <option value="">== กรุณาเลือก ==</option>
                    </select>
                </div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">ตำบล :</label>
                <div class="col-md-3 form-group mb-0">
                    <select class="form-control" name="district" id="district">
                        <option value="">== กรุณาเลือก ==</option>
                    </select>
                </div>
                <label class="col-md-2">รหัสไปรษณี :</label>
                <div class="col-md-3 form-group mb-0">
                    <input type="text" class="form-control" name="zipcode" id="zipcode" />
                </div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">โทรศัพท์ :</label>
                <div class="col-md-3 form-group mb-0">
                    <input type="text" class="form-control cleave-input-tel" id="tel" name="tel">
                </div>
                <label class="col-md-2">โทรสาร :</label>
                <div class="col-md-3 form-group mb-0">
                    <input type="text" class="form-control cleave-input-fax" id="fax" name="fax">
                </div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">มือถือ :</label>
                <div class="col-md-3 form-group mb-0">
                    <input type="text" class="form-control cleave-input-phone" id="phone" name="phone">
                </div>
                <label class="col-md-2">Email :</label>
                <div class="col-md-3 form-group mb-0">
                    <input type="text" class="form-control" id="email" name="email">
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-text-header mb-3 mt-3">
                        <p>ข้อมูลเกี่ยวกับเรื่องร้องเรียน</p>
                    </div>
                </div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">ช่องทางร้องเรียน :</label>
                <div class="col-md-4 form-group mb-0">
                    <select class="form-control" id="complaint_method" name="complaint_method">
                        <option value="">== กรุณาเลือก ==</option>
                        <?php foreach($complaint_method as $key => $value){
                            echo "<option value='".$value["ind"]."'>".$value["name"]."</option>";
                        }?>
                    </select>
                </div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">ร้องเรียนถึง :</label>
                <div class="col-md-4 form-group mb-0">
                    <select class="form-control" id="office_unit" name="office_unit">
                        <option value="">== กรุณาเลือกหน่วยงาน ==</option>
                        <!-- <option value="">== ไม่ทราบหน่วยงาน ==</option> -->
                        <?php foreach($unit as $key => $value){
                            echo "<option value='".$value["ind"]."'>".$value["name"]."</option>";
                        }?>
                    </select>
                </div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">ประเภทการร้องเรียน :</label>
                <div class="col-md-4 form-group mb-0">
                    <select class="form-control"  id="complaint_type" name="complaint_type" onchange="selectcomplaint_sub(this.value)">
                        <option value="">== กรุณาเลือก ==</option>
                        <?php foreach($comp_type as $key => $value){
                            echo "<option value='".$value["ind"]."'>".($key+1).". ".$value["name"]."</option>";
                        }?>
                    </select>
                </div>
                <label class="col-md-2 comp_sub">ประเภทย่อย :</label>
                <div class="col-md-4 form-group mb-0 comp_sub">
                    <select class="form-control"  id="complaint_sub" name="complaint_sub">
                        <option value="">== กรุณาเลือก ==</option>
                    </select>
                </div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">ร้องเรียนบุคคล :</label>
                <div class="col-md-4 form-group mb-0">
                    <select class="form-control" id="complaint_person" name="complaint_person">
                        <option value="">== กรุณาเลือก ==</option>
                        <?php foreach($complaint_person as $key => $value){
                            echo "<option value='".$value["ind"]."'>".($key+1).". ".$value["name"]."</option>";
                        }?>
                    </select>
                </div>
            </div>

            <div class="row input-data input-row">
                <label class="col-md-2">เรื่องที่ร้องเรียน :</label>
                <div class="col-md-4 form-group mb-0">
                    <input type="text" class="form-control" id="name" name="name">
                </div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">รายละเอียดเรื่องที่ร้องเรียน :</label>
                <div class="col-md-8 form-group mb-0">
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">สิ่งที่ต้องการให้แก้ไข ปรับปรุง :</label>
                <div class="col-md-8 form-group mb-0">
                    <textarea class="form-control" id="improvement" name="improvement" rows="3"></textarea>
                </div>
            </div>
            <div class="row input-data input-row">
                <label class="col-md-2">เอกสารประกอบ (ถ้ามี) :</label>
                <div class="col-md-4 form-group mb-0">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" accept=".png, .jpg, .jpeg, .pdf, .doc" id="files" name="file" onchange="shownameimg(event)">
                        <label class="custom-file-label" id="filename" for="validatedCustomFile" style="overflow: hidden; white-space: nowrap;">Choose file...</label>
                        <small class="form-text text-muted">กรุณาเลือกไฟล์ word, pdf, หรือรูปภาพ </small>
                    </div>
                </div>
            </div>
            <?php if($this->session->userdata('level')=='user'){?>
            <div class="row input-data input-row">
                <label class="col-md-2">วันที่รับเรื่องร้องเรียน :</label>
                <div class="col-md-3 form-group mb-0">
                    <input type="text" class="form-control dateadd" id="date_unit" name="date_unit" autocomplete="off">
                </div>
            </div>
           <?php }?>
            <?php if($this->session->userdata('level')=='user'){?>
            <input type="hidden" name="send_unit" value="<?=$this->session->userdata('unit')?>"/>
            <?php } ?>
            <?php if($this->session->userdata('level')=='root' || $this->session->userdata('level')=='root'){?>
                <div class="row input-data input-row">
                    <label class="col-md-2">หน่วยกำกับดูแล :</label>
                    <div class="col-md-4 form-group mb-0">
                        <select class="form-control" id="send_unit" name="send_unit">
                            <option value="">== กรุณาเลือก ==</option>
                            <?php foreach($unit as $key => $value){
                                echo "<option value='".$value["ind"]."'>".$value["name"]."</option>";
                            }?>
                        </select>
                    </div>
                </div>
            <?php }?>
            <div class="row">
                <div class="col-md-12 text-center my-5">
                    <input type="submit" id="btnsubmit" class="btn btn-primary" value="บันทึก">
                </div>
            </div>
            
        </form>
    </div>
  </div>
</div>

<script src="<?=base_url()?>../assets/cleave-master/cleave.min.js"></script>
<script src="<?=base_url()?>../assets/cleave-master/addons/cleave-phone.th.js"></script>
<link href="<?=base_url()?>../assets/icheck-1.x/skins/square/orange.css" rel="stylesheet">
<script src="<?=base_url()?>../assets/icheck-1.x/icheck.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>../assets/datetimepicker-master/jquery.datetimepicker.css" />
<script src="<?=base_url()?>../assets/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
<script>
function shownameimg(event){
    $("#filename").html(event.target.files[0].name);
}

    jQuery.datetimepicker.setLocale('th');
    jQuery('.dateadd').datetimepicker({
     timepicker:false,
     format:'Y-m-d'
    });

$(document).ready(function() {

    $(".comp_sub").hide();
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-orange',
        radioClass: 'iradio_square-orange',
        increaseArea: '20%' // optional
    });

    $("#myForm").on("change", "select[name='complaint_type']", function() {
        let select = $(this).val();
        if (select == 1 || select == 2) {
            $('#myForm')
                .bootstrapValidator('addField', 'complaint_sub', {
                    validators: {
                        notEmpty: {
                            message: 'กรุณาเลือกประเภทย่อย'
                        }
                    }
                })
        } else {
            $('#myForm').bootstrapValidator('removeField', 'complaint_sub');
        }
    });

    $("#myForm").bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            email: {
                validators: {
                    emailAddress: {
                        message: 'รูปแบบอีเมล์ไม่ถูกต้อง'
                    }
                }
            },
            complaint_method: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาเลือกช่องทางร้องเรียน'
                    }
                }
            },
            office_unit: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาเลือกหน่วยงาน'
                    }
                }
            },
            complaint_type: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาเลือกประเภทการร้องเรียน'
                    }
                }
            },
            // complaint_person: {
            //     validators: {
            //         notEmpty: {
            //             message: 'กรุณาเลือกบุคคลที่ร้องเรียน'
            //         }
            //     }
            // },
            // name: {
            //     validators: {
            //         notEmpty: {
            //             message: 'กรุณากรอกเรื่องที่ร้องเรียน'
            //         }
            //     }
            // },
            // description: {
            //     validators: {
            //         notEmpty: {
            //             message: 'กรุณากรอกรายละเอียด'
            //         }
            //     }
            // },
            // send_unit: {
            //     validators: {
            //         notEmpty: {
            //             message: 'กรุณาเลือกหน่วยกำกับดูแล'
            //         }
            //     }
            // }
           
        }
    })
    .on('success.form.bv', function(e) {
        
    });

});

var cleave = new Cleave('.cleave-input-idcard', {
    delimiters: ['-', '-', '-' ,'-', '-'],
    blocks: [1, 4, 5, 2, 1]
});

var cleave = new Cleave('.cleave-input-phone', {
    delimiters: ['-', '-', '-' ],
    blocks: [3, 4, 3 ]
});

var cleave = new Cleave('.cleave-input-tel', {
    delimiters: ['-', '-', '-' ],
    blocks: [2, 3, 4 ]
});

var cleave = new Cleave('.cleave-input-fax', {
    delimiters: ['-', '-', '-' ],
    blocks: [2, 3, 4 ]
});



function selectcomplaint_sub(type){
    var URL ="<?=base_url()?>main/loadcomplaintsub?type="+type;
    $("#complaint_sub").html("");
    $("#complaint_sub").append("<option value=''>== กรุณาเลือก ==</option>");

    $.ajax({
        type: "GET",
        dataType: "json",
        contentType: "x-www-form-urlencoded; charset=utf-8",
        cache: false,
        url: URL,
        success: function(data) {
            if(data.item == ''){
                $(".comp_sub").hide();
                $('#myForm').bootstrapValidator('removeField', 'complaint_sub');
            }else{
                $(".comp_sub").show();
                $.each(data.item, function(i, item) {
                    var ii = i+1;
                    $("#complaint_sub").append("<option value='"+item.ind+"'> "+item.complaint_type+"."+ii+" "+item.name+"</option> ");
                });
                $('#myForm')
                .bootstrapValidator('addField', 'complaint_sub', {
                    validators: {
                        notEmpty: {
                            message: 'กรุณาเลือกประเภทย่อย'
                        }
                    }
                });
            }
        }
    }); 
}

function selectAmphur(id){
    var URL ="<?=base_url()?>main/loadamphur?id="+id;
    $("#amphur").html("");
    $("#amphur").append("<option value=''>== กรุณาเลือก ==</option>");

    $("#district").html("");
    $("#district").append("<option value=''>== กรุณาเลือก ==</option>");

    $("#zipcode").val("")

    $.ajax({
        type: "GET",
        dataType: "json",
        contentType: "x-www-form-urlencoded; charset=utf-8",
        cache: false,
        url: URL,
        success: function(data) {  
        $.each(data.item, function(i, item) {
            $("#amphur").append("<option value='"+item.amphur_id+"'>"+item.amphur_name+"</option> ");
        });

        }
    }); 
}

function selectDistrict(id){
    var URL ="<?=base_url()?>main/loaaddistrict?id="+id;
    $("#district").html("");
    $("#district").append("<option value=''>== กรุณาเลือก ==</option>");

    $("#zipcode").val("")
    
    $.ajax({
        type: "GET",
        dataType: "json",
        contentType: "x-www-form-urlencoded; charset=utf-8",
        cache: false,
        url: URL,
        success: function(data) {  
        $.each(data.item, function(i, item) {
            $("#district").append("<option value='"+item.district_id+"'>"+item.district_name+"</option> ");
        });

        }
    }); 
}
</script>

<?php include_once("_inc_footer.php");?>
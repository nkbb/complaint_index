<?php 
$menu_2 = "navbar-active";
include_once("_inc_hearder.php");?>

<div class="container">
    <div id="mainpage">
        <div class="row">
            <div class="title col-md-12 text-center">ข้อมูลการร้องเรียน - ร้องทุกข์</div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel-text-header mb-3">
                    <p>ข้อมูลผู้ร้องเรียน</p>
                </div>
            </div>
        </div>
        <form id="myForm" enctype="multipart/form-data">
            <input type="hidden" name="token" value="<?=$token?>"/>
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
                <label class="col-md-2">ร้องเรียนถึง :</label>
                <div class="col-md-4 form-group mb-0">
                    <select class="form-control" id="office_unit" name="office_unit">
                        <option value="">== ไม่ทราบหน่วยงาน ==</option>
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
                            echo "<option value='".$value["ind"]."'".((isset($_SESSION['complaint_id']) && $_SESSION['complaint_id'] != "" && $_SESSION['complaint_id'] == $value["ind"]) ? " selected" : "").">".($key+1).". ".$value["name"]."</option>";
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
            <!-- <div class="row input-data input-row">
                <label class="col-md-2">สถานที่เกิดเหตุ (ถ้ามี) :</label>
                <div class="col-md-4 form-group mb-0">
                    <input type="text" class="form-control" id="location" name="location">
                </div>
                <label class="col-md-3">วัน เวลาที่เกิดเหตุ (ถ้ามี) :</label>
                <div class="col-md-3 form-group mb-0">
                    <input type="text" class="form-control dateadd" id="location_date" name="location_date" autocomplete="off">
                </div>
            </div> -->
            <input type="hidden" name="location" value=""/>
            <input type="hidden" name="location_date" value=""/>

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
                        <input type="file" class="custom-file-input" accept=".png, .jpg, .jpeg, .pdf, .doc" id="files" name="files" onchange="shownameimg(event)">
                        <label class="custom-file-label" id="filename" for="validatedCustomFile" style="overflow: hidden; white-space: nowrap;">Choose file...</label>
                        <small class="form-text text-muted">กรุณาเลือกไฟล์ word, pdf, หรือรูปภาพ </small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center my-5">
                    <input type="submit" id="btnsubmit" class="btn btn-primary" value="บันทึก">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="showModel"></div>

<script src="<?=base_url()?>../assets/bootstrap/js/sweetalert.min.js"></script>
<link href="<?=base_url()?>../assets/bootstrap/css/sweetalert.css" rel="stylesheet">
<script src="<?=base_url()?>../assets/cleave-master/cleave.min.js"></script>
<script src="<?=base_url()?>../assets/cleave-master/addons/cleave-phone.th.js"></script>
<link href="<?=base_url()?>../assets/icheck-1.x/skins/square/orange.css" rel="stylesheet">
<script src="<?=base_url()?>../assets/icheck-1.x/icheck.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>../assets/datetimepicker-master/jquery.datetimepicker.css" />
<script src="<?=base_url()?>../assets/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>

<script>

jQuery.datetimepicker.setLocale('th');
jQuery('.dateadd').datetimepicker({
    format:'Y-m-d H:i'
});

function shownameimg(event){
    $("#filename").html(event.target.files[0].name);
}


$(document).ready(function() {


    $(".comp_sub").hide();
    
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-orange',
        radioClass: 'iradio_square-orange',
        increaseArea: '20%' // optional
    });

    $("#myForm").bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            fname: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกชื่อ'
                    }
                }
            },
            lname: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกนามสกุล'
                    }
                }
            },
            idcard: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกเลขบัตรประชาชน'
                    }
                }
            },
            address: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกที่อยู่'
                    }
                }
            },
            province: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกจังหวัด'
                    }
                }
            },
            amphur: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกอำเภอ'
                    }
                }
            },
            district: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกตำบล'
                    }
                }
            },
            zipcode: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกรหัสไปรษณีย์'
                    }
                }
            },
            email: {
                validators: {
                    emailAddress: {
                        message: 'รูปแบบอีเมล์ไม่ถูกต้อง'
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
            complaint_person: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาเลือกบุคคลที่ร้องเรียน'
                    }
                }
            },
            name: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกเรื่องที่ร้องเรียน'
                    }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกรายละเอียด'
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
        saveData();
        e.preventDefault()
    });


    var companlaint_id = "<?=(isset($_SESSION['complaint_id']))? $_SESSION['complaint_id'] : '';?>";
    if(companlaint_id != ''){
        selectcomplaint_sub(companlaint_id)
    }

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


function saveData(){
    var form_data = new FormData($("#myForm")[0]);
    var file_data = $('#files').prop('files')[0];   
    form_data.append('file', file_data);

    var URL = "<?=base_url()?>complain/savedata";
    $.ajax({
        type: "POST",
        dataType: "json",
        cache: false,
        contentType: false,
        processData:false,
        url: URL,
        data:form_data,
        success: function(data) {
            if(data.code=="success"){
                $( ".showModel" ).load( "<?php echo base_url() ?>complain/show?token="+data.token);
                $("#btnsubmit").removeAttr("disabled");
            }else{
                if(data.message){
                    swal("แจ้งเตือน!", data.message , "error");
                }else{
                   swal("แจ้งเตือน!", "ผิดพลาด กรุณาลองใหม่อีกครั้ง!", "error"); 
                }
                
                $("#btnsubmit").removeAttr("disabled");
            }
        }
    });
}

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

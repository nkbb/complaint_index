
<?php 


$menu_admin_2 = "active";

include_once("_inc_hearder.php");
?>
<link href="<?=base_url()?>assets/css/style-admin.css" rel="stylesheet">

<div class="container">
    <div class="adminpage">

        <div class="admin-title">
            <i class="far fa-edit"></i> รายละเอียดเรื่องร้องเรียน
            <small class="text-primary"><i class="fas fa-angle-right"></i> แก้ไขข้อร้องเรียน</small>
        </div>

        <div class="row">
            <!-- <div class="col-md-6 offset-md-6" style="margin-bottom: 8px;">
                <span class="results-status type-2">ศูนย์รับเรื่อง</span>
                <span class="results-status type-3">หน่วย รับเรื่อง</span>
                <span class="results-status type-4">หน่วย ดำเนินการ</span>
                <span class="results-status type-5">ศูนย์ยุติ รายงานผู้บริหาร</span>
                <span class="results-status type-6">เสร็จสิ้น</span>
            </div> -->
        </div>
        <div class="admin-bodyqqaze">  
            <form id="myForm" action="<?=base_url()?>complain/update" method="post" enctype="multipart/form-data">  
            <input type="hidden" value="<?=$item['ind']?>" name="ind" > 
                <div class="row">
                    <div class="col-12 view-complain">
                        <div class="pl-5">รหัสเรื่องร้องเรียน : <?=$item['code']?>
                            <!-- <span class="header pl-4">สถานะ :</span> <span class="results-status type-<?=$item['type']?>"><?=$status_name?></span>
                            <div><i class="far fa-clock"></i> <?=$date_add?> <?=$time_add?> น.</div> -->
                        </div>

                        <div class="title-show mt-4">
                            <div class="row pl-4">
                                <div class="col-12 text-center">
                                    ข้อมูลเกี่ยวกับผู้ร้องเรียน
                                </div>
                            </div>
                        </div>

                        <div class="row model-showdata">
                            <label class="col-md-2 mt-2">การเปิดเผย</label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <?php if($item['status'] == 0 ){ ?>
                                    <h4 class="text-success">ไม่ปกปิด ข้อมูลผู้ร้องเรียน</h4>
                                <?php }else{ ?>
                                    <h4 class="text-danger">ปกปิด ข้อมูลผู้ร้องเรียน</h4>
                                <?php }?>
                            </div>
                        </div>

                        <div class="row model-showdata">
                            <label class="col-md-2 mt-2">ชื่อ ผู้ร้องเรียน<span class="input-validation">*</span></label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <input type="text" class="form-control" id="fname" name="fname" value="<?=$item['fname']?>">
                            </div>
                            <label class="col-md-2 mt-2">นามสุกล ผู้ร้องเรียน<span class="input-validation">*</span></label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <input type="text" class="form-control" id="lname" name="lname" value="<?=$item['lname']?>">
                            </div>
                        </div>

                        <div class="row model-showdata">
                            <label class="col-md-2 mt-2">เลขบัตรประชาชน<span class="input-validation">*</span></label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <input type="text" class="form-control cleave-input-idcard" id="idcard" name="idcard" value="<?=$item['idcard']?>">
                            </div>
                            <label class="col-md-2 mt-2">เพศ<span class="input-validation">*</span></label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <select class="form-control" id="sex" name="sex" title="<?=$item['sex']?>">
                                    <option value="1">ชาย</option>
                                    <option value="2">หญิง</option>
                                </select>
                            </div>
                        </div>

                        <div class="row model-showdata">
                            <label class="col-md-2 mt-2">อาชีพ<span class="input-validation">*</span></label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <input type="text" class="form-control seltitle" id="work" name="work" value="<?=$item['work']?>">
                            </div>
                        </div>

                        <div class="row model-showdata">
                            <label class="col-md-2 mt-2">ที่อยู่<span class="input-validation">*</span></label>
                            <div class="col-md-10 form-group mb-0 mt-2">
                                <input type="text" class="form-control" id="address" name="address" value="<?=$item['address']?>">
                            </div>
                        </div>

                        <div class="row model-showdata">
                            <label class="col-md-2 mt-2">จังหวัด<span class="input-validation">*</span></label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <select class="form-control seltitle" name="province" id="province" onchange="selectAmphur(this.value)" title="<?=$item['province']?>">
                                    <option value="">== กรุณาเลือก ==</option>
                                    <?php foreach($province as $key => $value){
                                        echo "<option value='".$value["province_id"]."'>".$value["province_name"]."</option>";
                                    }?>
                                </select>
                            </div>
                            <label class="col-md-2 mt-2">อำเภอ<span class="input-validation">*</span></label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <select class="form-control seltitle" name="amphur" id="amphur" onchange="selectDistrict(this.value)" title="<?=$item['amphur']?>">
                                    <option value="">== กรุณาเลือก ==</option>
                                    <?php foreach($amphur as $key => $value){
                                        echo "<option value='".$value["amphur_id"]."'>".$value["amphur_name"]."</option>";
                                    }?>
                                </select>
                            </div>
                        </div>

                        <div class="row model-showdata">
                            <label class="col-md-2 mt-2">ตำบล<span class="input-validation">*</span></label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <select class="form-control seltitle" name="district" id="district" title="<?=$item['district']?>">
                                    <option value="">== กรุณาเลือก ==</option>
                                    <?php foreach($district as $key => $value){
                                        echo "<option value='".$value["district_id"]."'>".$value["district_name"]."</option>";
                                    }?>
                                </select>
                            </div>
                            <label class="col-md-2 mt-2">รหัสไปรษณี<span class="input-validation">*</span></label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <input type="text" class="form-control" id="zipcode" name="zipcode" value="<?=$item['zipcode']?>">
                            </div>
                        </div>

                        <div class="row model-showdata">
                            <label class="col-md-2 mt-2">โทรศัพท์<span class="input-validation">*</span></label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <input type="text" class="form-control cleave-input-tel" id="tel" name="tel" value="<?=$item['tel']?>">
                            </div>
                            <label class="col-md-2 mt-2">โทรสาร</label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <input type="text" class="form-control cleave-input-fax" id="fax" name="fax" value="<?=$item['fax']?>">
                            </div>
                        </div>

                        <div class="row model-showdata">
                            <label class="col-md-2 mt-2">มือถือ</label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <input type="text" class="form-control cleave-input-phone" id="phone" name="phone" value="<?=$item['phone']?>">
                            </div>
                            <label class="col-md-2 mt-2">Email</label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <input type="text" class="form-control" id="email" name="email" value="<?=$item['email']?>">
                            </div>
                        </div>

                        <div class="title-show mt-4">
                            <div class="row pl-4">
                                <div class="col-12 text-center">
                                    ข้อมูลเกี่ยวกับเรื่องร้องเรียน
                                </div>
                            </div>
                        </div>

                        <div class="row model-showdata">
                            <label class="col-md-2 mt-2">ร้องเรียนถึง<span class="input-validation">*</span></label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <select class="form-control seltitle" id="office_unit" name="office_unit" title="<?=$item['office_unit']?>">
                                    <option value="">== กรุณาเลือกหน่วยงาน ==</option>
                                    <?php foreach($unit as $key => $value){
                                        echo "<option value='".$value["ind"]."'>".$value["name"]."</option>";
                                    }?>
                                </select>
                            </div>
                        </div>

                        <div class="row model-showdata">
                            <label class="col-md-2 mt-2">ประเภทการร้องเรียน<span class="input-validation">*</span></label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <select class="form-control seltitle" id="complaint_type" name="complaint_type" title="<?=$item['complaint_type']?>">
                                    <option value="">== กรุณาเลือก ==</option>
                                    <?php foreach($comp_type as $key => $value){
                                        echo "<option value='".$value["ind"]."'>".($key+1).". ".$value["name"]."</option>";
                                    }?>
                                </select>
                            </div>
                            <label class="col-md-2 mt-2">ประเภทย่อย<span class="input-validation">*</span></label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <select class="form-control seltitle"  id="complaint_sub" name="complaint_sub" title="<?=$item['complaint_sub']?>">
                                    <option value="">== กรุณาเลือก ==</option>
                                    <?php foreach($complaint_sub as $key => $value){
                                        echo "<option value='".$value["ind"]."'>".$value['complaint_type'].".".($key+1)." ".$value["name"]."</option>";
                                    }?>
                                </select>
                            </div>
                        </div>

                        <div class="row model-showdata">
                            <label class="col-md-2 mt-2">ร้องเรียนบุคคล<span class="input-validation">*</span></label>
                            <div class="col-md-3 form-group mb-0 mt-2">
                                <select class="form-control seltitle" id="complaint_person" name="complaint_person" title="<?=$item['complaint_person']?>">
                                    <option value="">== กรุณาเลือก ==</option>
                                    <?php foreach($complaint_person as $key => $value){
                                        echo "<option value='".$value["ind"]."'>".($key+1).". ".$value["name"]."</option>";
                                    }?>
                                </select>
                            </div>
                        </div>

                        <div class="row model-showdata">
                            <label class="col-md-2 mt-2">เรื่องที่ร้องเรียน<span class="input-validation">*</span></label>
                            <div class="col-md-6 form-group mb-0 mt-2">
                                <input type="text" class="form-control" id="name" name="name" value="<?=$item['name']?>">
                            </div>
                        </div>

                        <div class="row model-showdata">
                            <label class="col-md-2 mt-2">รายละเอียดเรื่องที่ร้องเรียน<span class="input-validation">*</span></label>
                            <div class="col-md-6 form-group mb-0 mt-2">
                                <textarea class="form-control" id="description" name="description" rows="6"><?=$item['description']?></textarea>
                            </div>
                        </div>

                        <div class="row model-showdata">
                            <label class="col-md-2 mt-2">สิ่งที่ต้องการให้แก้ไข ปรับปรุง </label>
                            <div class="col-md-6 form-group mb-0 mt-2">
                                <textarea class="form-control" id="improvement" name="improvement" rows="6"><?=$item['improvement']?></textarea>
                            </div>
                        </div>

                        <div class="row model-showdata">
                            <label class="col-md-2 mt-2">เอกสารแนบ </label>
                            <div class="col-md-6 form-group mb-0 mt-2">
                                <?php if($item['files']){
                                    echo "<a href='".base_url()."assets/files/".$item['files']."' target=\"_blank\">".$item['files']."</a>";
                                }else{
                                    echo "<spna class='text-danger'>ไม่มี </spna>";
                                }?>
                            </div>
                        </div>
                    </div>
                            
                    <div class="col-12">
                        <div class="text-center mt-3 mb-4">
                            <input type="submit" id="btnsubmit" class="btn btn-primary" value="บันทึกการแก้ไข">
                            <button onclick="BackPage()" type="button" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> ย้อนกลับ</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="showModel"></div>

<script src="<?=base_url()?>assets/cleave-master/cleave.min.js"></script>
<script src="<?=base_url()?>assets/cleave-master/addons/cleave-phone.th.js"></script>
<link href="<?=base_url()?>assets/icheck-1.x/skins/square/orange.css" rel="stylesheet">
<script src="<?=base_url()?>assets/icheck-1.x/icheck.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/datetimepicker-master/jquery.datetimepicker.css" />
<script src="<?=base_url()?>assets/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
<script>

    jQuery.datetimepicker.setLocale('th');
    jQuery('.dateadd').datetimepicker({
     timepicker:false,
     format:'Y-m-d'
    });

    $(function(){
        initField()
        var sum_complaint = "<?=$item['complaint_sub']?>";
        if(empty(sum_complaint)){
            $(".comp_sub").hide();
            $('#myForm').bootstrapValidator('removeField', 'complaint_sub');
        }
    })

    function initField(){
        $(".seltitle").each(function(){
            var t = this.title;
            if(t == "") return;
            if(typeof t === undefined) return ;
            $(this).val(t);
        })
    }

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



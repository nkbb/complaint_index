
<?php 
$menu_1 = "navbar-active";
include_once("_inc_hearder.php");?>
  <style>
    .question {margin-left:5%;}
    .ques_detail{margin-left:   25px; margin-top: 15px;}
    .ques_choice{ margin-left: 5%;}
    .choice{padding-right: 20px;}
  </style>
  <div class="container mb-5">
    <div class="row">
      <div class="col-sm-12 mt-3">
      <!-- <div class="col-sm-12 bg-white rounded box-shadow mt-5"> -->
        <div class="w-100 mt-5 mb-5 text-center">
          <h2 class="text-title-content m-auto">แบบประเมินความพึงพอใจ สำหรับผู้ใช้บริการ</h2>
        </div>

        <form id="myForm" action="<?=base_url()?>questionnaire/save" method="post">
          <div class="question">
              <h5>ส่วนที่ 1 ข้อมูลของผู้ใช้บริการ</h5>
              <div class="ques_detail">
                1. เพศ
                <div class="ques_choice form-group">
                    <span class="choice">
                      <input class="form-check-input" type="radio" name="sex" id="exampleRadios1" value="1" checked>
                      <label class="form-check-label" for="exampleRadios1">
                       ชาย
                      </label>
                    </span>
                    <span class="choice">
                      <input class="form-check-input" type="radio" name="sex" id="exampleRadios2" value="2">
                      <label class="form-check-label" for="exampleRadios2">
                        หญิง
                      </label>
                    </span>
                </div>
              </div>
              <div class="ques_detail">
                2. อายุ
                <div class="ques_choice">
                  <div class="row input-data input-row">
                    <div class="col-md-2 form-group mb-0">
                        <input type="number" class="form-control" id="age" name="age">
                    </div>
                  </div>
                </div>
              </div>
              <div class="ques_detail">
                3. ระดับการศึกษา
                <div class="ques_choice">
                  <div class="col-md-3 form-group">
                      <select class="form-control" id="qualification" name="qualification">
                          <option value="">== กรุณาเลือก ==</option>
                          <option value="1">ต่ำกว่าปริญญาตรี</option>
                          <option value="2">ปริญญาตรี</option>
                          <option value="3">ปริญญาโท</option>
                          <option value="4">ปริญญาเอก</option>
                      </select>
                  </div>
                </div>
              </div>
              <div class="ques_detail">
                2. อาชีพปัจจุบัน
                <div class="ques_choice row">
                  <div class="col-md-3 form-group">
                    <select class="form-control" id="work" name="work" onchange="selectwork(this.value)">
                          <option value="">== กรุณาเลือก ==</option>
                          <option value="1">รับราชการ</option>
                          <option value="2">พนักงานบริษัท/รัฐวิสาหกิจ</option>
                          <option value="3">ธุรกิจส่วนตัว</option>
                          <option value="4">รับจ้าง</option>
                          <option value="5">นักเรียน/นักศึกษา</option>
                          <option value="6">อื่น ๆ</option>
                    </select>
                  </div>
                  <div class="com-md-1 form-group showsis">
                    โปรดระบุ
                  </div>
                  <div class="com-md-3 form-group showsis">
                    <input type="text" class="form-control" id="work_dis" name="work_dis">
                  </div>
                </div>
              </div>
          </div>
          <div class="question mt-3">
            <h5>ส่วนที่ 2 ความพึงพอใจของผู้ใช้บริการ</h5>
            <?php foreach ($item as $key => $value) { ?>
              <div class="ques_detail">
                <?=$key+1?>. <?=$value['name']?>
                <div class="ques_choice">
                    <span class="choice">
                      <input class="form-check-input" type="radio" name="choice[<?=$value['ind']?>]" id="choice<?=$value['ind']?>1" value="1">
                      <label class="form-check-label" for="choice<?=$value['ind']?>1">
                       ไม่พึงพอใจมาก
                      </label>
                    </span>
                    <span class="choice">
                      <input class="form-check-input" type="radio" name="choice[<?=$value['ind']?>]" id="choice<?=$value['ind']?>2" value="2">
                      <label class="form-check-label" for="choice<?=$value['ind']?>2">
                        ไม่พึงพอใจ
                      </label>
                    </span>
                    <span class="choice">
                      <input class="form-check-input" type="radio" name="choice[<?=$value['ind']?>]" id="choice<?=$value['ind']?>3" value="3">
                      <label class="form-check-label" for="choice<?=$value['ind']?>3">
                        พึงพอใจ
                      </label>
                    </span>
                    <span class="choice">
                      <input class="form-check-input" type="radio" name="choice[<?=$value['ind']?>]" id="choice<?=$value['ind']?>4" value="4">
                      <label class="form-check-label" for="choice<?=$value['ind']?>4">
                        พึงพอใจมาก
                      </label>
                    </span>
                </div>
             </div>
            <?php } ?>
             
          </div>

          <div class="row">
            <div class="col-md-12 text-center mt-5 mb-2">
              <input type="submit" id="btnsubmit" class="btn btn-primary" value="ส่งข้อมูล">
            </div>
          </div>
        </form>
        
      </div>
    </div>
   
  </div>
<link href="<?=base_url()?>assets/icheck-1.x/skins/square/orange.css" rel="stylesheet">
<script src="<?=base_url()?>assets/icheck-1.x/icheck.js"></script>
<script>
  $(document).ready(function() {

    $(".showsis").hide();
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
            // sex: {
            //     validators: {
            //         notEmpty: {
            //             message: 'กรุณาเลือกเพศ'
            //         }
            //     }
            // },
            age: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอก อายุ'
                    }
                }
            },
            qualification: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาเลือก ระดับการศึกษา'
                    }
                }
            },
            work: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาเลือกอาชีพ'
                    }
                }
            }
            
        }
    })
    .on('success.form.bv', function(e) {
        
    });
  })

  function selectwork(type){
    if(type=='6'){
      $(".showsis").show();
      
      $('#myForm')
        .bootstrapValidator('addField', 'work_dis', {
            validators: {
                notEmpty: {
                    message: 'กรุณาระบุ อาชีพ'
                }
            }
        });

    }else{
      $(".showsis").hide();
      $('#myForm').bootstrapValidator('removeField', 'work_dis');
      
    }
  }

  
</script>
<?php include_once("_inc_footer.php");?>


 
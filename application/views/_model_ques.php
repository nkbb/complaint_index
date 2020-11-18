<style>
  .ques-title{
    background: #ee7530;
    color: #FFF;
    padding: 6px 5px 6px 5px;
  }
</style>
<div id="modal" class="modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="color:#ee7530;">แบบประเมินความพึงพอใจ สำหรับผู้ใช้บริการ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="myFormquest">
      <input type="hidden" name="token" id="token">
      <div class="modal-body">

       <small class="text-danger">*กรุณากรอกแบบประเมินความพึงพอใจ เพื่อนำผลไปใช้ในการปรับปรุงการให้บริการ จึงขอความร่วมมือจากทุกท่านที่ใช้งานระบบรับเรื่องร้องเรียน กรมสุขภาพจิต</small>
        <div class="ques-title mb-3 mt-2 pl-3">ส่วนที่ 1 ข้อมูลของผู้ใช้บริการ</div>
        
          <div class="form-group row">
            <label class="col-form-label col-md-2 pl-4">1.  เพศ</label>
              <div class="col-3 pl-5">
                       <input class="form-check-input" type="radio" name="sex" id="exampleRadios1" value="1" checked>
                      <label class="form-check-label" for="exampleRadios1">
                       ชาย
                      </label>
              </div>
              <div class="col-4">
                      <input class="form-check-input" type="radio" name="sex" id="exampleRadios2" value="2">
                      <label class="form-check-label" for="exampleRadios2">
                        หญิง
                      </label>
              </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-3 pl-4">2. อายุ</label>
            <div class="col-4">
              <input type="number" class="form-control" id="age" name="age">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-5 pl-4">3. ระดับการศึกษา</label>
            <div class="col-md-12 pl-5">
              <select class="form-control" id="qualification" name="qualification">
                <option value="">== กรุณาเลือก ==</option>
                <option value="1">ต่ำกว่าปริญญาตรี</option>
                <option value="2">ปริญญาตรี</option>
                <option value="3">ปริญญาโท</option>
                <option value="4">ปริญญาเอก</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-5 pl-4">2. อาชีพปัจจุบัน</label>
            <div class="col-md-12 pl-5">
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
          </div>
          <div class="form-group row showsis" style="margin-top: -18px;">
            <label class="col-form-label col-md-5 pl-5">โปรดระบุ</label>
            <div class="col-md-12 pl-5">
              <input type="text" class="form-control" id="work_dis" name="work_dis">
            </div>
          </div>

          <div class="ques-title mt-5 pl-3">ส่วนที่ 2 ความพึงพอใจของผู้ใช้บริการ</div>
           <?php foreach ($item as $key => $value) { ?>
            <div class="pl-4 mt-3"><?=$key+1?>. <?=$value['name']?></div>
              <div class="form-group row">
                <div class="col-md-6 col-6" style="padding-left: 20%">
                  <input class="form-check-input" type="radio" name="choice[<?=$value['ind']?>]" id="choice<?=$value['ind']?>1" value="1" checked>
                  <label class="form-check-label" for="choice<?=$value['ind']?>1">
                  ไม่พึงพอใจ
                  </label>
                </div>
                <div class="col-md-6 col-6 pl-5">
                  <input class="form-check-input" type="radio" name="choice[<?=$value['ind']?>]" id="choice<?=$value['ind']?>2" value="2" checked>
                  <label class="form-check-label" for="choice<?=$value['ind']?>2">
                  พึงพอใจ
                  </label>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6 col-6" style="padding-left: 20%">
                  <input class="form-check-input" type="radio" name="choice[<?=$value['ind']?>]" id="choice<?=$value['ind']?>3" value="3" checked>
                  <label class="form-check-label" for="choice<?=$value['ind']?>3">
                  พึงพอใจมาก
                  </label>
                </div>
                <!-- <div class="col-md-6 pl-5">
                  <input class="form-check-input" type="radio" name="choice[<?=$value['ind']?>]" id="choice<?=$value['ind']?>4" value="4">
                  <label class="form-check-label" for="choice<?=$value['ind']?>4">
                    พึงพอใจมาก
                  </label>
                </div> -->
              </div>
           <?php }?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <input type="submit" id="btnsubmit" class="btn btn-primary" value="ส่งข้อมูล">
      </div>
    </form>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    $(".showsis").hide();

    $('#modal').modal('show');

    $('input').iCheck({
        checkboxClass: 'icheckbox_square-orange',
        radioClass: 'iradio_square-orange',
        increaseArea: '20%' // optional
    });

    $("#myFormquest").bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
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
      saveData();
      e.preventDefault()
    });

  });

  function saveData(){
    var form_data = new FormData($("#myFormquest")[0]);
    var type = "<?=$type?>";
    var URL = "<?=base_url()?>questionnaire/saveques";
    $.ajax({
        type: "POST",
        dataType: "html",
        cache: false,
        contentType: false,
        processData:false,
        url: URL,
        data:form_data,
        success: function(data) {

            if(type == 'finish'){
              $('#modal').modal('hide');
              $(".show-ques").show();
            }else{
              location.href = "<?=base_url()?>questionnaire/finish";

            }
        }
    });
  }

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
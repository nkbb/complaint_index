<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ตอบ-แก้ไข ข้อร้องเรียน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="myfrmanswer" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="model-title">ข้อมูลเกี่ยวกับผู้ร้องเรียน</div>
        <?php if($status==1){?>
        <div class="row modal-concealed">
            <div class="col-md-12 text-center">
                ปกปิดข้อมูล ผู้ร้องเรียน
            </div>
        </div>
        <?php }else{?>
        <div class="row model-showdata">
            <label class="col-md-2">ชื่อ-นามสกุล<span class="input-validation">*</span></label>
            <div class="col-md-9 model-detail"><?=$fname?> <?=$lname?></div>
        </div>
        <div class="row model-showdata">
            <label class="col-md-2">เพศ<span class="input-validation">*</span> :</label>
            <div class="col-md-9 model-detail"><?php if($sex==1){ echo "ชาย"; }else if($sex==2){ echo"หญิง";} ?></div>
        </div>
        <div class="row model-showdata">
            <label class="col-md-2">รหัสประจำตัวประชาชน<span class="input-validation">*</span> :</label>
            <div class="col-md-9 model-detail"><?=$idcard?></div>
        </div>
        <div class="row model-showdata">
            <label class="col-md-2">อาชีพ<span class="input-validation">*</span> :</label>
            <div class="col-md-9 model-detail"><?=$work?></div>
        </div>
        <div class="row model-showdata">
            <label class="col-md-2">ที่อยู่<span class="input-validation">*</span> :</label>
            <div class="col-md-10 model-detail"><?=$address?> <?=$addressfull?></div>
        </div>
        <div class="row model-showdata">
            <label class="col-md-2">เบอร์โทร :</label>
            <div class="col-md-3 model-detail"><?=$tel?></div>
            <label class="col-md-3">เบอร์โทรศัพท์ :</label>
            <div class="col-md-4 model-detail"><?=$phone?></div>
        </div>
        <div class="row model-showdata">
            <label class="col-md-2">Email :</label>
            <div class="col-md-10 model-detail"><?=$email?></div>
        </div>
        <?php }?>
        <div class="model-title">ข้อมูลเกี่ยวกับเรื่องร้องเรียน</div>
        <div class="row model-showdata">
            <label class="col-md-2">ร้องเรียนถึง :</label>
            <div class="col-md-10 model-detail"><?=$office_name?></div>
        </div>
        <div class="row model-showdata">
            <label class="col-md-2">ประเภทเรื่องร้องเรียน :</label>
            <div class="col-md-10 model-detail"><?=$complain_type?></div>
        </div>
        <?php if($type > 1){?>
        <div class="row model-showdata">
            <label class="col-md-2">วันที่ร้องเรียน :</label>
            <div class="col-md-10 model-detail"><?=$show_date_add?></div>
        </div>
        <?php }?>
        <div class="row model-showdata">
            <label class="col-md-2">หัวข้อเรื่องร้องเรียน :</label>
            <div class="col-md-10 model-detail"><?=$name?></div>
        </div>
        <div class="row model-showdata">
            <label class="col-md-2">รายละเอียดเรื่องร้องเรียน :</label>
            <div class="col-md-10 model-detail"><?=$description?></div>
        </div>
        <div class="row model-showdata">
            <label class="col-md-2">สิ่งที่ต้องการแก้ไข :</label>
            <div class="col-md-10 model-detail"><?=$improvement?></div>
        </div>


        
        <div class="model-title" style="background:#dc3545;">ตอบ-แก้ไขข้อร้องเรียน</div>
    
            <input type="hidden" name="token" value="<?=$token?>">
            <input type="hidden" name="type" value="5" > 

            <div class="row model-showdata form-group">
                <label class="col-md-2">รายละเอียดการตอบ-แก้ไข ข้อร้องเรียน :</label>
                <div class="col-md-10 model-detail">
                    <textarea class="form-control" id="answer_detail" name="answer_detail" rows="3"></textarea>
                </div>
            </div>
            <div class="row model-showdata">
                <label class="col-md-2">เอกสารแนบ (ถ้ามี) :</label>
                <div class="col-md-6 model-detail">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" onchange="shownameimg(event)" accept=".png, .jpg, .jpeg, .pdf, .doc" id="files" name="files" >
                        <label class="custom-file-label" id="filename" for="validatedCustomFile" style="overflow: hidden; white-space: nowrap;">Choose file...</label>
                        <small class="form-text text-muted">กรุณาเลือกไฟล์ word, pdf, หรือรูปภาพ </small>
                    </div>
                </div>
            </div>
          </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <input type="submit" id="btnsubmit" class="btn btn-success" value="บันทึกการตอบ-แก้ไข ข้อร้องเรียน">
      </div>

      </form>
    </div>
  </div>
</div>

<script>

function shownameimg(event){
    $("#filename").html(event.target.files[0].name);
}


$(function(){
    $('#myModal').modal('show');  
})

$(document).ready(function() {
    $("#myfrmanswer").bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },fields: {
            answer_detail: {
                validators: {
                    notEmpty: {
                        message: 'กรุณา กรอกรายละเอียดการแก้ไข-ตอบข้อร้องเรียน'
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
        saveanswer();
        e.preventDefault()
    });
});

function saveanswer(){

    var r = confirm("ยืนยันการ ตอบ-แก้ไขข้อร้องเรียน ! \nรายละเอียดข้างต้นจะนำไปแสดง ต่อผู้ร้องเรียน...");
    if (r == true) {
        var form_data = new FormData($("#myfrmanswer")[0]);
        var file_data = $('#files').prop('files')[0];   
        form_data.append('file', file_data);
    
        var URL ="<?=base_url()?>manage/saveanswer";
        $.ajax({
            type: "POST",
            dataType: "json",
            cache: false,
            contentType: false,
            processData:false,
            url: URL,
            data:form_data,
            success: function(data) {
                $('#myModal').modal('hide');  
                if(data.code=='success'){
                    swal("success!", "ตอบ-แก้ไขข้อร้องเรียนแล้ว กรุณารอศูนย์รับเรื่องร้องเรียน อนุมัติ...", "success");
                    searchData();
                }else{
                    swal("success!", "ผิดพลาด กรุณาลอกใหม่.", "error");
                }
            }
        });
    }
      
    
}

</script>
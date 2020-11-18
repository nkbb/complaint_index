<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">รายละเอียด การร้องเรียน-ร้องทุกข์</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-3 offset-md-9 text-center mb-2">
                <button type="button" onclick="print_complaint('<?=$code?>')" class="btn btn-success"><i class="fas fa-print"></i> พิมพ์</button>
            </div>
        </div>

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
        <div class="row model-showdata">
            <label class="col-md-2">หัวข้อเรื่องร้องเรียน :</label>
            <div class="col-md-10 model-detail"><?=$name?></div>
        </div>
        <?php if($type > 1){?>
        <div class="row model-showdata">
            <label class="col-md-2">วันที่ร้องเรียน :</label>
            <div class="col-md-10 model-detail"><?=$show_date_add?></div>
        </div>
        <?php }?>

        <div class="row model-showdata">
            <label class="col-md-2">รายละเอียดเรื่องร้องเรียน :</label>
            <div class="col-md-10 model-detail"><?=$description?></div>
        </div>
        <div class="row model-showdata">
            <label class="col-md-2">สิ่งที่ต้องการแก้ไข :</label>
            <div class="col-md-10 model-detail"><?=$improvement?></div>
        </div>
        <div class="row model-showdata">
            <label class="col-md-2">เอกสารประกอบ :</label>
            <div class="col-md-10 model-detail">
                <?php if($files){
                    echo "<a href='".base_url()."assets/files/".$files."' target=\"_blank\">".$files."</a>";
                }else{
                    echo "<spna class='text-danger'>ไม่มี </spna>";
                }?>
            </div>
        </div>
        
        <?php if($type > 3){?>
        <div class="model-title" style="background:#dc3545;">ตอบ-แก้ไขข้อร้องเรียน</div>
        
        <?php if($type == 4){
            ?>
            <div class="row model-showdata">
                <div class="col-md-12 text-center">
                    <h4 class="text-danger mt-3">รอหน่วยดำเนินการ ตอบ-แก้ไขข้อร้องเรียน</h4>
                    <small>*กรุณาดำเนินการแก้ไขข้อร้องเรียน  และตอบข้องร้องเรียน ที่แถบ"ดำเนินการ" คลิกปุ่ม <i class="far fa-check-circle" style="font-size: 22px; color:#28a745;"></i></small>
                </div>
            </div>
            <?php if($comment){?>
            <div class="row mt-3 ml-5">
                <div style="color: #EE7530;">สถานะหน่วยดำเนินงาน</div>
                <div class="col-md-12">
                    <div class="timeline">
                        <ul>
                            <?php foreach ($comment as $key => $value) { ?>
                            <li>
                                <div class="bullet pink"></div>
                                <div class="time"><?=$value["date_ask"]?></div>
                                <div class="desc">
                                  <h3>ติดตาม : <?=$value["ask_unit"]?></h3>
                                  <h3>หน่วย ตอบ : <?php if($value["comment_unit"]){ echo $value["comment_unit"]; }else{ echo "<spna class='text-danger'>ยังไม่ตอบ</span>"; }?></h3>
                                </div>
                            </li>
                            <?php }?>
                        </ul>
                    </div>  
                </div>
            </div>
            <?php }?>

        <?php }else{ ?>


        <div class="row model-showdata">
            <label class="col-md-2">ข้อความการตอบ-แก้ไข ข้อร้องเรียน :</label>
            <div class="col-md-10 model-detail"><?=$answer_detail?></div>
        </div>
        <div class="row model-showdata">
            <label class="col-md-2">ไฟล์เอกสารแนบ :</label>
            <div class="col-md-10 model-detail">
                <?php if($answer_file){
                    echo "<a href='".base_url()."assets/files/".$answer_file."' target=\"_blank\">".$answer_file."</a>";
                }else{
                    echo "<spna class='text-danger'>ไม่มี </spna>";
                }?>
            </div>
        </div>
        <div class="row model-showdata">
            <label class="col-md-2">วันที่ดำเนินการ :</label>
            <div class="col-md-10 model-detail"><?=$show_date_answer?></div>
        </div>
        <?php 
            }
        }?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
    $('#myModal').modal('show');  
})


</script>
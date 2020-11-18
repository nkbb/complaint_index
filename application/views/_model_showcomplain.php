<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ยืนยัน การร้องเรียน-ร้องทุกข์</h5>
        
      </div>
      <div class="modal-body">
        <div class="model-title">ข้อมูลเกี่ยวกับผู้ร้องเรียน</div>
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

        <div class="model-title">ข้อมูลเกี่ยวกับเรื่องร้องเรียน</div>
        <div class="row model-showdata">
            <label class="col-md-2">ร้องเรียนถึง :</label>
            <div class="col-md-10 model-detail"><?=$office_name?></div>
        </div>
        <div class="row model-showdata">
            <label class="col-md-2">ประเภทเรื่องร้องเรียน :</label>
            <div class="col-md-10 model-detail"><?=$complain_type?> <?php if($complain_sub){ echo "(".$complain_sub.")"; }?></div>
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

      </div>
      <form id="myformaccept" action="<?=base_url()?>complain/accept" method="post">
        <input type="hidden" name="token" value="<?=$token?>"/>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">แก้ไข</button>
        <button type="button" onclick="accept()" class="btn btn-success">ยืนยันข้อมูลถูกต้อง</button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
    $('#myModal').modal('show');  
})

function accept(){
    $("#myformaccept").submit();
}
</script>
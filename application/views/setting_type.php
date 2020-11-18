<?php 
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>assets/css/style-admin.css" rel="stylesheet">


<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="fas fa-layer-group"></i> ประเภทการร้องเรียน</div>
    <div class="admin-body">
        <table class="table table-bordered table-hover" id="myTable"  style="font-size:14px;">
            <thead>
                <tr>
                    <th width="10%" class="text-center" scope="col">ข้อ</th>
                    <th width="60%" class="text-center" scope="col">ประเภท</th>
                    <th width="20%" class="text-center" scope="col">ระยะเวลาดำเนินการ (ภายใน)</th>
                    <?php if($this->session->userdata('level')== "root"){?>
                    <th width="15%" class="text-center" scope="col">จัดการ</th>
                    <?php }?>
                </tr>
            </thead>
            <tbody>
                <?php if($item){
                    $cc = count($item);
                }else{
                    $cc = 0;
                }

                for($i=0; $i<$cc; $i++){
                ?>

                    <tr>
                        <td class="text-center"><?=$i+1;?></td>
                        <td><?=$item[$i]['name']?></td>
                        <td class="text-center"><?php if($item[$i]['type'] != '2'){ echo $item[$i]['time_span']." วัน"; }?></td>
                        <?php if($this->session->userdata('level')== "root"){?>
                        <td class="text-center">
                            <?php if($item[$i]['type'] != 2){?>
                                <a href="javascript:edittime('type','<?=$item[$i]['ind']?>','<?=$item[$i]['time_span']?>')" data-toggle="tooltip" data-placement="top" title="แก้ไข จำนวนวัน"><i class="far fa-edit"></i></a>
                            <?php }?>
                        </td>
                        <?php }?>
                    </tr>
                    <?php
                    if($item[$i]['type'] == 2){
                        foreach ($item[$i]['sub'] as $key => $value) {
                    ?>
                    <tr>
                        <td></td>
                        <td><?=$i+1?>.<?=$value['num']?> <?=$value["name"]?></td>
                        <td class="text-center"><?=$value["time_span"]?> วัน</td>
                        <td class="text-center">
                            <a href="javascript:edittime('sub','<?=$value["ind"]?>','<?=$value["time_span"]?>')" data-toggle="tooltip" data-placement="top" title="แก้ไข จำนวนวัน"><i class="far fa-edit"></i></a>
                        </td>
                    </tr>
                    
                    <?php }

                    } ?>

                <?php }?>
            </tbody>
        </table>   
    </div>
  </div>
 
</div>


<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">แก้ไข ระยะเวลาดำเนินการ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="myForm" action="<?=base_url()?>setting/complaint_typesave" method="post">
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="type" id="type">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">ระยะเวลา :</label>
            <input type="number" class="form-control" name="time_span" id="time_span">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <button type="button" onclick="saveData()" class="btn btn-primary">บันทึก</button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
    $('[data-toggle="tooltip"]').tooltip();
})

function edittime(type,id,time){
    $('.modal').modal('show');
    $("#time_span").val(time);
    $("#type").val(type);
    $("#id").val(id);
}

function saveData(){
    $("#myForm").submit();
}
</script>

<?php include_once("_inc_footer.php");?>

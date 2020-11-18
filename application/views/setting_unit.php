<?php 
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="fas fa-university"></i> หน่วยในสังกัด</div>
    <div class="admin-body">
        <?php if($this->session->userdata('level')== "root"){?>
            <a href="<?=base_url()?>setting/unit_create" style="  margin-left: 50px; margin-bottom:20px;" class="btn btn-outline-danger"><i class="fas fa-plus"></i> เพิ่มหน่วย</a>
        <?php }?>

        <table class="table table-bordered table-hover" id="myTable"  style="font-size:14px;">
            <thead>
                <tr>
                    <th width="10%" class="text-center" scope="col">ลำดับ</th>
                    <th width="60%" class="text-center" scope="col">ชื่อหน่วย</th>
                    <th width="15%" class="text-center" scope="col">ชื่อย่อ</th>
                    <th width="20%" class="text-center" scope="col">พื้นที่</th>
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
                        <td><?=$item[$i]['short_name']?></td>
                        <td><?php if($item[$i]['area']==1){ echo "ส่วนกลาง"; } else if($item[$i]['area']=="2"){ echo "หน่วยบริการ";} else if($item[$i]["area"]=="3"){ echo "ศูนย์สุขภาพจิต";}?></td>
                        <?php if($this->session->userdata('level')== "root"){?>
                        <td class="text-center">
                            <a href="<?=base_url()?>setting/unit_edit?token=<?=$item[$i]['token']?>" data-toggle="tooltip" data-placement="top" title="แก้ไข"><i class="far fa-edit"></i></a>
                            <a  href="<?=base_url()?>setting/unit_delete?token=<?=$item[$i]['token']?>" onClick="javascript:return confirm('คุณต้องการลบข้อมูลใช่หรือไม่');" data-toggle="tooltip" data-placement="top" title="ลบ"><i class="far fa-trash-alt"></i></a>
                        </td>
                        <?php }?>
                    </tr>

                <?php }?>
            </tbody>
        </table>   
    </div>
  </div>
 
</div>

<script>
$(function(){
    $('[data-toggle="tooltip"]').tooltip();
})

function nextpage(){
    var accept = $("#accept").prop( "checked" );
    if(accept === false){
        swal("แจ้งเตือน", "กรุณาอ่านข้อตกลงหลักเกณฑ์ เรื่องร้องเรียน!", "error")
    }else if(accept === true){
        $("#frmaccept").submit();
    }
}
</script>

<?php include_once("_inc_footer.php");?>

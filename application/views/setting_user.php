<?php 
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="far fa-user"></i> ผู้ใช้งาน</div>
    <div class="admin-body">
      	<?php if($this->session->userdata('level')== "root"){?>
            <a href="<?=base_url()?>setting/user_create" style="  margin-left: 50px; margin-bottom:20px;" class="btn btn-outline-success"><i class="fas fa-plus"></i> เพิ่มผู้ใช้งาน</a>
        <?php }?>

        <table class="table table-bordered table-hover" id="myTable"  style="font-size:14px;">
            <thead>
                <tr>
                    <th width="10%" class="text-center" scope="col">ลำดับ</th>
                    <th width="15%" class="text-center" scope="col">ID</th>
                    <th width="30%" class="text-center" scope="col">ผู้รับผิดชอบ</th>
                    <th width="15%" class="text-center" scope="col">ระดับ</th>
                    <th width="15%" class="text-center" scope="col">หน่วย</th>
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
                        <td><?=$item[$i]['id']?></td>
                        <td><?=$item[$i]['auth_fname']?> <?=$item[$i]['auth_lname']?></td>
                        <td><?php if($item[$i]['level'] == 'admin'){ echo "ศูนย์ร้องเรียน/ส่วนกลาง"; } else if( $item[$i]["level"] == "user"){ echo "หน่วย";}?></td>
                        <td><?=$item[$i]['show_unit']?></td>
                        <?php if($this->session->userdata('level')== "root"){?>
                        <td class="text-center">
                            <a href="<?=base_url()?>setting/user_edit?token=<?=$item[$i]['token']?>" data-toggle="tooltip" data-placement="top" title="แก้ไข"><i class="far fa-edit"></i></a>
                            <a  href="<?=base_url()?>setting/user_delete?token=<?=$item[$i]['token']?>" onClick="javascript:return confirm('คุณต้องการลบข้อมูลใช่หรือไม่');" data-toggle="tooltip" data-placement="top" title="ลบ"><i class="far fa-trash-alt"></i></a>
                        </td>
                        <?php }?>
                    </tr>

                <?php }?>
            </tbody>
        </table>   
    </div>
  </div>
 
</div>

<?php include_once("_inc_footer.php");?>
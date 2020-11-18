<?php 
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>assets/css/style-admin.css" rel="stylesheet">
<style>
	.fa-chevron-circle-up, .fa-chevron-circle-down{
		color: #20c997;
		font-size: 20px;
	}
</style>

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="far fa-clipboard"></i> ตั้งค่า แบบประเมินความพึงพอใจ</div>
    <div class="admin-body">

    	<?php if($this->session->userdata('level')== "root"){?>
            <a href="<?=base_url()?>setting/question_create" style="  margin-left: 50px; margin-bottom:20px;" class="btn btn-outline-success"><i class="fas fa-plus"></i> เพิ่มหัวข้อ</a>
        <?php }?>

        <table class="table table-bordered table-hover" id="myTable"  style="font-size:14px;">
            <thead>
                <tr>
                    <th width="10%" class="text-center" scope="col">ข้อ</th>
                    <th width="60%" class="text-center" scope="col">หัวข้อ</th>
                    <th width="15%" class="text-center" scope="col">ลำดับ</th>
                    <th width="15%" class="text-center" scope="col">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($item)){
                    $cc = count($item);
                }else{
                    $cc = 0;
                }

                for($i=0; $i<$cc; $i++){
                ?>

                    <tr>
                        <td class="text-center"><?=$i+1;?></td>
                        <td><?=$item[$i]['name']?></td>
                        <td class="text-center">
                        	<?php if( $i != 0){ ?>
                        		<a href="<?=base_url()?>setting/question_order/up?id=<?=$item[$i]['ind']?>&order=<?=$item[$i-1]['orders']?>&re_id=<?=$item[$i-1]['ind']?>&re_order=<?=$item[$i]['orders']?>" data-toggle="tooltip" data-placement="top" title="เลื่อนขึ้น"><i class="fas fa-chevron-circle-up"></i></a>
                        	<?php } ?>
                        	
                        	<?php if($i+1 != $cc ){ ?>
                        		<a href="<?=base_url()?>setting/question_order/down?id=<?=$item[$i]['ind']?>&order=<?=$item[$i+1]['orders']?>&re_id=<?=$item[$i+1]['ind']?>&re_order=<?=$item[$i]['orders']?>" data-toggle="tooltip" data-placement="top" title="เลื่อนลง"><i class="fas fa-chevron-circle-down"></i></a>
                        	<?php } ?>
                        </td>
                        <td class="text-center">
                        	<a href="<?=base_url()?>setting/question_edit/<?=$item[$i]['ind']?>" data-toggle="tooltip" data-placement="top" title="แก้ไข"><i class="far fa-edit"></i></a>
                            <a  href="<?=base_url()?>setting/question_delete/<?=$item[$i]['ind']?>" onClick="javascript:return confirm('คุณต้องการลบข้อมูลใช่หรือไม่');" data-toggle="tooltip" data-placement="top" title="ลบ"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    
                    <?php 

                     ?>

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

</script>

<?php include_once("_inc_footer.php");?>

<?php 
$menu_admin_10 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="far fa-images"></i> ภาพสไลด์ (หน้าแรก)</div>
    <div class="admin-body">

    	<?php if($this->session->userdata('level')== "root"){?>
            <a href="<?=base_url()?>setting/slide_create" style="  margin-left: 50px; margin-bottom:20px;" class="btn btn-outline-danger"><i class="fas fa-plus"></i> เพิ่มรูปภาพ</a>
        <?php }?>


        <table class="table table-bordered mb-5" id="myTable"  style="font-size:14px;">
            <thead>
                <tr class="">
                    <th width="10%" class="text-center" scope="col">ลำดับ</th>
                    <th width="60%" class="text-center" scope="col">รูปภาพ</th>
                    <th width="20%" class="text-center" scope="col">สถานะ</th>
                    <th width="10%" class="text-center" scope="col">ลบ</th>
                </tr>
            </thead>
            <tbody>
            	<?php 
            	$i = 1;
            	foreach ($item as $key => $value) {
            	?>
            	<tr>
            		<td class="text-center"><?=$i?></td>
            		<td class="text-center">
            			<img class="d-block w-100" style="height: 150px;" alt="img" src="<?=base_url()?>assets/images/slide/<?=$value['url']?>">
            		</td>
            		<td class="text-center">
            			<?php if($value['status'] == 1){?>
            				<a href="<?=base_url()?>setting/slide_status?id=<?=$value['ind']?>&status=0" class="btn btn-outline-success">ใช้งาน</a>
            			<?php }else{?>
            				<a href="<?=base_url()?>setting/slide_status?id=<?=$value['ind']?>&status=1" class="btn btn-outline-danger">ปิดใช้งาน</a>
            			<?php }?>

            		</td>
            		<td class="text-center">
            			<a  href="<?=base_url()?>setting/slide_delete?id=<?=$value['ind']?>" onClick="javascript:return confirm('คุณต้องการลบข้อมูลใช่หรือไม่');" data-toggle="tooltip" data-placement="top" title="ลบ"><i class="far fa-trash-alt"></i></a>
            		</td>
            	</tr>
            		
            	<?php 
            	$i++;
            	}?>
            </tbody>
        </table>
           
    </div>
  </div>
 
</div>

<?php include_once("_inc_footer.php");?>
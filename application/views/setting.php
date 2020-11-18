<?php 
$menu_admin_10 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="fas fa-cog"></i> ตั้งค่า</div>
    <div class="admin-body">
    	<?php if($this->session->userdata('level')== "root"){?>
    	<div class="setting-menu mt-4">
    		<div class="row">
    			<div class="col-lg-2 col-md-4 col-xs-6">
    			 	<a href="<?=base_url()?>setting/unit">
		              <div class="small-box bg-aqua">
		                <div class="inner text-center">
		                  <h3><i class="fas fa-university"></i></h3>
		                  <p>หน่วยในสังกัด</p>
		                </div>
		                <div class="small-box-footer"></div>
		              </div>
		          	</a>
	            </div>
	            <div class="col-lg-2 col-md-4 col-xs-6">
    			 	<a href="<?=base_url()?>setting/user">
		              <div class="small-box bg-aqua">
		                <div class="inner text-center">
		                  <h3><i class="far fa-user"></i></h3>
		                  <p>ผู้ใช้งาน</p>
		                </div>
		                <div class="small-box-footer"></div>
		              </div>
		          	</a>
	            </div>
	            <div class="col-lg-2 col-md-4 col-xs-6">
    			 	<a href="<?=base_url()?>setting/line">
		              <div class="small-box bg-aqua">
		                <div class="inner text-center">
		                  <h3><i class="fab fa-line"></i></h3>
		                  <p>Line กลุ่ม</p>
		                </div>
		                <div class="small-box-footer"></div>
		              </div>
		          	</a>
	            </div>
	            <div class="col-lg-2 col-md-4 col-xs-6">
    			 	<a href="<?=base_url()?>setting/question">
		              <div class="small-box bg-aqua">
		                <div class="inner text-center">
		                  <h3><i class="far fa-clipboard"></i></h3>
		                  <p>แบบประเมินความพึงพอใจ</p>
		                </div>
		                <div class="small-box-footer"></div>
		              </div>
		          	</a>
	            </div>
	            <div class="col-lg-2 col-md-4 col-xs-6">
    			 	<a href="<?=base_url()?>setting/complaint_type">
		              <div class="small-box bg-aqua">
		                <div class="inner text-center">
		                  <h3><i class="fas fa-layer-group"></i></h3>
		                  <p>ประเภทการร้องเรียน</p>
		                </div>
		                <div class="small-box-footer"></div>
		              </div>
		          	</a>
	            </div>
	            <div class="col-lg-2 col-md-4 col-xs-6">
    			 	<a href="<?=base_url()?>setting/timefinish">
		              <div class="small-box bg-aqua">
		                <div class="inner text-center">
		                  <h3><i class="far fa-calendar-minus"></i></h3>
		                  <p>ตั้งค่าเวลา ดำเนินการ </p>
		                </div>
		                <div class="small-box-footer"></div>
		              </div>
		          	</a>
	            </div>
	            <div class="col-lg-2 col-md-4 col-xs-6">
    			 	<a href="<?=base_url()?>setting/complaint">
		              <div class="small-box bg-aqua">
		                <div class="inner text-center">
		                  <h3><i class="fas fa-cog"></i></h3>
		                  <p>หลักเกณฑ์ การร้องเรียน</p>
		                </div>
		                <div class="small-box-footer"></div>
		              </div>
		          	</a>
				</div>
				
				<div class="col-lg-2 col-md-4 col-xs-6">
    			 	<a href="<?=base_url()?>setting/method_type">
		              <div class="small-box bg-aqua">
		                <div class="inner text-center">
		                  <h3><i class="fas fa-cog"></i></h3>
		                  <p>ประเภทการแจ้งเรื่องร้องเรียน</p>
		                </div>
		                <div class="small-box-footer"></div>
		              </div>
		          	</a>
				</div>
				
				<div class="col-lg-2 col-md-4 col-xs-6">
    			 	<a href="<?=base_url()?>setting/person_type">
		              <div class="small-box bg-aqua">
		                <div class="inner text-center">
		                  <h3><i class="fas fa-cog"></i></h3>
		                  <p>บุคคุลที่ถูกร้องเรียน</p>
		                </div>
		                <div class="small-box-footer"></div>
		              </div>
		          	</a>
	            </div>

	             <div class="col-lg-2 col-md-4 col-xs-6">
    			 	<a href="javascript:showmaual('admin')">
		              <div class="small-box bg-aqua">
		                <div class="inner text-center">
		                  <h3><i class="fas fa-book"></i></h3>
		                  <p>คู่มือการใช้งาน</p>
		                </div>
		                <div class="small-box-footer"></div>
		              </div>
		          	</a>
	            </div>
    		</div>
    	</div>
    	<?php }?>
    </div>
  </div>
 
</div>


<?php include_once("_inc_footer.php");?>
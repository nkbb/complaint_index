<?php 
$menu_admin_6 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="fas fa-chart-bar"></i> รายงาน</div>
    <div class="admin-body">

    	<div class="setting-menu mt-4">
    		<div class="row">
    			<div class="col-lg-2 col-md-4 col-xs-6">
    			 	<a href="<?=base_url()?>report/method">
		              <div class="small-box bg-aqua">
		                <div class="inner text-center">
		                  <p>รายงานแบ่งตามประเภทข้อร้องเรียน</p>
		                </div>
		                <div class="small-box-footer"></div>
		              </div>
		          	</a>
	            </div>
	            <div class="col-lg-2 col-md-4 col-xs-6">
    			 	<a href="<?=base_url()?>report/office">
		              <div class="small-box bg-aqua">
		                <div class="inner text-center">
		                  <p>รายงานแบ่งตามหน่วยงานรับผิดชอบ</p>
		                </div>
		                <div class="small-box-footer"></div>
		              </div>
		          	</a>
	            </div>
				<div class="col-lg-2 col-md-4 col-xs-6">
    			 	<a href="<?=base_url()?>report/excel">
		              <div class="small-box bg-aqua">
		                <div class="inner text-center">
		                  <h3><i class="far fa-file-excel"></i></h3>
		                  <p>ส่งออก Excel รายการร้องเรียน</p>
		                </div>
		                <div class="small-box-footer"></div>
		              </div>
		          	</a>
	            </div>	
	            <div class="col-lg-2 col-md-4 col-xs-6">
    			 	<a href="<?=base_url()?>questionnaire">
		              <div class="small-box bg-aqua">
		                <div class="inner text-center">
		                  <h3><i class="fas fa-comment-dots"></i></h3>
		                  <p>แบบประเมินความพึงพอใจ</p>
		                </div>
		                <div class="small-box-footer"></div>
		              </div>
		          	</a>
	            </div>
	            <div class="col-lg-2 col-md-4 col-xs-6">
    			 	<a href="<?=base_url()?>setting/history">
		              <div class="small-box bg-aqua">
		                <div class="inner text-center">
		                  <h3><i class="fas fa-chart-line"></i></h3>
		                  <p>สถิติผู้เข้าชม</p>
		                </div>
		                <div class="small-box-footer"></div>
		              </div>
		          	</a>
	            </div>
	           
	        </div>
	    </div>
      
    </div>
  </div>
 
</div>

<?php include_once("_inc_footer.php");?>
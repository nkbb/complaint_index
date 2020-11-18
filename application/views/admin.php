<?php 
$menu_admin_1 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="fas fa-home"></i> หน้าหลัก</div>
    <div class="admin-body">
		<div>
	    	<div class="row">
	    		<?php if($this->session->userdata('level') == "root" || $this->session->userdata('level')=="admin"){?>
	            <div class="col-lg-3 col-md-6 col-xs-6">
	              <!-- small box -->
	              <div class="small-box bg-aqua" style="color:#fff; background-color: #00c0ef;">
	                <div class="inner">
	                  <h3><?=number_format($count_type2)?></h3>
	                  <p>ศูนย์เรื่องร้องเรียน</p>
	                </div>
	                <div class="icon">
	                  <i class="far fa-paper-plane"></i>
	                </div>
	                <a href="<?=base_url()?>manage/accept" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
	              </div>
	            </div><!-- ./col -->
	            <div class="col-lg-3 col-md-6 col-xs-6">
	              <!-- small box -->
	              <div class="small-box" style="color:#fff; background-color: #f39c12;">
	                <div class="inner">
	                  <h3><?=number_format($count_type3)?></h3>
	                  <p>หน่วยรับเรื่องแล้ว</p>
	                </div>
	                <div class="icon">
	                  <i class="far fa-bell"></i>
	                </div>
	                <a href="<?=base_url()?>manage/received" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
	              </div>
	            </div><!-- ./col -->
	            <div class="col-lg-3 col-md-6 col-xs-6">
	              <!-- small box -->
	              <div class="small-box" style="color:#fff; background-color: #dd4b39;">
	                <div class="inner">
	                  <h3><?=number_format($count_type4)?></h3>
	                  <p>หน่วยกำลังดำเนินการ</p>
	                </div>
	                <div class="icon">
	                  <i class="far fa-calendar-check"></i>
	                </div>
	                <a href="<?=base_url()?>manage/proceed" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
	              </div>
	            </div><!-- ./col -->
	            <div class="col-lg-3 col-md-6 col-xs-6">
	              <!-- small box -->
	              <div class="small-box" style="color:#fff; background-color: #28a745;">
	                <div class="inner">
	                  <h3><?=number_format($count_type0)?></h3>
	                  <p>ยุติเรื่อง/ไม่ใช่/แจ้งกลับ</p>
	                </div>
	                <div class="icon">
					<i class="far fa-check-circle"></i>
	                </div>
	                <a href="<?=base_url()?>manage/terminate" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
	              </div>
	            </div><!-- ./col -->
	        <?php }?>
	        <?php if($this->session->userdata('level')== "user"){?>

			<div class="col-12 mb-4 ml-5" style="color:#EE7530">
				<h4>หน่วย <?=$show_unit['name']?></h4>
			</div>
	        	<div class="col-lg-3 col-md-6 col-xs-6">
	              <!-- small box -->
	              <div class="small-box" style="color:#fff; background-color: #f39c12;">
	                <div class="inner">
	                  <h3><?=number_format($count_type3)?></h3>
	                  <p>รับเรื่องร้องเรียน</p>
	                </div>
	                <div class="icon">
	                  <i class="fas fa-satellite-dish"></i>
	                </div>
	                <a href="<?=base_url()?>manage/receive" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
	              </div>
	            </div><!-- ./col -->
	        	<div class="col-lg-3 col-md-6 col-xs-6">
	              <!-- small box -->
	              <div class="small-box" style="color:#fff; background-color: #00c0ef;">
	                <div class="inner">
	                  <h3><?=number_format($count_type4)?></h3>
	                  <p>ดำเนินการ</p>
	                </div>
	                <div class="icon">
	                  <i class="far fa-calendar-check"></i>
	                </div>
	                <a href="<?=base_url()?>manage/alter" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
	              </div>
	            </div><!-- ./col -->
	            <div class="col-lg-3 col-md-6 col-xs-6">
	              <!-- small box -->
	              <div class="small-box" style="color:#fff; background-color: #00bb67;">
	                <div class="inner">
	                  <h3><?=number_format($count_type)?></h3>
	                  <p>ติดตามเรื่องร้องเรียน</p>
	                </div>
	                <div class="icon">
	                  <i class="far fa-bell"></i>
	                </div>
	                <a href="<?=base_url()?>manage/userfollow" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
	              </div>
	            </div><!-- ./col -->
	              <div class="col-lg-3 col-md-6 col-xs-6">
	              <!-- small box -->
	              <div class="small-box" style="color:#fff; background-color: #00bb67;">
	                <div class="inner">
	                  <h3>Line</h3>
	                  <p>จัดการ Line Group</p>
	                </div>
	                <div class="icon">
	                  <i class="fab fa-line"></i>
	                </div>
	                <a href="<?=base_url()?>line" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
	              </div>
	            </div><!-- ./col -->

				<div class="ml-5">คู่มือการใช้งาน คลิก  >> <a href="javascript:showmaual('unit')"><i class="fas fa-file-pdf"></i></a></div>
	        <?php }?>
	    	</div>
    	</div>

    </div>
    <div class="admin-title"><i class="fas fa-chart-line"></i> สถิติเรื่อง ร้องเรียน</div>
    <div id="chart_all" class="mb-5" style="height: 450px; width: 100%"></div>
  </div>
 
</div>

<script src="<?=base_url()?>../assets/highcharts/code/highcharts.js"></script>
<script src="<?=base_url()?>../assets/highcharts/code/modules/data.js"></script>
<script src="<?=base_url()?>../assets/highcharts/code/modules/drilldown.js"></script>
<script>

$(document).ready(function() {
	var URL ="<?=base_url()?>report/chart_main";
    $("#myTable").find("tbody").html("");
    var f = $("#frmSearch").serialize();
    $.ajax({
        type: "GET",
        dataType: "json",
        contentType: "x-www-form-urlencoded; charset=utf-8",
        cache: false,
        url: URL,
        data:f,
        success: function(data) {
 			showChart(data.item,data.categories);
 			// console.log(data.item);
        }
    });
})


function showChart(data,categories){
	Highcharts.chart('chart_all', {
	chart: {
		type : 'spline',
	},
    title: {
        text: 'สถิติการร้องเรียน ย้อนหลัง 30 วัน',
        style: {
            color: '#EE7530',
            fontWeight: 'bold',
            fontSize: '20',
            fontFamily: 'Prompt'
        }
    },

    yAxis: {
        title: {
            text: 'จำนวน (เรื่อง)'
        }
    },
    xAxis: {
        categories: categories
    },
    legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0
    },
    series: data,
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
}


</script>
<?php include_once("_inc_footer.php");?>
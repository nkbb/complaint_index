<?php 
$menu_admin_6 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="fas fa-chart-line"></i> สถิติผู้เข้าชม</div>
    <div class="admin-body">

    <style>
    	.history .nav-link{ color:#4D4D4D; }
    	.history .nav-link:hover{ color:#EE7530; }
    	.history .active{ color:#EE7530; }
    	table tr th{color:#EE7530;}
    </style>

    	<nav class="history">
		  <div class="nav nav-tabs" id="nav-tab" role="tablist">
		    <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">รายปี</a>
		    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">รายเดือน</a>
		    <a class="nav-item nav-link active" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">รายวัน</a>
		  </div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
		  <div class="tab-pane fade " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
		  	<div class="mt-5 mb-5">

		  		<div id="history_year" style="height: 350px; width: 100%"></div>

		  		<table class="table table-bordered mt-5" style="font-size: 14px;">
				  <thead>
				    <tr>
				      <th class="text-center" scope="col">#</th>
				      <th class="text-center" scope="col">ปี (พ.ศ.)</th>
				      <th class="text-center" scope="col">จำนวนผู้เข้าชม</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
				  	$sum = 0;
				  	foreach ($his_year as $key => $value) {?>
				  		<tr>
					      <td class="text-center"><?=$key+1?></td>
					      <td class="text-center"><?=$value["year"]?></td>
					      <td class="text-center"><?=number_format($value['count'])?></td>
					    </tr>
				  	<?php 
				  	$sum += $value['count'];
				  } ?>
				  <tr>
				  	<th colspan="2" class="text-center"><b>รวมทั้งสิ้น</b></th>
				  	<th class="text-center"><b><?=number_format($sum)?></b></th>
				  </tr>
				  </tbody>
				</table>
		  	</div>

		  </div>
		  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="mt-5 mb-5">

                <div id="history_month" style="height: 350px; width: 100%"></div>

                <table class="table table-bordered mt-5" style="font-size: 14px;">
                  <thead>
                    <tr>
                      <th class="text-center" scope="col">#</th>
                      <th class="text-center" scope="col">เดือน ปี (พ.ศ.)</th>
                      <th class="text-center" scope="col">จำนวนผู้เข้าชม</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $sum = 0;
                    foreach ($his_month as $key => $value) {?>
                        <tr>
                          <td class="text-center"><?=$key+1?></td>
                          <td class="text-center"><?=$value["month"]?></td>
                          <td class="text-center"><?=number_format($value['count'])?></td>
                        </tr>
                    <?php 
                    $sum += $value['count'];
                  } ?>
                  <tr>
                    <th colspan="2" class="text-center"><b>รวมทั้งสิ้น</b></th>
                    <th class="text-center"><b><?=number_format($sum)?></b></th>
                  </tr>
                  </tbody>
                </table>
            </div>
          </div>
		  <div class="tab-pane fade show active" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <div class="mt-5 mb-5">

                <div id="history_day" style="height: 350px; width: 100%"></div>

                <table class="table table-bordered mt-5" style="font-size: 14px;">
                  <thead>
                    <tr>
                      <th class="text-center" scope="col">#</th>
                      <th class="text-center" scope="col">วันที่</th>
                      <th class="text-center" scope="col">จำนวนผู้เข้าชม</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $sum = 0;
                    foreach ($his_day as $key => $value) {?>
                        <tr>
                          <td class="text-center"><?=$key+1?></td>
                          <td class="text-center"><?=$value["day"]?></td>
                          <td class="text-center"><?=number_format($value['count'])?></td>
                        </tr>
                    <?php 
                    $sum += $value['count'];
                  } ?>
                  <tr>
                    <th colspan="2" class="text-center"><b>รวมทั้งสิ้น</b></th>
                    <th class="text-center"><b><?=number_format($sum)?></b></th>
                  </tr>
                  </tbody>
                </table>   
            </div>   
          </div>
		</div>

      
    </div>
  </div>
 
</div>

<script src="<?=base_url()?>assets/highcharts/code/highcharts.js"></script>
<script src="<?=base_url()?>assets/highcharts/code/modules/data.js"></script>
<script src="<?=base_url()?>assets/highcharts/code/modules/drilldown.js"></script>
<script>

Highcharts.chart('history_year', {
    chart: {
        type : 'spline',
    },
    title: {
        text: 'สถิติผู้เข้าชม รายปี',
        style: {
            color: '#EE7530',
            fontWeight: 'bold',
            fontSize: '24',
            fontFamily: 'Prompt'
        }
    },

    yAxis: {
        title: {
            text: 'ผู้เข้าชม (ครั้ง)'
        }
    },
    xAxis: {
        categories: [<?php for($i=9;$i>=0;$i--) {
        	echo $his_year[$i]['year'];
        	echo ",";
        }?>]
    },
    legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0
    },

    series: [{
        name: 'สถิติ',
        data: [<?php for($i=9;$i>=0;$i--) {
        	echo $his_year[$i]['count'];
        	echo ",";
        }?>],
        color:'#28a745'

    }],

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

Highcharts.chart('history_month', {
    chart: {
        type : 'spline',
    },
    title: {
        text: 'สถิติผู้เข้าชม รายเดือน',
        style: {
            color: '#EE7530',
            fontWeight: 'bold',
            fontSize: '24',
            fontFamily: 'Prompt'
        }
    },

    yAxis: {
        title: {
            text: 'ผู้เข้าชม (ครั้ง)'
        }
    },
    xAxis: {
        categories: [<?php for($i=11;$i>=0;$i--) {
            echo "'".$his_month[$i]['month']."'";
            echo ",";
        }?>]
    },
    legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0
    },

    series: [{
        name: 'สถิติ',
        data: [<?php for($i=11;$i>=0;$i--) {
            echo $his_month[$i]['count'];
            echo ",";
        }?>],
        color:'#007bff'

    }],

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

Highcharts.chart('history_day', {
    chart: {
        type : 'spline',
    },
    title: {
        text: 'สถิติผู้เข้าชม 30 วันล่าสุด',
        style: {
            color: '#EE7530',
            fontWeight: 'bold',
            fontSize: '24',
            fontFamily: 'Prompt'
        }
    },

    yAxis: {
        title: {
            text: 'ผู้เข้าชม (ครั้ง)'
        }
    },
    xAxis: {
        categories: [<?php for($i=29;$i>=0;$i--) {
            echo "'".$his_day[$i]['day']."'";
            echo ",";
        }?>]
    },
    legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0
    },

    series: [{
        name: 'สถิติ',
        data: [<?php for($i=29;$i>=0;$i--) {
            echo $his_day[$i]['count'];
            echo ",";
        }?>],
        color:'#20c997'

    }],

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

</script>
<?php include_once("_inc_footer.php");?>
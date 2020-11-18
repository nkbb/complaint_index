<?php 
$menu_admin_6 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="fas fa-comment-dots"></i> แบบประเมินความพึงพอใจ</div>
    <div class="admin-body">
    	<h4 class="text-center">ส่วนที่ 1 ข้อมูลของผู้ใช้บริการ</h4>

    	<div class="row">
    		<div class="col-md-6">
    			<div id="quessex" style="height: 350px; width: 100%"></div>
    		</div>
    		<div class="col-md-6">
    			<div id="quesage" style="height: 350px; width: 100%"></div>
    		</div>
    	</div>
    	<div class="row mt-5">
    		<div class="col-md-6">
    			<div id="quesqus" style="height: 350px; width: 100%"></div>
    		</div>
    		<div class="col-md-6">
    			<div id="queswork" style="height: 350px; width: 100%"></div>
    		</div>
    	</div>

    	<h4 class="text-center mt-4 mb-5">ส่วนที่ 2 ความพึงพอใจของผู้ใช้บริการ</h4>
    	<?php foreach ($item as $key => $value) { ?>
    		<div style="margin-left: 10%;font-size: 16px; color:#EE7530;"><?=$key+1?>. <?=$value['name']?></div>
    		<div style="margin-left:15%">
	    		<div id="quesdetial<?=$value['ind']?>" style="height: 300px; width: 80%"></div>
	    	</div>
    	<?php } ?>
    </div>
  </div>
 
</div>

<script src="<?=base_url()?>assets/highcharts/code/highcharts.js"></script>
<script src="<?=base_url()?>assets/highcharts/code/modules/data.js"></script>
<script src="<?=base_url()?>assets/highcharts/code/modules/drilldown.js"></script>
<script>
	Highcharts.chart('quessex', {
	    chart: {
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false,
	        type: 'pie'
	    },
	    title: {
	        text: 'เพศ',
	        style: {
	            color: '#EE7530',
	            fontWeight: 'bold',
	            fontSize: '20',
	            fontFamily: 'Prompt'
	        }
	    },
	    tooltip: {
	        pointFormat: '<b>{point.percentage:.1f}% ({point.y})</b>'
	    },
	    plotOptions: {
	      pie: {
	        dataLabels: {
	          enabled: true,
	          format: '<b>{point.name}</b>:<br>{point.percentage:.1f}% ({point.y})',
	        }
	      }
	    },
	    series: [{
	        name: 'Brands',
	        colorByPoint: true,
	        colors: ['#28a745', '#007bff'],
	        data: [{
	            name: 'ชาย',
	            y: <?=$sex1['ct']?>,
	            //colors:#28a745
	        }, {
	            name: 'หญิง',
	            y: <?=$sex2['ct']?>,
	            //colors:#007bff
	        }]
	    }]
	});

	Highcharts.chart('quesage', {
	    chart: {
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false,
	        type: 'pie'
	    },
	    title: {
	        text: 'อายุ',
	        style: {
	            color: '#EE7530',
	            fontWeight: 'bold',
	            fontSize: '20',
	            fontFamily: 'Prompt'
	        }
	    },
	    tooltip: {
	        pointFormat: '<b>{point.percentage:.1f}% ({point.y})</b>'
	    },
	    plotOptions: {
	      pie: {
	        dataLabels: {
	          enabled: true,
	          format: '<b>{point.name}</b>:<br>{point.percentage:.1f} % ({point.y})',
	        }
	      }
	    },
	    series: [{
	        name: 'Brands',
	        colorByPoint: true,
	        colors: ['#28a745', '#007bff','#ffc107','#dc3545','#fd7e14'],
	        data: [{
	            name: 'ต่ำกว่า 20 ปี',
	            y: <?=$age1['ct']?>,
	        }, {
	            name: '20-30 ปี',
	            y: <?=$age2['ct']?>,
	        }, {
	            name: '31-40 ปี',
	            y: <?=$age3['ct']?>
	        }, {
	            name: '41-50 ปี',
	            y: <?=$age4['ct']?>
	        }, {
	            name: '51 ปีขึ้นไป',
	            y: <?=$age5['ct']?>
	        }]
	    }]
	});

	Highcharts.chart('quesqus', {
	    chart: {
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false,
	        type: 'pie'
	    },
	    title: {
	        text: 'การศึกษา',
	        style: {
	            color: '#EE7530',
	            fontWeight: 'bold',
	            fontSize: '20',
	            fontFamily: 'Prompt'
	        }
	    },
	    tooltip: {
	        pointFormat: '<b>{point.percentage:.1f}% ({point.y})</b>'
	    },
	    plotOptions: {
	      pie: {
	        dataLabels: {
	          enabled: true,
	          format: '<b>{point.name}</b>:<br>{point.percentage:.1f} % ({point.y})',
	        }
	      }
	    },
	    series: [{
	        name: 'Brands',
	        colorByPoint: true,
	        colors: ['#28a745', '#007bff','#ffc107','#dc3545','#fd7e14'],
	        data: [{
	            name: 'ต่ำกว่าปริญญาตรี',
	            y: <?=$qua1['ct']?>,
	        }, {
	            name: 'ปริญญาตรี',
	            y: <?=$qua2['ct']?>,
	        }, {
	            name: 'ปริญญาโท',
	            y: <?=$qua3['ct']?>
	        }, {
	            name: 'ปริญญาเอก',
	            y: <?=$qua4['ct']?>
	        } ]
	    }]
	});

	Highcharts.chart('queswork', {
	    chart: {
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false,
	        type: 'pie'
	    },
	    title: {
	        text: 'อาชีพ',
	        style: {
	            color: '#EE7530',
	            fontWeight: 'bold',
	            fontSize: '20',
	            fontFamily: 'Prompt'
	        }
	    },
	    tooltip: {
	        pointFormat: '<b>{point.percentage:.1f}% ({point.y})</b>'
	    },
	    plotOptions: {
	      pie: {
	        dataLabels: {
	          enabled: true,
	          format: '<b>{point.name}</b>:<br>{point.percentage:.1f} % ({point.y})',
	        }
	      }
	    },
	    series: [{
	        name: 'Brands',
	        colorByPoint: true,
	        colors: ['#28a745', '#007bff','#ffc107','#dc3545','#fd7e14'],
	        data: [{
	            name: 'รับราชการ',
	            y: <?=$work1['ct']?>,
	        }, {
	            name: 'พนักงานบริษัท/รัฐวิสาหกิจ',
	            y: <?=$work2['ct']?>,
	        }, {
	            name: 'ธุรกิจส่วนตัว',
	            y: <?=$work3['ct']?>
	        }, {
	            name: 'รับจ้าง',
	            y: <?=$work4['ct']?>
	        }, {
	            name: 'นักเรียน/นักศึกษา',
	            y: <?=$work5['ct']?>
	        }, {
	            name: 'อื่น ๆ',
	            y: <?=$work6['ct']?>
	        } ]
	    }]
	});

	<?php foreach ($item as $key => $value) { ?>
	Highcharts.chart('quesdetial<?=$value['ind']?>', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: '',
	        style: {
	        	display: 'none'
	    	}
	    },
	    xAxis: {
	        categories: [
	            // 'ไม่พึงพอใจมาก',
	            'ไม่พึงพอใจ',
	            'พึงพอใจ',
	            'พึงพอใจมาก'
	        ],
	        crosshair: true
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'ความพึงพอใจ'
	        }
	    },
	    tooltip: {
	        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	        pointFormat: '<tr>' +
	            '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
	        footerFormat: '</table>',
	        shared: true,
	        useHTML: true
	    },
	    plotOptions: {
	        column: {
	            pointPadding: 0.2,
	            borderWidth: 0
	        },
	        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
	    },
	    series: [{
	        name: 'ความพึงพอใจ',
	        data: [<?=$value['data']?>]

	    }]
	});
	<?php }?>
</script>
<?php include_once("_inc_footer.php");?>
<?php 
$menu_admin_6 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
  <div class="adminpage">
    <div class="admin-title"><i class="fas fa-chart-bar"></i> รายงาน</div>
    <div class="admin-body">

    	<div class="setting-menu mt-4">
    		<div class="row">
            <div class="col-12">
                <h4 class="text-center m-4">รายงานแบ่งตามหน่วยรับผิดชอบ</h4>
                <div class="mt-5">
                <table id="tbl-office" class="table table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th width="60%" class="text-center" scope="col">หน่วยรับผิดชอบ</th>
                            <th width="20%" class="text-center" scope="col">จำนวนเรื่อง</th>
                            <th width="20%" class="text-center" scope="col">ร้อยละ</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div>
                <div class="mt-5">
                    <div id="chart-office" class="mb-5" style="height: 450px; width: 100%"></div>
                </div>
            </div>
        </div>
    </div>
    
</div>
</div>
 
</div>
<style>
    #container1 .highcharts-legend{ display:none;}
</style>
<?php include_once("_inc_footer.php");?>

<script src="<?=base_url()?>assets/highcharts/code/highcharts.js"></script>
<script>
var click_type = false;
var click_person = false;
var click_cease = false;

$(document).ready(function() {
    loadReport();
})


function loadReport(){

    var URL ="<?=base_url()?>report/reportOffice";
    $("#tbl-office").find("tbody").html("");
    var f = $("#frmSearch").serialize();
    $.ajax({
        type: "GET",
        dataType: "json",
        contentType: "x-www-form-urlencoded; charset=utf-8",
        cache: false,
        url: URL,
        data:f,
        success: function(data) {
            $.each(data.item, function(i, item) {

                var show_total = "";
                var show_percen = "";
                var show_name = ""
                var num = i+1;
                    
                show_name = "<td>"+num+". "+item.name+"</td>";
                if(item.total == 0){
                    show_total = '<td class="text-center">-</td>';
                    show_percen = '<td class="text-center">-</td>';
                }else{
                    show_total = '<td class="text-center">'+item.total+'</td>';
                    show_percen = '<td class="text-center">'+item.percen+'</td>';
                }

                $("#tbl-office").find("tbody").append("<tr>"+
                show_name+show_total+show_percen+
                "<tr>");

            })


            $("#tbl-office").find("tbody").append("<tr>"+
                '<td class="text-center"><b>รวม</b></td>'+
                '<td class="text-center"><b>'+data.sum+'</b></td>'+
                '<td class="text-center"><b>100</b></td>'+
            "<tr>");

            showChart(data.chart,'chart-office','แผนภูมิ แสดงจำแนกตามประเภทการร้องเรียน');
        }
    });
}


function showChart(chart,divname,titlename){
    Highcharts.chart(divname, {
		chart: {
			type: 'column'
		},
		title: {
			text: titlename
		},
		xAxis: {
			type: 'category'
		},
		yAxis: {
			title: {
				text: ''
			},
			min:0,
			max:100,

		},
		legend: {
			enabled: false
		},
		plotOptions: {
			series: {
				borderWidth: 0,
				dataLabels: {
					enabled: true,
					format: '{point.y:.2f}%'
				}
			}
		},

		tooltip: {
			headerFormat: '<span style="font-size:18px"></span><br>',
			pointFormat: '<span style="color:{point.color};font-size:18px;">{point.name}</span>: <b>{point.y:.2f}%</b> <br/>'
		},
		series: [
			{
				name: "คะแนน",
				colorByPoint: true,
				data: chart
			}
		]
		
	});

    
}



</script>
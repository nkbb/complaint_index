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
            <div class="col-12">
    			<nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-method" role="tab" aria-controls="nav-method" aria-selected="true">ช่องทางการร้องเรียน</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-type" onclick="ClickType()" role="tab" aria-controls="nav-type" aria-selected="false">ประเภทการร้องเรียน</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-person" onclick="ClickPerson()" role="tab" aria-controls="nav-person" aria-selected="false">บุคคลที่ถูกร้องเรียน</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-cease" onclick="ClickCease()" role="tab" aria-controls="nav-cease" aria-selected="false">สถานะเรื่อง</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-method" role="tabpanel" aria-labelledby="nav-method-tab">
                        <h4 class="text-center m-4">จำแนกตามช่องทางข้อร้องเรียน</h4>
                        <div class="mt-5">
                        <table id="tbl-method" class="table table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th width="60%" class="text-center" scope="col">ช่องทางการร้องเรียน</th>
                                    <th width="20%" class="text-center" scope="col">จำนวนเรื่อง</th>
                                    <th width="20%" class="text-center" scope="col">ร้อยละ</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                        </div>
                        <div class="mt-5">
                            <div id="chart-method" class="mb-5" style="height: 450px; width: 100%"></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-type" role="tabpanel" aria-labelledby="nav-type-tab">
                        <h4 class="text-center m-4">จำแนกตามประเด็นข้อร้องเรียน</h4>
                        <div class="mt-5">
                        <table id="tbl-type" class="table table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th width="60%" class="text-center" scope="col">ประเด็นข้อร้องเรียน</th>
                                    <th width="20%" class="text-center" scope="col">จำนวนเรื่อง</th>
                                    <th width="20%" class="text-center" scope="col">ร้อยละ</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                        </div>
                        <div class="mt-5">
                            <div id="chart-type" class="mb-5" style="height: 450px; width: 100%"></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-person" role="tabpanel" aria-labelledby="nav-person-tab">
                        <h4 class="text-center m-4">จำแนกตามบุคคลที่ถูกร้องเรียน</h4>
                        <div class="mt-5">
                        <table id="tbl-person" class="table table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th width="60%" class="text-center" scope="col">ช่องทางการร้องเรียน</th>
                                    <th width="20%" class="text-center" scope="col">จำนวนเรื่อง</th>
                                    <th width="20%" class="text-center" scope="col">ร้อยละ</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                        </div>
                        <div class="mt-5">
                            <div id="chart-person" class="mb-5" style="height: 450px; width: 100%"></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-cease" role="tabpanel" aria-labelledby="nav-cease-tab">
                        <h4 class="text-center m-4">จำแนกตามบุคคลที่ถูกร้องเรียน</h4>
                        <div class="mt-5">
                        <table id="tbl-cease" class="table table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th width="60%" class="text-center" scope="col">สถานะการร้องเรียน</th>
                                    <th width="20%" class="text-center" scope="col">จำนวนเรื่อง</th>
                                    <th width="20%" class="text-center" scope="col">ร้อยละ</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                        </div>
                        <div class="mt-5">
                            <div id="chart-cease" class="mb-5" style="height: 450px; width: 100%"></div>
                        </div>
                    </div>
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
    loadReportMethod();
})

function loadReportMethod(){

    var unit = "<?=$unit?>";
    var URL ="<?=base_url()?>report/reportMethod?unit="+unit;
    $("#tbl-method").find("tbody").html("");
    var f = $("#frmSearch").serialize();
    $.ajax({
        type: "GET",
        dataType: "json",
        contentType: "x-www-form-urlencoded; charset=utf-8",
        cache: false,
        url: URL,
        data:f,
        success: function(data) {
            // showChart(data.item,data.categories);
            // console.log(data.item);
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
 
                
                $("#tbl-method").find("tbody").append("<tr>"+
                show_name+show_total+show_percen+
                "<tr>");

            })


            $("#tbl-method").find("tbody").append("<tr>"+
                '<td class="text-center"><b>รวม</b></td>'+
                '<td class="text-center"><b>'+data.sum+'</b></td>'+
                '<td class="text-center"><b>100</b></td>'+
            "<tr>");

            showChart(data.chart,'chart-method','แผนภูมิ แสดงจำแนกตามช่องทางการร้องเรียน');
        }
    });
}

function ClickType(){
    if(click_type == false){
        loadReportType();
        click_type = true;
    }
}

function loadReportType(){

    var unit = "<?=$unit?>";
    var URL ="<?=base_url()?>report/reportType?unit="+unit;
    $("#tbl-type").find("tbody").html("");
    var f = $("#frmSearch").serialize();
    $.ajax({
        type: "GET",
        dataType: "json",
        contentType: "x-www-form-urlencoded; charset=utf-8",
        cache: false,
        url: URL,
        data:f,
        success: function(data) {
 			// showChart(data.item,data.categories);
 			// console.log(data.item);
            $.each(data.item, function(i, item) {

                var show_total = "";
                var show_percen = "";
                var show_name = ""
                var num = i+1;
                
                if(item.type == 1){
                    
                    show_name = "<td>"+num+". "+item.name+"</td>";
                    if(item.total == 0){
                        show_total = '<td class="text-center">-</td>';
                        show_percen = '<td class="text-center">-</td>';
                    }else{
                        show_total = '<td class="text-center">'+item.total+'</td>';
                        show_percen = '<td class="text-center">'+item.percen+'</td>';
                    }
                }else{
                    // show_total = '<td class="text-center'
                    show_name = "<td>"+item.ind+". "+item.name+"";
                    show_total = "<td class='text-center'><div><br/></div>";
                    show_percen = "<td class='text-center'><div><br/></div>";
                    $.each(item.sub, function(ii, item_sub) {
                        var num_sub = ii+1;
                        show_name += '<div class="pl-4">'+num+'.'+num_sub+' '+item_sub.name+'</div>';
                        if(item_sub.total == 0){
                            show_total += '<div>-</div>';
                            show_percen += '<div>-</div>';
                        }else{
                            show_total += '<div>'+item_sub.total+'</div>';
                            show_percen += '<div>'+item_sub.percen+'</div>';
                        }
                    })
                    show_name += '</td>';
                    show_total += "</td>";
                    show_percen += "</td>";
                }
                
                $("#tbl-type").find("tbody").append("<tr>"+
                show_name+show_total+show_percen+
                "<tr>");

            })


            $("#tbl-type").find("tbody").append("<tr>"+
                '<td class="text-center"><b>รวม</b></td>'+
                '<td class="text-center"><b>'+data.sum+'</b></td>'+
                '<td class="text-center"><b>100</b></td>'+
            "<tr>");

            showChart(data.chart,'chart-type','แผนภูมิ แสดงจำแนกตามประเภทการร้องเรียน');
        }
    });
}

function ClickPerson(){
    if(click_person == false){
        loadReportPerson();
        click_person = true;
    }
}

function loadReportPerson(){
    var unit = "<?=$unit?>";
    var URL ="<?=base_url()?>report/reportPerson?unit="+unit;
    $("#tbl-person").find("tbody").html("");
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
 
                
                $("#tbl-person").find("tbody").append("<tr>"+
                show_name+show_total+show_percen+
                "<tr>");

            })


            $("#tbl-person").find("tbody").append("<tr>"+
                '<td class="text-center"><b>รวม</b></td>'+
                '<td class="text-center"><b>'+data.sum+'</b></td>'+
                '<td class="text-center"><b>100</b></td>'+
            "<tr>");

            showChart(data.chart,'chart-person','แผนภูมิ แสดงการจำแนกตามบุคคลที่ถูกร้องเรียน');
        }
    });
}

function ClickCease(){
    if(click_cease == false){
        loadReportCease();
        click_cease = true;
    }
}

function loadReportCease(){
    var unit = "<?=$unit?>";
    var URL ="<?=base_url()?>report/reportCease?unit="+unit;
    $("#tbl-cease").find("tbody").html("");
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
                
                $("#tbl-cease").find("tbody").append("<tr>"+
                show_name+show_total+show_percen+
                "<tr>");

            })


            $("#tbl-cease").find("tbody").append("<tr>"+
                '<td class="text-center"><b>รวม</b></td>'+
                '<td class="text-center"><b>'+data.sum+'</b></td>'+
                '<td class="text-center"><b>100</b></td>'+
            "<tr>");

            showChart(data.chart,'chart-cease','แผนภูมิ แสดงการจำแนกสถานเรื่อง');
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
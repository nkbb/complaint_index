
<?php 
$menu_admin_9 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
    <div class="adminpage">
  
        <div class="admin-title"><i class="far fa-calendar-check"></i> ดำเนินการ แก้ไขเรื่องร้องเรียน</div>
        <div class="admin-search">
            <form id="frmSearch">
                <input type="hidden" name="page" id="page" value="1"/>
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="s_code" placeholder="ไม่ต้องใส่ <?=$about["key_title"]?>">
                    </div>
                    <div class="col-md-2">
                        <button type="button" onclick="searchData()" class="btn btn-info"><i class="fas fa-search"></i> ค้นหา</button>
                    </div>
                </div>
            </form>       
        </div>
        <div class="admin-body">
            <div style="font-size: 14px;"> ทั้งหมด <span class="list-count"></span> รายการ</div>
            <table class="table table-bordered table-hover" id="myTable"  style="font-size:14px;">
                <thead>
                    <tr class="table-warning">
                        <th width="9%" class="text-center" scope="col">รหัส</th>
                        <th width="10%" class="text-center" scope="col">วันที่ส่ง</th>
                        <th width="20%" class="text-center" scope="col">ประเภท</th>
                        <th width="28%" class="text-center" scope="col">เรื่อง</th>
                        <th width="6%" class="text-center" scope="col">รายละเอียด</th>
                        <th width="10%" class="text-center" scope="col">ตอบข้อร้องเรียน</th>
                        <th width="15%" class="text-center" scope="col">ดำเนินการ<br/>(ผ่านมาแล้ว)</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-end" id="page_nav">
              </ul>
            </nav>

        </div>
    </div>
</div>
<style>
    .admin-body .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #f7d1a0;
}
</style>
<div class="showModel"></div>

<script src="<?=base_url()?>../assets/bootstrap/js/sweetalert.min.js"></script>
<link href="<?=base_url()?>../assets/bootstrap/css/sweetalert.css" rel="stylesheet">
<script>
$(function(){
    searchData();
})

function searchData(){
    var URL ="<?=base_url()?>manage/selectalter";
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
            if(data.items){
                $.each(data.items, function(i, item) {
                    $("#myTable").find("tbody").append("<tr>"+
                        "<td class='text-center'>"+item.code+"</td>"+
                        "<td class='text-center'>"+item.show_date+"</td>"+
                        "<td>"+item.type_name+"</td>"+
                        "<td>"+item.title_name+"</td>"+
                        "<td class=\"text-center\"><a href=\"javascript:viewcomplain('"+item.token+"')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"แสดงรายละเอียด\"><i class=\"fas fa-eye\"></i></a></td>"+
                        "<td class=\"text-center\"><a href=\"javascript:showcomment('"+item.token+"')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"ศูนย์สอบถาม กระบวนการดำเนินการ\" >ตอบ "+item.comment+"</span></a></td>"+
                        "<td><a href=\"javascript:sendanswer('"+item.token+"')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"ดำเนินการตอบ/แก้ไข ข้อร้องเรียน\" ><i class=\"far fa-check-circle\"></i></a> (ผ่านมาแล้ว "+item.date_wait+" วัน)</td>"+
                    "<tr>");
                });

                $('[data-toggle="tooltip"]').tooltip();
            }else{
               //alert('ddd'); 
               $("#myTable").find("tbody").append("<tr><td class='text-center text-danger' colspan='7' style='font-size:20px'>ไม่มีข้อมูล</td></tr>");
            }
            doPaging(data.ct.page, data.ct.count);  
           
        }
    });
}

function viewcomplain(token){
    $( ".showModel" ).load( "<?php echo base_url() ?>manage/showaccept?token="+token);
}

function sendanswer(token){
    $( ".showModel" ).load( "<?php echo base_url() ?>manage/showanswer?token="+token);
}

function showcomment(token){
    $( ".showModel" ).load( "<?php echo base_url() ?>manage/showcomment?token="+token);
}
</script>
<?php include_once("_inc_footer.php");?>



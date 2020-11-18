
<?php 
$menu_admin_3 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
    <div class="adminpage">
  
        <div class="admin-title"><i class="far fa-bell"></i> ติดตามเรื่องร้องเรียน</div>
        <div class="admin-search">
            <form id="frmSearch">
                <input type="hidden" name="page" id="page" value="1"/>
                <div class="row">
                    <div class="col-md-4 mt-2">  
                        <select class="form-control" name="s_unit">
                            <option value="">( หน่วยกำกับดูแลทั้งหมด )</option>
                            <?php foreach($unit as $key => $value){
                                echo "<option value='".$value["ind"]."'>".$value["name"]."</option>";
                            }?>
                        </select>
                    </div>
                    <div class="col-md-3 mt-2">  
                        <select class="form-control" name="s_status">
                            <option value="">( สถานะทั้งหมด )</option>
                            <option value="2">ศูนย์รับเรื่อง</option>
                            <option value="3">รอ หน่วยรับเรื่อง</option>
                            <option value="4">หน่วย ดำเนินการ</option>
                            <option value="5">ศูนย์ยุติ รายงานผู้บริหาร</option>
                            <option value="6">เสร็จสิ้น</option>
                        </select>
                    </div>
                    <div class="col-md-2 mt-2">
                        <input type="text" class="form-control" name="s_code" placeholder="ไม่ต้องใส่ <?=$about["key_title"]?>">
                    </div>
                    <div class="col-md-2 text-center mt-2">
                        <button type="button" onclick="searchData()" class="btn btn-info"><i class="fas fa-search"></i> ค้นหา</button>
                    </div>
                </div>
            </form>       
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-6" style="margin-bottom: 8px;">
                <span class="results-status type-2">ศูนย์รับเรื่อง</span>
                <span class="results-status type-3">หน่วย รับเรื่อง</span>
                <span class="results-status type-4">หน่วย ดำเนินการ</span>
                <span class="results-status type-5">ศูนย์ยุติ รายงานผู้บริหาร</span>
                <span class="results-status type-6">เสร็จสิ้น</span>
            </div>
        </div>
        <div class="admin-body">
            <div style="font-size: 14px;"> ทั้งหมด <span class="list-count"></span> รายการ</div>
            <table class="table table-bordered table-hover" id="myTable"  style="font-size:14px;">
                <thead>
                    <tr class="table-success">
                        <th width="9%" class="text-center" scope="col">รหัส</th>
                        <th width="10%" class="text-center" scope="col">วันที่ส่ง</th>
                        <th width="20%" class="text-center" scope="col">ประเภท</th>
                        <th width="28%" class="text-center" scope="col">เรื่อง</th>
                        <th width="6%" class="text-center" scope="col">รายละเอียด</th>
                        <th width="10%" class="text-center" scope="col">สถานะ </th>
                        <th width="14%" class="text-center" scope="col">ระยะดำเนินงาน</th>
                        <th width="6%" class="text-center" scope="col">จัดการ</th>
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

<div class="showModel"></div>

<script src="<?=base_url()?>../assets/bootstrap/js/sweetalert.min.js"></script>
<link href="<?=base_url()?>../assets/bootstrap/css/sweetalert.css" rel="stylesheet">
<script>
$(function(){
    searchData();
})

function searchData(){
    var URL ="<?=base_url()?>manage/selectfollow";
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
                        "<td class=\"text-center\"><span class=\"results-status type-"+item.type+"\">status</span></td>"+
                        "<td class=\"text-center\">"+item.date_status+"<br/>("+item.finish_type+")</td>"+
                        "<td class=\"text-center\">"+item.link+"</td>"+
                    "<tr>");
                });

                $('[data-toggle="tooltip"]').tooltip();
            }else{
               $("#myTable").find("tbody").append("<tr><td class='text-center text-danger' colspan='8' style='font-size:20px'>ไม่มีข้อมูล</td></tr>");
            }

            if(data.ct.count == 0){
                $("#myTable").find("tbody").html("");
                $("#myTable").find("tbody").append("<tr><td class='text-center text-danger' colspan='8' style='font-size:20px'>ไม่มีข้อมูล</td></tr>");
            }
            
            $(".list-count").html(data.ct.count);
            doPaging(data.ct.page, data.ct.count);
           
        }
    });
}

function viewcomplain(token){
    $( ".showModel" ).load( "<?php echo base_url() ?>manage/showaccept?token="+token);
}

function sendComment(token){
    $( ".showModel" ).load( "<?php echo base_url() ?>manage/sendcomment?token="+token);
}

function commitData(token){
    $( ".showModel" ).load( "<?php echo base_url() ?>manage/commitfollow?token="+token);
    /*swal({
      title: "ยืนยันการดำเนินการ!",
      text: "ยุติเรื่อง และรายงานผู้บริหาร ",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-success",
      confirmButtonText: "ยืนยัน",
      closeOnConfirm: false
    },
    function(){ 
      var URL ="<?=base_url()?>manage/commitdata?token="+token;
            $.ajax({
                type: "GET",
                dataType: "html",
                contentType: "x-www-form-urlencoded; charset=utf-8",
                cache: false,
                url: URL,
                success: function(data) {
                    if(data=='ok'){
                        swal("แจ้งเตือน!", "ดำเนินการ ตอบข้อร้องเรียนเสร็จสิ้น.", "success");
                        searchData();
                    }else{
                        swal("Deleted!", "ผิดพลาด กรุณาลอกใหม่.", "error");
                    }
                }
            });
    });*/

}


</script>
<?php include_once("_inc_footer.php");?>



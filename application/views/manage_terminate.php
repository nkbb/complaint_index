
<?php 
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>assets/css/style-admin.css" rel="stylesheet">

<div class="container">
    <div class="adminpage">
  
        <div class="admin-title"><i class="far fa-trash-alt"></i> ไม่ใช่/แจ้งกลับ/ยุติเรื่อง</div>
        <div class="admin-search">
            <form id="frmSearch">
                <input type="hidden" name="page" id="page" value="1"/>
                <input type="hidden" name="s_status" value="0"/>
                <div class="row">
                    <div class="col-md-4 mt-2">  
                        <select class="form-control" name="s_unit">
                            <option value="">( หน่วยทั้งหมด )</option>
                            <?php foreach($unit as $key => $value){
                                echo "<option value='".$value["ind"]."'>".$value["name"]."</option>";
                            }?>
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
                        <th width="14%" class="text-center" scope="col">วันที่ยุติ - ลบ</th>
                        <th width="10%" class="text-center" scope="col">นำเรื่องไปใช้งาน</th>
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


<script src="<?=base_url()?>assets/bootstrap/js/sweetalert.min.js"></script>
<link href="<?=base_url()?>assets/bootstrap/css/sweetalert.css" rel="stylesheet">
<script>
$(function(){
    searchData();
})

function searchData(){
    var URL ="<?=base_url()?>manage/selectterminate";
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
                        "<td class=\"text-center\">"+item.del_date+"</td>"+
                        "<td class=\"text-center\"><a href=\"javascript:returndata('"+item.token+"')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"นำเรื่องไปใช้งาน\" style='font-size:22px'><i class=\"fas fa-check\"></i></a></td>"+
                    "<tr>");
                });

                $('[data-toggle="tooltip"]').tooltip();
            }else{
               $("#myTable").find("tbody").append("<tr><td class='text-center text-danger' colspan='8' style='font-size:20px'>ไม่มีข้อมูล</td></tr>");
            }

            if(data.ct.count == 0){
                $("#myTable").find("tbody").html("");
                $("#myTable").find("tbody").append("<tr><td class='text-center text-danger' colspan='7' style='font-size:20px'>ไม่มีข้อมูล</td></tr>");
            }
            
            $(".list-count").html(data.ct.count);
            doPaging(data.ct.page, data.ct.count);
            doPaging(data.ct.page, data.ct.count);
           
        }
    });
}

function viewcomplain(token){
    $( ".showModel" ).load( "<?php echo base_url() ?>manage/showaccept?token="+token);
}

function returndata(token){
    if(token){
        swal({
            title: "แจ้งเตือน !",
            text: "ยืนยันการนำข้อมูลกลับไปใช้ อีกครั้ง ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "ยืนยัน!",
            closeOnConfirm: false
        },
        function(){
            var URL ="<?=base_url()?>manage/returndata?token="+token;
            $.ajax({
                type: "GET",
                dataType: "html",
                contentType: "x-www-form-urlencoded; charset=utf-8",
                cache: false,
                url: URL,
                success: function(data) {
                    if(data=='ok'){
                        swal("แจ้งเตือน !", "ดำเนินการเรียบร้อยแล้ว.", "success");
                        searchData();
                    }else{
                        swal("แจ้งเตือน !", "ผิดพลาด กรุณาลอกใหม่.", "error");
                    }
                }
            });
        })
    }
}


</script>
<?php include_once("_inc_footer.php");?>



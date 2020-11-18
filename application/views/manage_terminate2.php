
<?php 
$menu_admin_3 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
    <div class="adminpage">
  
        <div class="admin-title"><i class="far fa-check-circle"></i> ยุติเรื่อง/ไม่ใช่/แจ้งกลับ</div>
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
            <!-- <div class="col-md-6 offset-md-6" style="margin-bottom: 8px;">
                <span class="results-status type-2">ศูนย์รับเรื่อง</span>
                <span class="results-status type-3">หน่วย รับเรื่อง</span>
                <span class="results-status type-4">หน่วย ดำเนินการ</span>
                <span class="results-status type-5">ศูนย์ยุติ รายงานผู้บริหาร</span>
                <span class="results-status type-6">เสร็จสิ้น</span>
            </div> -->
        </div>
        <div class="admin-body">
            <div class="show-count text-primary pl-4" style="font-size: 18px;"> ทั้งหมด <span class="list-count"></span> รายการ</div>
            <div class="mt-1">
               <div class="row show-item-data">
               
               </div>
            </div>
            <div class="row mt-4 no-data">
                <div class="col-12 text-center text-danger">
                    <h4><i class="fas fa-exclamation"></i> ไม่มี ข้อร้องเรียน</h4>
                    <hr/>
                </div>
            </div>   
            <div class="mt-4">
                <nav aria-label="Page navigation">
                <ul class="pagination justify-content-end" id="page_nav">
                </ul>
                </nav>
            </div>
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
    var URL ="<?=base_url()?>manage/selectterminate";
    $(".show-item-data").html('');
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
                    var show_btn = '';
                    var show_process = '';
                    if(item.process == 0){
                        show_process = '<span class="text-danger">ยังไม่ดำเนินการ</div>';
                    }else{
                        show_process = '<span class="">'+item.process+' การดำเนินการ</div>';
                    }

                    if(item.type == 0){
                        show_btn = "<div class=\"text-right mt-2\"><a href=\"javascript:returndata('"+item.token+"')\" class=\"btn btn-sm btn-warning\"><i class=\"fas fa-check\"> </i> นำเรื่องไปใช้งาน</a></div>";
                    }

                    $(".show-item-data").append(''+
                    '<div class="col-md-6 mt-2">'+
                        '<div class="card">'+
                            '<div class="card-header">'+
                                "<a href=\"javascript:viewcomplain('"+item.token+"')\" class=\"link-detail\">"+item.type_name+"</a>"+
                                '<div class="show-date"><i class="far fa-clock"></i> '+item.date_add+' '+item.time_add+'</div>'+
                            '</div>'+
                            '<div class="card-body">'+
                                '<div class="card-text"><span class="header">รหัสเรื่อง :</span> '+item.code+'</div>'+
                                '<div class="card-text"><span class="header">เรื่องร้องเรียน :</span> '+item.title_name+'</div>'+
                                '<div class="card-text"><span class="header">ร้องเรียนถึง : </span> '+item.unit_name+'</div>'+
                                '<div class="card-text"><span class="header">ข่องทางการร้องเรียน :</span> '+item.complaint_method_name+'</div>'+
                                '<div class="card-text"><span class="header">สถานะ :</span> <span class="results-status type-'+item.type+'">'+item.status_name+'</span></div>'+
                                '<div class="card-text"><span class="header">วันที่ยุติ :</span> '+item.finish_date+' '+item.finish_time+'</div>'+
                                show_btn+
                            '</div>'+
                            '<div class="card-footer">'+
                            show_process+
                            '</div>'+
                        '</div>'+
                    '</div>');
                });

                // $('[data-toggle="tooltip"]').tooltip();
            }else{
            //    $("#myTable").find("tbody").append("<tr><td class='text-center text-danger' colspan='8' style='font-size:20px'>ไม่มีข้อมูล</td></tr>");
            }

            if(data.ct.count == 0){
                $(".show-count").hide();
                $(".no-data").show();
            }else{
                $(".show-count").show();
                $(".no-data").hide();
            }

            $(".list-count").html(data.ct.count);
            doPaging(data.ct.page, data.ct.count);
           
        }
    });
}

function viewcomplain(token){
    window.location.href = "<?php echo base_url()?>manage/viewcomplain/terminate?token="+token
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



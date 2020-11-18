
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
                    <div class="col-md-3">  
                        <select class="form-control" name="s_status">
                            <option value="">( สถานะทั้งหมด )</option>
                            <option value="5">ศูนย์ยุติ รายงานผู้บริหาร</option>
                            <option value="6">เสร็จสิ้น</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="s_code" placeholder="ไม่ต้องใส่ <?=$about["key_title"]?>">
                    </div>
                    <div class="col-md-2">
                        <button type="button" onclick="searchData()" class="btn btn-info"><i class="fas fa-search"></i> ค้นหา</button>
                    </div>
                </div>
            </form>       
        </div>
        <div class="row">
            <div class="col-md-4 offset-md-8" style="margin-bottom: 8px;">
                <!-- <span class="results-status type-5">ศูนย์ยุติ รายงานผู้บริหาร</span>
                <span class="results-status type-6">เสร็จสิ้น</span> -->
            </div>
        </div>
        <div class="admin-body">
        <div class="show-count text-primary pl-4" style="font-size: 18px;">ทั้งหมด <span class="list-count"></span> รายการ</div>
            <div class="row content-data mt-1">
                
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
    var URL ="<?=base_url()?>manage/selectuserfollow";
    $(".content-data").html("")
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
                    var show_process = '';
                    if(item.process == 0){
                        show_process = '<span class="text-danger">ยังไม่ดำเนินการ</div>';
                    }else{
                        show_process = '<span class="">'+item.process+' การดำเนินการ</div>';
                    }

                    var show_process = '';
                    if(item.process == 0){
                        show_process = '<span class="text-danger">ยังไม่ดำเนินการ</div>';
                    }else{
                        show_process = '<span class="">'+item.process+' การดำเนินการ</div>';
                    }

                    $(".content-data").append(''+
                    '<div class="col-md-6">'+
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
                            '</div>'+
                            '<div class="card-footer">'+
                            show_process+
                            '</div>'+
                        '</div>'+
                    '</div>');
                });

                // $('[data-toggle="tooltip"]').tooltip();
            }else{
               //alert('ddd'); 
            //    $("#myTable").find("tbody").append("<tr><td class='text-center text-danger' colspan='7' style='font-size:20px'>ไม่มีข้อมูล</td></tr>");
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
    window.location.href = "<?php echo base_url()?>manage/viewcomplain/userfollow?token="+token
}


</script>
<?php include_once("_inc_footer.php");?>



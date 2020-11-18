
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
        <!-- <div class="row">
            <div class="col-md-6 offset-md-6" style="margin-bottom: 8px;">
                <span class="results-status type-2">ศูนย์รับเรื่อง</span>
                <span class="results-status type-3">หน่วย รับเรื่อง</span>
                <span class="results-status type-4">หน่วย ดำเนินการ</span>
                <span class="results-status type-5">ศูนย์ยุติ รายงานผู้บริหาร</span>
                <span class="results-status type-6">เสร็จสิ้น</span>
            </div>
        </div> -->
        <div class="admin-body">
            <div class="show-count text-primary pl-4" style="font-size: 18px;"> ทั้งหมด <span class="list-count"></span> รายการ</div>
           
            <div class="mt-1">
                <div id="accordion" class="row">
                
                </div>
            </div>
            <div class="row mt-4 no-data">
                <div class="col-12 text-center text-danger">
                    <h4><i class="fas fa-exclamation"></i> ไม่มี ข้อร้องเรียน</h4>
                    <hr/>
                </div>
            </div>   
             
            <div class="mt-4">
                <nav aria-label="Page navigatio ">
                <ul class="pagination justify-content-end" id="page_nav">
                </ul>
                </nav>
            </div>

        </div>
    </div>
</div>

<div class="showModel"></div>

<style>
#accordion .card-header{
    padding-top: 6px;
    padding-bottom: 6px;

}

#accordion .active .btn-link{ 
    color: #EE7530 !important;
    text-decoration:none;
}

#accordion .card-header .btn-link{
    color: #495057;
    text-decoration:none;
}
#accordion .card-header .btn-link:link{
    color: #EE7530;
    text-decoration:none;
}
#accordion .card-header .btn-link:visited{
    color: #EE7530;
    text-decoration:none;
}
#accordion .card-header .btn-link:hover{
    color: #EE7530;
    text-decoration:none;
}
#accordion .card-header .btn-link:active{
    color: #EE7530;
    text-decoration:none;
}
.fa-angle-down{
    font-size: 32px;
    margin-top: 8px;
}
.fa-chevron-left{
    font-size: 24px;
    margin-top: 8px;
}
.btn-light{
    border-color: #dc3545;
}

#accordion .show-title{

}
#accordion .show-date{
    margin-left:20px;
    font-size: 12px;
    text-align: left;
}

.card-body{
    padding: 8px 16px 8px 16px;
}

.card-body .tilte{

}
</style>

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

    $("#accordion").html('');

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
                    if(item.type == 3 || item.type == 4){
                        show_btn = "<div class=\"text-right mt-2\"><a href=\"javascript:sendComment('"+item.token+"')\" class=\"btn btn-sm btn-light\"><i class=\"far fa-bell text-danger\"> </i> สอบถามการดำเนินการ</a></div>"
                    }else if(item.type == 5){
                        show_btn = "<div class=\"text-right mt-2\"><a href=\"javascript:commitData('"+item.token+"')\" class=\"btn btn-sm btn-success\"><i class=\"fas fa-clipboard-check\"></i> ยุติเรื่อง</a></div>"
                    }

                    var show_process = '';
                    if(item.process == 0){
                        show_process = '<span class="text-danger">ยังไม่ดำเนินการ</div>';
                    }else{
                        show_process = '<span class="">'+item.process+' การดำเนินการ</div>';
                    }

                    $("#accordion").append(''+
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
                                show_btn+
                            '</div>'+
                            '<div class="card-footer">'+
                            show_process+
                            '</div>'+
                        '</div>'+
                    '</div>');
                    // $("#myTable").find("tbody").append("<tr>"+
                    //     "<td class='text-center'>"+item.code+"</td>"+
                    //     "<td class='text-center'>"+item.show_date+"</td>"+
                    //     "<td>"+item.type_name+"</td>"+
                    //     "<td>"+item.title_name+"</td>"+
                    //     "<td class=\"text-center\"><a href=\"javascript:viewcomplain('"+item.token+"')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"แสดงรายละเอียด\"><i class=\"fas fa-eye\"></i></a></td>"+
                    //     "<td class=\"text-center\"><span class=\"results-status type-"+item.type+"\">status</span></td>"+
                    //     "<td class=\"text-center\">"+item.date_status+"<br/>("+item.finish_type+")</td>"+
                    //     "<td class=\"text-center\">"+item.link+"</td>"+
                    // "<tr>");
                });

                $('[data-toggle="tooltip"]').tooltip();
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
    window.location.href = "<?php echo base_url()?>manage/viewcomplain/follow?token="+token
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

$(document).on("click", ".btn-link", function() { 
        var $ele = $(this).parent().parent();
        var id = $(this).attr("data-id");
        var type = $(this).attr("aria-expanded");
        console.log(type)

        $(".card-header").removeClass('active');
        $(".show_icon").html('<i class="fas fa-angle-down"></i>');
        // if($(this).attr("aria-expanded") == true){
            $("#link_code"+id).addClass('active');
            $("#show_icon"+id).html('<i class="fas fa-chevron-left"></i>');
        // }
        
    });


</script>
<?php include_once("_inc_footer.php");?>




<?php 
$menu_admin_5 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

<div class="container">
    <div class="adminpage">
  
        <div class="admin-title"><i class="fas fa-satellite-dish"></i> รับเรื่องร้องเรียน <small>(ที่ต้องดำเนินการ)</small></div>
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
<style>
    .admin-body .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #17a2b85c;
}
</style>
<div class="showModel"></div>

<script src="<?=base_url()?>assets/cleave-master/cleave.min.js"></script>
<script src="<?=base_url()?>assets/cleave-master/addons/cleave-phone.th.js"></script>
<script src="<?=base_url()?>../assets/bootstrap/js/sweetalert.min.js"></script>
<link href="<?=base_url()?>../assets/bootstrap/css/sweetalert.css" rel="stylesheet">
<script>
$(function(){
    searchData();
})

function searchData(){
    var URL ="<?=base_url()?>manage/selectreceive";
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
                                '<div class="card-text"><span class="header">สถานะ :</span> <span class="results-status type-1">รอ รับเรื่องร้องเรียน</span></div>'+
                                '<div class="card-text"><span class="header">วันที่ ศูนย์รับเรื่องร้องเรียน ส่งเรื่อง : </span> '+item.date_send+' '+item.time_send+'</div>'+
                                "<div class=\"text-right mt-2\"><a href=\"javascript:receive('"+item.token+"')\" class=\"btn btn-sm btn-info mr-2\"><i class=\"far fa-share-square\"></i> รับเรื่อง</a></div>"+
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

/*
function receive(token){
    $( ".showModel" ).load( "<?php echo base_url() ?>manage/showreceive?token="+token);
}
*/
function receive(token){
    swal({
      title: "รับเรื่องร้องเรียน!",
      text: "รับเรื่องร้องเรียน และดำเนินการแก้ไขเรื่องร้องเรียนต่อไป ",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-primary",
      confirmButtonText: "ยืนยัน",
      closeOnConfirm: false
    },
    function(){ 
      var URL ="<?=base_url()?>manage/savereceive?token="+token;
            $.ajax({
                type: "GET",
                dataType: "html",
                contentType: "x-www-form-urlencoded; charset=utf-8",
                cache: false,
                url: URL,
                success: function(data) {
                    if(data=='ok'){
                        swal("แจ้งเตือน!", "ดำเนินการ รับเรื่องร้องเรียนเรียบร้อยแล้ว.", "success");
                        searchData();
                    }else{
                        swal("Deleted!", "ผิดพลาด กรุณาลอกใหม่.", "error");
                    }
                }
            });
    });
}

function viewcomplain(token){
    window.location.href = "<?php echo base_url()?>manage/viewcomplain/receive?token="+token
}


</script>
<?php include_once("_inc_footer.php");?>



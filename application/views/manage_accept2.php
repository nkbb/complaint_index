
<?php 
$menu_admin_2 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>assets/css/style-admin.css" rel="stylesheet">

<div class="container">
    <div class="adminpage">
  
        <div class="admin-title"><i class="far fa-paper-plane"></i> รับเรื่องร้องเรียน-ส่งให้หน่วยดำเนินการ</div>
        <div class="admin-search">
            <form id="frmSearch">
                <input type="hidden" name="page" id="page" value="1"/>
                <input type="hidden" name="s_unit" id="s_unit" value=""/>
                <div class="row">
                    <!-- <div class="col-md-4">  
                        <select class="form-control" name="s_unit">
                            <option value="">( หน่วยทั้งหมด )</option>
                            <?php foreach($unit as $key => $value){
                                echo "<option value='".$value["ind"]."'>".$value["name"]."</option>";
                            }?>
                        </select>
                    </div> -->
                    <div class="col-md-4 mt-2">
                        <input type="text" class="form-control" name="s_code" placeholder="ไม่ต้องใส่ <?=$about["key_title"]?>">
                    </div>
                    <div class="col-md-2 text-center mt-2">
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

            <nav aria-label="Page navigation" class="mt-3">
              <ul class="pagination justify-content-end" id="page_nav">
              </ul>
            </nav>

        </div>
    </div>
</div>

<div class="showModel"></div>

<div id="modalaccept" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ยืนยันการ ส่งให้หน่วยดำเนินการ!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="myForm" enctype="multipart/form-data">
      <input type="hidden" name="token" id="token">
      <div class="modal-body">
        <div class="form-group row">
            <label for="recipient-name" class="col-form-label col-md-5">ระดับการร้องเรียน :</label>
            <div class="offset-md-2 col-md-8">
                <select class="form-control" name="complain_level" id="complain_level">
                    <option value="">== กรุณาเลือก ==</option>
                    <option value="1">เรื่องทั่วไป</option>
                    <option value="2">เรื่องลับ</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="recipient-name" class="col-form-label col-md-5">หน่วยที่กำกับดูแล :</label>
            <div class="offset-md-2 col-md-8">
                <select class="form-control" name="send_unit" id="send_unit">
                    <option value="">== กรุณาเลือก ==</option>
                    <?php foreach ($unit as $key => $value) {
                        echo'<option value="'.$value['ind'].'">'.$value['name'].'</option>';
                    }?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="recipient-name" class="col-form-label col-md-5">คำสั่งการ :</label>
            <div class="offset-md-2 col-md-8">
                <input type="text" class="form-control" name="send_comm" id="send_comm">
            </div>
        </div>
        <div class="form-group row">
            <label for="recipient-name" class="col-form-label col-md-5">เอกสารคำสั่งการ :</label>
            <div class="offset-md-2 col-md-8">
                <input type="file" accept=".pdf" id="files" name="file">
                <small class="form-text text-muted">กรุณาเลือกไฟล์ pdf เท่านั้น</small>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <input type="submit" id="btnsubmit" class="btn btn-primary" value="ส่งให้หน่วย ดำเนินการ">
      </div>
    </form>
    </div>
  </div>
</div>

<script src="<?=base_url()?>assets/bootstrap/js/sweetalert.min.js"></script>
<link href="<?=base_url()?>assets/bootstrap/css/sweetalert.css" rel="stylesheet">
<script>
$(function(){
    searchData();
})

$(document).ready(function() {
     $("#myForm").bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },fields: {
            complain_level: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกชื่อ'
                    }
                }
            },
            send_unit: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาเลือกหน่วยที่กำกับดูแล'
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
        sendData();
        e.preventDefault()
    });
});

function searchData(){
    var URL ="<?=base_url()?>manage/selectaccept";
    $(".content-data").html("");
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
                                // '<div class="card-text"><span class="header">ระยเวลาดำเนินการ : </span> '+item.date_post+' วัน</div>'+
                                '<div class="card-text"><span class="header">ข่องทางการร้องเรียน :</span> '+item.complaint_method_name+'</div>'+
                                '<div class="card-text"><span class="header">สถานะ :</span> <span class="results-status type-1">แจ้งเรื่องร้องเรียน</span></div>'+
                                "<div class=\"text-right mt-2\"><a href=\"javascript:editcomplain('"+item.token+"')\" class=\"btn btn-sm btn-info mr-2\">แก้ไข</a>"+
                                "<a href=\"javascript:sendcomplain('"+item.token+"')\" class=\"btn btn-sm btn-secondary mr-2\">ส่งให้หน่วยดำเนินการ</a>"+
                                "<a href=\"javascript:deletecomplain('"+item.token+"')\" class=\"btn btn-sm btn-danger\">ไม่ใช่/ยุติเรื่อง</a></div>"+
                            '</div>'+
                            '<div class="card-footer">'+
                            show_process+
                            '</div>'+
                        '</div>'+
                    '</div>');
                });

                $('[data-toggle="tooltip"]').tooltip();
            }else{
                // $("#myTable").find("tbody").html("");
                // $("#myTable").find("tbody").append("<tr><td class='text-center text-danger' colspan='7' style='font-size:20px'>ไม่มีข้อมูล</td></tr>");
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
    window.location.href = "<?php echo base_url()?>manage/viewcomplain/accept?token="+token
}

// function viewcomplain(token){
//     $( ".showModel" ).load( "<?php echo base_url() ?>manage/showaccept?token="+token);
// }

function sendData(){
    $('#modalaccept').modal('hide');
    var URL ="<?=base_url()?>manage/sendaccept";
    var form_data = new FormData($("#myForm")[0]);
    var file_data = $('#files').prop('files')[0];   
    form_data.append('file', file_data);
    
    $.ajax({
        type: "POST",
        dataType: "html",
        cache: false,
        contentType: false,
        processData:false,
        url: URL,
        data:form_data,
        success: function(data) {
            if(data=='ok'){
                swal("success!", "ส่งให้หน่วยดำเนินการตอบข้อร้องเรียน เรียบร้อยแล้ว.\nสามารถติดตามข้อร้องเรียนได้ที่\nเมนู 'ติดตามเรื่องร้องเรียน' ", "success");
                searchData();
                $("#btnsubmit").removeAttr("disabled");
            }else{
                swal("success!", "ผิดพลาด กรุณาลอกใหม่.", "error");
            }
        }
    });
}
function editcomplain(token){
    location.href = "<?=base_url()?>complain/edit/"+token;
}

function sendcomplain(token){
    if(token){
        $('#modalaccept').modal('show');
        $("#token").val(token);
    }
}

function deletecomplain(token){

    if(token){
        swal({
            title: "แจ้งเตือน !",
            text: "ยืนยันการลบ อีกครั้ง ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "ลบ!",
            closeOnConfirm: false
        },
        function(){
            var URL ="<?=base_url()?>manage/deleteaccept?token="+token;
            $.ajax({
                type: "GET",
                dataType: "html",
                contentType: "x-www-form-urlencoded; charset=utf-8",
                cache: false,
                url: URL,
                success: function(data) {
                    if(data=='ok'){
                        swal("Deleted!", "ลบ เรียบร้อยแล้ว.", "success");
                        searchData();
                    }else{
                        swal("Deleted!", "ผิดพลาด กรุณาลอกใหม่.", "error");
                    }
                }
            });
        })
    }
    
}
</script>
<?php include_once("_inc_footer.php");?>




<?php 
$menu_admin_2 = "active";
include_once("_inc_hearder.php");?>
<link href="<?=base_url()?>../assets/css/style-admin.css" rel="stylesheet">

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
            <div style="font-size: 14px;"> ทั้งหมด <span class="list-count"></span> รายการ</div>
            <table class="table table-bordered table-hover" id="myTable"  style="font-size:14px;">
                <thead>
                    <tr class="table-success">
                        <th width="9%" class="text-center" scope="col">รหัส</th>
                        <th width="10%" class="text-center" scope="col">วันที่ส่ง</th>
                        <th width="18%" class="text-center" scope="col">ประเภท</th>
                        <th width="28%" class="text-center" scope="col">เรื่อง</th>
                        <th width="6%" class="text-center" scope="col">รายละเอียด</th>
                        <th width="15%" class="text-center" scope="col">ส่งให้หน่วยดำเนินการ (ผ่านมาแล้ว)</th>
                        <th width="8%" class="text-center" scope="col">ไม่ใช่/ยุติเรื่อง</th>
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

<div id="modalaccept" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ยืนยันการ ส่งให้หน่วยดำเนินการ!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="myForm">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <input type="submit" id="btnsubmit" class="btn btn-primary" value="ส่งให้หน่วย ดำเนินการ">
      </div>
    </form>
    </div>
  </div>
</div>

<script src="<?=base_url()?>../assets/bootstrap/js/sweetalert.min.js"></script>
<link href="<?=base_url()?>../assets/bootstrap/css/sweetalert.css" rel="stylesheet">
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
                        "<td><a href=\"javascript:sendcomplain('"+item.token+"')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"ส่งให้หน่วยดำเนินการ\"><i class=\"fas fa-share-square\"></i></a> (ผ่านมาแล้ว "+item.date_past+" วัน)</td>"+
                        "<td class=\"text-center\"><a href=\"javascript:deletecomplain('"+item.token+"')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"ไม่ใช่/ยุติเรื่อง\" ><i class=\"fas fa-minus-circle\"></i></a></td>"+
                    "<tr>");
                });

                $('[data-toggle="tooltip"]').tooltip();
            }else{
                $("#myTable").find("tbody").html("");
                $("#myTable").find("tbody").append("<tr><td class='text-center text-danger' colspan='7' style='font-size:20px'>ไม่มีข้อมูล</td></tr>");
            }

            if(data.ct.count == 0){
                $("#myTable").find("tbody").html("");
                $("#myTable").find("tbody").append("<tr><td class='text-center text-danger' colspan='7' style='font-size:20px'>ไม่มีข้อมูล</td></tr>");
            }
            
            $(".list-count").html(data.ct.count);
            doPaging(data.ct.page, data.ct.count);
           
        }
    });
}

function viewcomplain(token){
    $( ".showModel" ).load( "<?php echo base_url() ?>manage/showaccept?token="+token);
}

function sendData(){
    $('#modalaccept').modal('hide');
    var URL ="<?=base_url()?>manage/sendaccept";
    var f = $("#myForm").serialize();
    $.ajax({
        type: "GET",
        dataType: "html",
        contentType: "x-www-form-urlencoded; charset=utf-8",
        cache: false,
        url: URL,
        data: f,
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



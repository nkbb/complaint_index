<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="far fa-share-square"></i> รับเรื่อง ร้องเรียน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="myfrmreceive">
        <div class="modal-body">
            <div class="model-title">เจ้าหน้าที่ ที่รับผิดชอบ</div>
     
	            <input type="hidden" name="token" value="<?=$token?>">
	            <input type="hidden" name="type" value="4">
				<div class="form-group" style="margin-top: 25px;">
				    <label >ชื่อ :</label>
				    <input type="text" class="form-control" id="auth_fname" name="auth_fname">
				</div>

				<div class="form-group">
				    <label >นามสกุล :</label>
				    <input type="text" class="form-control" id="auth_lname" name="auth_lname">
				</div>

				<div class="form-group">
				    <label >โทรศัพท์ :</label>
				    <input type="text" class="form-control cleave-input-phone" id="auth_phone" name="auth_phone">
				</div>

				<div class="form-group">
				    <label >โทรสาร :</label> 
				    <input type="text" class="form-control cleave-input-fax" id="auth_fax" name="auth_fax">
				</div>

				<div class="form-group">
				    <label >E-mail :</label>
				    <input type="email" class="form-control" id="auth_email" name="auth_email">
				</div>
	        </div>
      
		    <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
		        <input type="submit" id="btnsubmit" class="btn btn-primary" value="ยืนยันการ รับเรื่อง">
		    </div>
     </form>
    </div>
  </div>
</div>


<script>
$(function(){
    $('#myModal').modal('show');  
})

var cleave = new Cleave('.cleave-input-phone', {
    delimiters: ['-', '-', '-' ],
    blocks: [2, 3, 4 ]
});


var cleave = new Cleave('.cleave-input-fax', {
    delimiters: ['-', '-', '-' ],
    blocks: [2, 3, 4 ]
});

$(document).ready(function() {
     $("#myfrmreceive").bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },fields: {
            auth_fname: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอก ชื่อผู้รับผิดชอบ'
                    }
                }
            },
            auth_lname: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอก นามสกุลผู้รับผิดชอบ'
                    }
                }
            },
            auth_phone: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอก โทรศัพท์ผู้รับผิดชอบ'
                    }
                }
            },
            auth_fax: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอก โทรสารผู้รับผิดชอบ'
                    }
                }
            },
            auth_email: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอก Emailผู้รับผิดชอบ'
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
        severeceive();
        e.preventDefault()
    });
});

function severeceive(){

    var URL ="<?=base_url()?>manage/severeceive";
    var f = $("#myfrmreceive").serialize();
    $.ajax({
        type: "GET",
        dataType: "html",
        contentType: "x-www-form-urlencoded; charset=utf-8",
        cache: false,
        data: f,
        url: URL,
        success: function(data) {
            $('#myModal').modal('hide');  
            if(data=='ok'){
                swal("success!", "รับเรื่องร้องเรียน เรียบร้อย...", "success");
                searchData();
            }else{
                swal("success!", "ผิดพลาด ลองอีกครั้ง.", "error");
            }
        }
    });
      
}

</script>
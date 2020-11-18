<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="far fa-bell"></i> ติดตาม กระบวนการดำเนินงาน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="myfrommodal">
        <div class="modal-body">
            <div class="model-title">กระบวนการดำเนินงาน (ของหน่วย)</div>
            <?php if(!$item){ ?>
            <div class="row" style="margin-top: 25px;">
                <div class="col-md-12 text-center text-danger">
                    <label>ยังไม่มีข้อมูล</label>
                </div>
            </div>
            <?php }else{?>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="timeline">
                        <ul>
                            <?php foreach ($item as $key => $value) { ?>
                            <li>
                                <div class="bullet pink"></div>
                                <div class="time"><?=$value["date_ask"]?></div>
                                <div class="desc">
                                  <h3>ติดตาม : <?=$value["ask_unit"]?></h3>
                                  <h3>หน่วย ตอบ : <?php if($value["comment_unit"]){ echo $value["comment_unit"]; }else{ echo "<spna class='text-danger'>ยังไม่ตอบ</span>"; }?></h3>
                                </div>
                            </li>
                            <?php }?>
                        </ul>
                    </div>  
                </div>
            </div>
            <?php }?>
            <div class="model-title mt-3">ติดตามกระบวนการ ดำเนินงาน</div>
     
	            <input type="hidden" name="token" value="<?=$token?>">
				<div class="form-group" style="margin-top: 25px;">
				    <label >ข้อซักถาม :</label>
                    <textarea class="form-control" id="ask_unit" name="ask_unit" rows="3"></textarea>
				</div>

	        </div>
      
		    <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
		        <input type="submit" id="btnsubmit" class="btn btn-primary" value="ติดตามกระบวนการ">
		    </div>
     </form>
    </div>
  </div>
</div>


<script>
$(function(){
    $('#myModal').modal('show');  
})

$(document).ready(function() {
     $("#myfrommodal").bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },fields: {
            ask_unit: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกข้อซักถาม'
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
        saveask();
        e.preventDefault()
    });
});

function saveask(){

    var URL ="<?=base_url()?>manage/saveask";
    var f = $("#myfrommodal").serialize();
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
                swal("success!", "ติดตาม เรื่องสำเร็จ!", "success");
                // searchData();
                location.reload();
            }else{
                swal("success!", "ผิดพลาด ลองอีกครั้ง.", "error");
            }
        }
    });
      
}

</script>
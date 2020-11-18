<?php 
$menu_2 = "navbar-active";
include_once("_inc_hearder.php");?>

<div class="container">
    <div id="mainpage">
    
        <div class="row">
            <div class="title col-md-12 text-center">ข้อตกลงหลักเกณฑ์ เรื่องร้องเรียน</div>
        </div>

        <div class="row" style="margin-bottom:15px;">
            <div class="pl-5 pr-5 pt-3 pb-3" style="margin-left: 3%;">
                    <?=$conditions?>
            </div>
            <div class="col-md-12 text-center mb-3">
               
                <form id="frmaccept" action="<?=base_url()?>complain/register" method="post">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Y" name="accept" id="accept">
                        <label class="form-check-label" for="accept">
                            ยอมรับเงื่อนไข
                        </label>
                    </div>
                </form>
                <button type="button" onclick="nextpage()" class="btn btn-primary btn-next mt-3">ต่อไป</button>
            </div>
        </div>
    </div>
   
</div>


<script src="<?=base_url()?>../assets/bootstrap/js/sweetalert.min.js"></script>
<link href="<?=base_url()?>../assets/bootstrap/css/sweetalert.css" rel="stylesheet">
<link href="<?=base_url()?>../assets/icheck-1.x/skins/square/orange.css" rel="stylesheet">
<script src="<?=base_url()?>../assets/icheck-1.x/icheck.js"></script>
<script>

$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-orange',
    radioClass: 'iradio_square-orange',
    increaseArea: '20%' // optional
  });
});


function nextpage(){
    var accept = $("#accept").prop( "checked" );
    if(accept === false){
        swal("แจ้งเตือน", "กรุณาอ่านข้อตกลงหลักเกณฑ์ เรื่องร้องเรียน!", "error")
    }else if(accept === true){
        $("#frmaccept").submit();
    }
}
</script>

<?php include_once("_inc_footer.php");?>

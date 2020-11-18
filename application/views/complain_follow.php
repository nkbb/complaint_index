
<?php 
$menu_3 = "navbar-active";
include_once("_inc_hearder.php");?>

<div class="container">
  <div id="mainpage">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="title col-md-12 text-center">ติดตามเรื่องร้องเรียน</div>
      </div>
    </div>
    <div class="row mb-5">
      <div class="col-md-4 offset-md-4 p-3">
        <div class="form-group form-group-res-sm" style="margin: 0 10px 15px 10px;">
          <label for="conplainCode">เลขที่ใบร้องเรียน</label>
          <input type="text" class="form-control" id="conplainCode" placeholder="เช่น กข000000">
          <small class="form-text text-muted">รหัสนี้จะได้มาเมื่อคุณแจ้งเรื่องร้องเรียน</small>
        </div>
        <div class="text-center">
          <button type="submit" id="btnSearch" class="btn btn-primary pl-3 pr-3">ค้นหา</button>
        </div>
      </div>
    </div><br>
  </div>
</div>

<?php include_once("_inc_footer.php");?>

<script src="<?=base_url()?>../assets/bootstrap/js/sweetalert.min.js"></script>
<link href="<?=base_url()?>../assets/bootstrap/css/sweetalert.css" rel="stylesheet">
<script>
  $(document).ready(function() {
    $("#btnSearch").click(function() {
      if($("#conplainCode").val() != "") {
        window.location = "<?=base_url()?>/complain/detail/" + $("#conplainCode").val();
      }else{
        swal("ผิดพลาด", "กรุณากรอกที่ใบร้องเรียน", "error");
      }
    });
  });
</script>

<?php if($type == "error") { ?>
  <script>
    $(function(){
      swal("ผิดพลาด", "เลขที่ใบร้องเรียนไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง", "error");
    })
    
    //window.location = "/complain/follow";
    
  </script>
<?php } ?>
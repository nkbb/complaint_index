
<?php 
$menu_1 = "navbar-active";
include_once("_inc_hearder.php");?>
  <div class="container mb-5">
    <div class="row">
      <div class="col-sm-12 mt-5">
        <div class="w-100 bg-white rounded box-shadow text-center pt-5 pb-5">
          <i class="far fa-check-circle text-success" style="font-size: 200px;"></i>
          <h4 class="mt-5">แบบสอบถามได้ถูกส่งให้กับทางเราแล้ว ขอบคุณสำหรับความคิดเห็นค่ะ</h4>
          <button type="submit" class="btn btn-primary pl-3 pr-3 mt-4" onClick="window.location = '<?=base_url()?>';">ย้อนกลับ</button>
        </div>
      </div>
    </div>
  </div>
<?php include_once("_inc_footer.php");?>
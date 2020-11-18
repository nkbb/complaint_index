<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>sss</title>
  <!-- <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/img/favicon.ico"> -->

  <!-- Bootstrap core CSS -->
  <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/css/styleorange.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/fontawesome/css/all.css">

  <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">

  <script src="<?=base_url()?>assets/jquery/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script type="text/javascript" src="<?=base_url()?>assets/bootstrap/js/bootstrapValidator.min.js"></script>
  <link rel="stylesheet" href="<?=base_url()?>assets/bootstrap/css/bootstrapValidator.min.css"/>

</head>
<body>

  <nav class="navbar manage-navbar navbar-expand-lg navbar-light" style="background: #ff6600;">
    <div class="container">

      <a class="navbar-brand" href="<?=base_url()?>">
        <img src="<?=base_url()?>assets/images/logo.png" alt="logo" height="65px" >
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" style="z-index: 999; border-color:#fff;">
        <i style="color:#fff" class="fas fa-bars"></i>
      </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0" id="menu-nav">
              <li class="nav-item">
                <a class="nav-link active" href="<?=base_url()?>">หน้าหลัก</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>complain">ร้องเรียน-ร้องทุกข์</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>complain/follow">ติดตามเรื่องร้องเรียน</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>login">เข้าสู่ระบบ</a>
              </li>
            </ul>
        </div>        
  
    </div>
  </nav>

  <div class="container-fluid" style="padding:0px;">

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://complaint.onestopsevice.com/assets/images/58441791_957604197743130_2503095390941741056_o.jpg" style="max-height: 500px;"class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="https://complaint.onestopsevice.com/assets/images/58441791_957604197743130_2503095390941741056_o.jpg" style="max-height: 500px;" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="https://complaint.onestopsevice.com/assets/images/58441791_957604197743130_2503095390941741056_o.jpg" style="max-height: 500px;" class="d-block w-100" alt="...">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

<div class="container">
  <div class="menu-list text-center mt-5">
    <ul>
      <li><a href="#teyp1" class="menutype1 active">การให้บริการ</a></li>
      <li><a href="#teyp2" class="menutype2">แจ้งเรื่องร้องเรียน</a></li>
      <li><a href="#teyp3" class="menutype3">ติดตามเรื่องร้องเรียน</a></li>

    </ul>
  </div>
  <div class="row menu-type1">
    <div class="col-md-4">
      <div class="text-center list-type1 mb-3">
        <div style="font-size:90px;"><i class="far fa-list-alt"></i></div>
        <p style="font-size: 14px;">ขั้นตอนที่ 1</p>
        <div style="font-size: 18px;color:#ee7530;">เลือกประเภทการร้องเรียน</div>
      </div>
    </div>
    <div class="col-md-4">
       <div class="text-center list-type1 mb-3">
        <div style="font-size:90px;"><i class="fas fa-chalkboard"></i></div>
        <p style="font-size: 14px;">ขั้นตอนที่ 2</p>
        <div style="font-size: 18px;color:#ee7530;">กรอกแบบฟอร์ม</div>
      </div>
    </div>
    <div class="col-md-4">
       <div class="text-center list-type1 mb-3">
        <div style="font-size:90px;"><i class="far fa-bell"></i></div>
        <p style="font-size: 14px;">ขั้นตอนที่ 3</p>
        <div style="font-size: 18px;color:#ee7530;">ติดตามเรื่องร้องเรียน</div>
      </div>
    </div>
  </div>
  <div class="row menu-type2">
    <p>dasets</p>
  </div>
  <div class="row menu-type3">
    <div class="col-md-4 offset-md-4">
      <div >กรุณากรอก เลขที่ร้องเรียน</div>
      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
      <small>รหัสนี้จะได้มาเมื่อคุณแจ้งเรื่องร้องเรียน</small>
    </div>
  </div>
</div>


<div class="container-fuid content-abouts pt-4 pb-5 mt-3">
  <div>
    <h2>ศูนย์รับเรื่องร้องเรียน</h2>
    <div class="row">
      <div class="col-md-4 offset-md-4">
        <hr style="border-top: 2px solid #f8f9fa;">
        <p>ช่องทางการติดต่อ</p>
        <span style="font-size: 24px;background: #fff;padding: 3px 10px 3px 10px;border-radius: 50%;"><i class="far fa-envelope" style="color:#ff6600;"></i></span>
         <span style='font-size:22px;'>Email@test.com</span>
      </div>
    </div>
  </div>
</div>
<div class="container-fuid text-center pt-4 pb-5">
  <h2>ติดต่อเรา</h2>
  <p>สำนักงานเลขานุการกรม กรมสุขภาพจิต </p>
  <p>80/20 หมู่ 4 ถนนติวานนท์ อำเภอเมือง จังหวัดนนทบุรี 11000 </p>
  <iframe src="http://senathipat.rta.mi.th/map" width="100%" height="500" frameborder="0" style="border: 0px; pointer-events: none;" allowfullscreen=""></iframe>
</div>
<script>
  $(function(){
    $(".menu-type2").hide();
    $(".menu-type3").hide();
  })


   $(document).ready(function() {
        $('.menutype1').click(function() {
            $(".menu-type1").show();
            $(".menu-type2").hide();
            $(".menu-type3").hide();

            $( ".menutype1" ).addClass( "active" );
            $( ".menutype2" ).removeClass( "active" );
            $( ".menutype3" ).removeClass( "active" );
        });
        $('.menutype2').click(function() {
            $(".menu-type1").hide();
            $(".menu-type2").show();
            $(".menu-type3").hide();

            $( ".menutype1" ).removeClass( "active" );
            $( ".menutype2" ).addClass( "active" );
            $( ".menutype3" ).removeClass( "active" );
        });
        $('.menutype3').click(function() {
            $(".menu-type1").hide();
            $(".menu-type2").hide();
            $(".menu-type3").show();

            $( ".menutype1" ).removeClass( "active" );
            $( ".menutype2" ).removeClass( "active" );
            $( ".menutype3" ).addClass( "active" );
        });
    });
   //http://cdn.livedemo00.template-help.com:82/wt_40702/
</script>
<?php include_once("_inc_footer.php");?>



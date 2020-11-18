<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ศูนย์รับเรื่องร้องเรียน : กรมสุขภาพจิต</title>
  <!-- <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/img/favicon.ico"> -->

  <!-- Bootstrap core CSS -->
  <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/fontawesome/css/all.css">

  <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">

  <script src="<?=base_url()?>assets/jquery/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script type="text/javascript" src="<?=base_url()?>assets/bootstrap/js/bootstrapValidator.min.js"></script>
  <link rel="stylesheet" href="<?=base_url()?>assets/bootstrap/css/bootstrapValidator.min.css"/>

</head>
<body>

  <nav class="navbar manage-navbar navbar-expand-lg navbar-light">
    <div class="container">

      <a class="navbar-brand" href="<?=base_url()?>">
        <img src="<?=base_url()?>assets/images/logo.png" alt="logo" height="95px" >
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
          <img src="http://qnimate.com/wp-content/uploads/2014/03/images2.jpg" style="max-height: 450px;"class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="http://qnimate.com/wp-content/uploads/2014/03/images2.jpg" style="max-height: 450px;" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="http://qnimate.com/wp-content/uploads/2014/03/images2.jpg" style="max-height: 450px;" class="d-block w-100" alt="...">
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
<style>
  ul{list-style-type: none;}
  .menu-list { font-size: 24px; }
  .menu-list ul li{text-decoration: none;display:inline; margin:0px 10px 0px 10px;}
  .menu-list ul li a{color:#000;text-decoration:none}
  .menu-list ul li a:hover{color:#ff7043;border-bottom: 4px solid #ff7043;}
  .menu-list ul li a.active{color:#ff7043;border-bottom: 4px solid #ff7043;}
</style>
<div class="container">
  <div class="menu-list text-center mt-5">
    <ul>
      <li><a href="<?=base_url()?>#teyp1" class="active">การให้บริการ</a></li>
      <li><a href="<?=base_url()?>#teyp2">แจ้งเรื่องร้องเรียน</a></li>
      <li><a href="<?=base_url()?>#teyp3">ติดตามเรื่องร้องเรียน</a></li>

    </ul>
  </div>
</div>

<?php include_once("_inc_footer.php");?>



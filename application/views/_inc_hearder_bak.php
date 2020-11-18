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
        <i class="fas fa-bars"></i>
      </button>

      <?php if(!$this->session->userdata('is_user_login')){?>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0" id="menu-nav">
              <li class="nav-item ">
                <a class="nav-link <?php echo (isset($menu_1)) ?  $menu_1 : ""; ?>" href="<?=base_url()?>">หน้าหลัก</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo (isset($menu_2)) ?  $menu_2 : ""; ?>" href="<?=base_url()?>complain">ร้องเรียน-ร้องทุกข์</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo (isset($menu_3)) ?  $menu_3 : ""; ?>" href="<?=base_url()?>complain/follow">ติดตามเรื่องร้องเรียน</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link <?php echo (isset($menu_4)) ?  $menu_4 : ""; ?>" href="<?=base_url()?>login">เข้าสู่ระบบ</a>
              </li>
            </ul>
        </div>        
              
       <?php }else{?>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <div class="ml-auto">
            <div class="navber-profile">
              <div> ID : <?=$this->session->userdata('id');?></div>
              <div> ระดับ : <?php if($this->session->userdata('level')=="admin"){ echo "ศูนย์รับเรื่องร้องเรียน"; }else if( $this->session->userdata('level')=="user" ){ echo "หน่วยในสังกัด";}else if( $this->session->userdata('level')=="root" ){ echo "ผู้ดูแลระบบ";}?> </div>
              <a href="<?=base_url()?>logout" onclick="return confirm('ยืนยันออกจากระบบ')"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
            </div>
          </div>
       </div>
      <?php }?>
    </div>
  </nav>
  <?php if($this->session->userdata('is_user_login')){?>
  <nav class="navbar-custom">
    <div class="container">
      <div class="custom-menu">
        <ul>
          <li class="<?php echo (isset($menu_admin_1)) ?  $menu_admin_1 : ""; ?>">
            <a href="<?=base_url()?>admin">
              <div ><i class="fas fa-home"></i></div>
              <div class="item-menu">หน้าหลัก</div>
            </a>
          </li>
          <?php if($this->session->userdata('level')== "root" or $this->session->userdata('level')== "admin"){?>
          <li class="<?php echo (isset($menu_admin_4)) ?  $menu_admin_4 : ""; ?>">
            <a href="<?=base_url()?>complain/create">
              <div><i class="far fa-plus-square"></i></div>
              <div class="item-menu">เพิ่มเรื่องร้องเรียน</div>
            </a>
          </li>
          <li class="<?php echo (isset($menu_admin_2)) ?  $menu_admin_2 : ""; ?>">
            <a href="<?=base_url()?>manage/accept">
              <div><i class="far fa-paper-plane"></i></div>
              <div class="item-menu">รับเรื่องร้องเรียน-ส่งให้หน่วยดำเนินการ</div>
            </a>
          </li>
          <li class="<?php echo (isset($menu_admin_3)) ?  $menu_admin_3 : ""; ?>">
            <a href="<?=base_url()?>manage/follow">
              <div><i class="far fa-bell"></i></div>
              <div class="item-menu">ติดตามเรื่องร้องเรียน</div>
            </a>
          </li>
          <li class="<?php echo (isset($menu_admin_6)) ?  $menu_admin_6 : ""; ?>">
            <a href="<?=base_url()?>report">
              <div><i class="fas fa-chart-bar"></i></div>
              <div class="item-menu">รายงาน</div>
            </a>
          </li>
          <?php }else{?>
          <li class="<?php echo (isset($menu_admin_5)) ?  $menu_admin_5 : ""; ?>">
            <a href="<?=base_url()?>manage/receive">
              <div><i class="fas fa-satellite-dish"></i></div>
              <div class="item-menu">รับเรื่องร้องเรียน</div>
            </a>
          </li>
          <li class="<?php echo (isset($menu_admin_9)) ?  $menu_admin_9 : ""; ?>">
            <a href="<?=base_url()?>manage/alter">
              <div><i class="far fa-calendar-check"></i></div>
              <div class="item-menu">ดำเนินการ แก้ไขเรื่องร้องเรียน</div>
            </a>
          </li>
          <li class="<?php echo (isset($menu_admin_3)) ?  $menu_admin_3 : ""; ?>">
            <a href="<?=base_url()?>manage/userfollow">
              <div><i class="far fa-bell"></i></div>
              <div class="item-menu">ติดตามเรื่องร้องเรียน</div>
            </a>
          </li>
          <?php }?>
          <li class="<?php echo (isset($menu_admin_8)) ?  $menu_admin_8 : ""; ?>">
            <a href="<?=base_url()?>setting/repassword">
              <div><i class="fas fa-key"></i></div>
              <div class="item-menu">เปลี่ยนรหัสผ่าน</div>
            </a>
          </li>
         
        </ul>
      </div>
    </div>
  </nav>
  <?php }?>
 
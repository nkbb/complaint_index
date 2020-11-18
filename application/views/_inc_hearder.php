<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ศูนย์รับเรื่องร้องเรียน กรมสุขภาพจิต</title>

    <link rel="stylesheet" href="<?=base_url()?>../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>../assets/css/styleorange.css">
    <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>../assets/fontawesome/css/all.css">
    
    <script src="<?=base_url()?>../assets/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="<?=base_url()?>../assets/bootstrap/js/bootstrapValidator.min.js"></script>
    <link rel="stylesheet" href="<?=base_url()?>../assets/bootstrap/css/bootstrapValidator.min.css"/>
    <style>
      .card .card-header{
        padding-top: 6px;
        padding-bottom: 6px;
      }
      .card .show-date{
          margin-left:20px;
          font-size: 12px;
          text-align: left;
      }

      .card .card-header .link-detail .active{ 
        color: #EE7530 !important;
        text-decoration:none;
      }
      .card .card-header.{
        background: #fef7ef !implements;
      }

      .card .card-header .link-detail{
          color: #495057;
          text-decoration:none;
      }
      .card .card-header .link-detail:link{
          color: #EE7530;
          text-decoration:none;
      }
      .card .card-header .link-detail:visited{
          color: #EE7530;
          text-decoration:none;
      }
      .card .card-header .link-detail:hover{
          color: #777;
          text-decoration:none;
      }
      .card .card-header .link-detail:active{
          color: #EE7530;
          text-decoration:none;
      }
      .card .card-body{ font-size:14px;}
      .card .card-body .header{ color:#1c75bb }
      .card .card-footer{ font-size:16px; padding: 6px 6px 6px 16px;background: #fff;}
    </style>

  </head>
  <body>
  <div class="panel-header">
    <div class="container d-flex">
        <a href="<?=base_url()?>"><img class="logo-header" src="<?=base_url()?>../assets/images/ph_logo.png"></a>
        <div class="ml-3">
          <a href="<?=base_url()?>" style=" text-decoration: none">
            <div class="text-header-1">ศูนย์รับเรื่องร้องเรียน</div>
            <div class="text-header-2">กรมสุขภาพจิต</div>
            </a>
        </div> 
        <?php if($this->session->userdata('is_user_login')){?>
        <div class="nav-profile">
            <div> ID : <?=$this->session->userdata('id');?></div>
            <div> ระดับ : <?php if($this->session->userdata('level')=="admin"){ echo "ศูนย์รับเรื่องร้องเรียน"; }else if( $this->session->userdata('level')=="user" ){ echo "หน่วยในสังกัด";}else if( $this->session->userdata('level')=="root" ){ echo "ผู้ดูแลระบบ";}?> </div>
            <a href="<?=base_url()?>logout" onclick="return confirm('ยืนยันออกจากระบบ')" style="color:#FFF;"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
        </div>  
        <?php }?>   
    </div>
  </div>

  <?php if(!$this->session->userdata('is_user_login')){?>
  <div class="bg-light box-shadow position-relative">
    <nav class="navbar navbar-expand-lg navbar-light bg-light container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav m-auto navbar-hover">
          <li class="nav-item <?php echo (isset($menu_1)) ?  $menu_1 : ""; ?>">
            <a class="nav-link ml-2 mr-2" href="<?=base_url()?>">หน้าหลัก</a>
          </li>
          <li class="nav-item <?php echo (isset($menu_2)) ?  $menu_2 : ""; ?>">
            <a class="nav-link ml-2 mr-2" href="<?=base_url()?>complain">ร้องเรียน-ร้องทุกข์</a>
          </li>
          <li class="nav-item <?php echo (isset($menu_3)) ?  $menu_3 : ""; ?>">
            <a class="nav-link ml-2 mr-2" href="<?=base_url()?>complain/follow">ติดตามเรื่องร้องเรียน</a>
          </li>
<!--           <li class="nav-item">
            <a class="nav-link ml-2 mr-2" href="#">ติดต่อเรา</a>
          </li> -->
          <li class="nav-item <?php echo (isset($menu_4)) ?  $menu_4 : ""; ?>">
            <a class="nav-link ml-2 mr-2" href="<?=base_url()?>login">เข้าสู่ระบบ</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <?php }?>

  <?php if($this->session->userdata('is_user_login')){?>
  <div class="bg-light box-shadow">
  <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse custom-menu" id="navbarNav">
        <ul>
          <li class="<?php echo (isset($menu_admin_1)) ?  $menu_admin_1 : ""; ?>">
            <a href="<?=base_url()?>admin">
              <div class="item-menu-icon"><i class="fas fa-home"></i></div>
              <div class="item-menu">หน้าหลัก</div>
            </a>
          </li>
          <?php if($this->session->userdata('level')== "root" or $this->session->userdata('level')== "admin"){?>
          <li class="<?php echo (isset($menu_admin_11)) ?  $menu_admin_11 : ""; ?>">
            <a href="<?=base_url()?>complain/create">
              <div class="item-menu-icon"><i class="far fa-plus-square"></i></div>
              <div class="item-menu">เพิ่มเรื่องร้องเรียน</div>
            </a>
          </li>
          <li class="<?php echo (isset($menu_admin_2)) ?  $menu_admin_2 : ""; ?>">
            <a href="<?=base_url()?>manage/accept">
              <div class="item-menu-icon"><i class="far fa-paper-plane"></i></div>
              <div class="item-menu">รับเรื่องร้องเรียน-ส่งให้หน่วยดำเนินการ</div>
            </a>
          </li>
          <li class="<?php echo (isset($menu_admin_3)) ?  $menu_admin_3 : ""; ?>">
            <a href="<?=base_url()?>manage/follow">
              <div class="item-menu-icon"><i class="far fa-bell"></i></div>
              <div class="item-menu">ติดตามเรื่องร้องเรียน</div>
            </a>
          </li>
          <li class="<?php echo (isset($menu_admin_6)) ?  $menu_admin_6 : ""; ?>">
            <a href="<?=base_url()?>report">
              <div class="item-menu-icon"><i class="fas fa-chart-bar"></i></div>
              <div class="item-menu">รายงาน</div>
            </a>
          </li>
           <li class="<?php echo (isset($menu_admin_10)) ?  $menu_admin_10 : ""; ?>">
            <a href="<?=base_url()?>setting">
              <div class="item-menu-icon"><i class="fas fa-cog"></i></div>
              <div class="item-menu">ตั่งค่า</div>
            </a>
          </li>
          <?php }else{?>
          <li class="<?php echo (isset($menu_admin_11)) ?  $menu_admin_11 : ""; ?>">
            <a href="<?=base_url()?>complain/create">
              <div class="item-menu-icon"><i class="fas fa-cloud-upload-alt"></i></div>
              <div class="item-menu">แบบบันทึกข้อร้องเรียน</div>
            </a>
          </li>
          <li class="<?php echo (isset($menu_admin_5)) ?  $menu_admin_5 : ""; ?>">
            <a href="<?=base_url()?>manage/receive">
              <div class="item-menu-icon"><i class="fas fa-satellite-dish"></i></div>
              <div class="item-menu">รับเรื่องร้องเรียน</div>
            </a>
          </li>
          <li class="<?php echo (isset($menu_admin_9)) ?  $menu_admin_9 : ""; ?>">
            <a href="<?=base_url()?>manage/alter">
              <div class="item-menu-icon"><i class="far fa-calendar-check"></i></div>
              <div class="item-menu">ดำเนินการ แก้ไขเรื่องร้องเรียน</div>
            </a>
          </li>
          <li class="<?php echo (isset($menu_admin_3)) ?  $menu_admin_3 : ""; ?>">
            <a href="<?=base_url()?>manage/userfollow">
              <div class="item-menu-icon"><i class="far fa-bell"></i></div>
              <div class="item-menu">ติดตามเรื่องร้องเรียน</div>
            </a>
          </li>
          <li class="<?php echo (isset($menu_admin_6)) ?  $menu_admin_6 : ""; ?>">
            <a href="<?=base_url()?>../report/unit">
              <div class="item-menu-icon"><i class="fas fa-chart-bar"></i></div>
              <div class="item-menu">รายงาน</div>
            </a>
          </li>
          <?php }?>
          <li class="<?php echo (isset($menu_admin_8)) ?  $menu_admin_8 : ""; ?>">
            <a href="<?=base_url()?>setting/repassword">
              <div class="item-menu-icon"><i class="fas fa-key"></i></div>
              <div class="item-menu">เปลี่ยนรหัสผ่าน</div>
            </a>
          </li>

          <li class="but-logout">
            <a href="<?=base_url()?>logout" onclick="return confirm('ยืนยันออกจากระบบ')">
              <div class="item-menu-icon"><i class="fas fa-sign-out-alt"></i></div>
              <div class="item-menu">ออกจากระบบ</div>
            </a>
          </li>
         
        </ul>
      </div>
    </div>
  </nav>
</div>
  <?php }?>
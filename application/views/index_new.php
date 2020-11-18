<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style_new.css">
	<link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>assets/fontawesome/css/all.css">
    <title>ระบบรายงาน</title>
  </head>
  <body>
	<div class="panel-header">
		<div class="container d-flex">
            <img class="logo-header" src="<?=base_url()?>assets/images/ph_logo.png">
            <div class="ml-3">
                <div class="text-header-1">ศูนย์รับเรื่องร้องเรียน</div>
                <div class="text-header-2">กรมสุขภาพจิต</div>
            </div>
		</div>
	</div>
	<div class="bg-light box-shadow">
		<nav class="navbar navbar-expand-lg navbar-light bg-light container">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav m-auto navbar-hover">
					<li class="nav-item active navbar-active">
						<a class="nav-link ml-2 mr-2" href="#">หน้าหลัก <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link ml-2 mr-2" href="#">ร้องเรียน-ร้องทุกข์</a>
					</li>
					<li class="nav-item">
						<a class="nav-link ml-2 mr-2" href="#">ติดตามเรื่องร้องเรียน</a>
					</li>
					<li class="nav-item">
						<a class="nav-link ml-2 mr-2" href="#">ติดต่อเรา</a>
					</li>
					<li class="nav-item">
						<a class="nav-link ml-2 mr-2" href="#">เข้าสู่ระบบ</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
	<div class="container">
		<div class="mt-4 mb-4 bg-light box-shadow">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?=base_url()?>assets/images/58441791_957604197743130_2503095390941741056_o.jpg" class="d-block w-100" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="<?=base_url()?>assets/images/58441791_957604197743130_2503095390941741056_o.jpg" class="d-block w-100" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="<?=base_url()?>assets/images/58441791_957604197743130_2503095390941741056_o.jpg" class="d-block w-100" alt="">
                    </div>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-md-12 text-center">
                    <div class="d-flex m-auto text-title-content">
                        <h3 class="pb-2">ศูนย์รับเรื่องร้องเรียน</h3>
                    </div>
                </div>
                <!-- <div class="col-md-12 text-center">
                    <div class="d-flex m-auto text-menu-content pt-3 pb-3">
                        <a class="active pb-2">การให้บริการ</a>
                        <a class="ml-4 pb-2">แจ้งเรื่องร้องเรียน</a>
                        <a class="ml-4 pb-2">ติดตามเรื่องร้องเรียน</a>
                    </div>
                </div> -->
            </div>
            <div class="row pt-5 pb-5">
                <div class="col-md-10 offset-md-1">
                    <div class="row">
                        <div class="col-md-3 menu-index">
                            <a href="<?=base_url()?>complain">
                                <div class="panel-box box-content-1 link-cursor">
                                    <div class="box-header">
                                        <div class="text-center">ร้องเรียน-ร้องทุกข์</div>
                                    </div>
                                    <div class="box-detail text-center">
                                        <div class="panel-icon text-center">
                                            <i class="fas fa-bullhorn"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 menu-index">
                            <a href="<?=base_url()?>complain/follow">
                                <div class="panel-box box-content-2 link-cursor">
                                    <div class="box-header">
                                        <div class="text-center">ติดตามเรื่องร้องเรียน</div>
                                    </div>
                                    <div class="box-detail text-center">
                                        <div class="panel-icon text-center">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 menu-index">
                            <div class="panel-box box-content-3 link-cursor">
                                <div class="box-header">
                                    <div class="text-center">คู่มือการใช้งาน</div>
                                </div>
                                <div class="box-detail text-center">
                                    <div class="panel-icon text-center">
                                        <i class="fas fa-book"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 menu-index">
                            <div class="panel-box box-content-4 link-cursor">
                                <div class="box-header">
                                    <div class="text-center">ขั้นตอนการร้องเรียน</div>
                                </div>
                                <div class="box-detail text-center">
                                    <div class="panel-icon text-center icon-cogs-p">
                                        <i class="fas fa-cogs"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<div class="panel-footer bg-light">
		<div class="container">
			<div class="text-secondary text-center">Copyright 2019 ศูนย์รับเรื่องร้องเรียน กรมสุขภาพจิต | All Rights Reserved.</div>
		</div>
	</div>
	<script src="<?=base_url()?>assets/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
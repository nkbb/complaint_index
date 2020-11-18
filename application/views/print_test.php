<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>พิมพ์รายละเอียด ร้องเรียน-ร้องทุกข์</title>

	<style>
	@page { margin: 32pt 20pt 0 20pt; }
		body{
			font-family: 'THsarabunNew';
			font-size: 16pt;
		}
		.line-h6{line-height: 6pt; }
		.line-h8{line-height: 8pt; }
		.line-h10{line-height: 10pt; }
		.line-h12{line-height: 12pt; }
		.line-h14{line-height: 14pt; }
		.line-h16{line-height: 16pt; }
		.line-h18{line-height: 18pt; }
		.line-h20{line-height: 20pt; }
		.line-h22{line-height: 22pt; }
		.line-h24{line-height: 24pt; }
		.line-h26{line-height: 26pt; }
		h2{ font-size: 20pt; font-weight: bold;}
		h3{ font-size: 16pt; font-weight: bold; margin-top:0px;  margin-bottom:8pt;}
		p{ font-size: 16pt; font-weight: bold;}
		.text-center{ text-align:center}
		.text-right{ text-align:right}
		.col-head{background-color:#aaacae; padding-left:10pt;padding-top:-6px;}
		.detail{ margin-top: 0px; margin-left:10pt;}
		.detail .title{ font-weight: bold; }

		.mt-2{ margin-top:2pt}
		.mt-10{ margin-top:10pt}
		.mt-12{ margin-top:12pt}
		.mt-14{ margin-top:14pt}
	</style>
</head>
<body>
	<div style="width:100%;position:static">
		<div style="float: left;width: 65%;">
		
		</div>
		<div style="float: right;border: 1px solid;width: 35%;padding:16px;">
		
			<div class="line-h10">เลขที่ร้องเรียน <b><?=$code?></b></div>
			<div class="line-h14">วันที่รับเรื่องร้องเรียน <?=$show_date_add?></div>
			<div class="line-h10">เวลา </div>
		</div>
	</div>
    <div style="top:8%;position:fixed">
        <h2 class="text-center">การร้องเรียน - ร้องทุกข์</h2>
        <div class="col-head">
            <h3>1. ข้อมูลผู้ร้องเรียน</h3>
        </div>

		<div class="detail">
			
			<div class="">
				<span class="title">ชื่อ - นามสกุล ผู้ร้องเรียน : </span>
				<span style="margin-left:20pt;"><?=$fname?> <?=$lname?></span>
		
				<span class="title" style="margin-left:15pt;">รห้สประจำตัวประชาชน : </span>
				<span style="margin-left:20pt;"><?=$idcard?></span>
				
			</div>
			<div class="">
				<span class="title">เพศ : </span>
				<span style="margin-left:20pt;">
					<?php if($sex==1){ echo 'ชาย';}else{ 'หญิง';}?>
				</span>
				
				<span class="title" style="margin-left:60pt;">อาชีพ : </span>
				<span style="margin-left:20pt;"><?=$work?></span>
				
			</div>
			<div class="line-h16">
				<span class="title">ที่อยู่ : </span>
				<span style="margin-left:20pt;"><?=$address?> <?=$addressfull?></span>
			</div>
			<div class="">
				<span class="title">โทรศัพท์ : </span>
				<span style="margin-left:20pt;"><?=$tel?></span>

				<span class="title" style="margin-left:20pt;">มือถือ : </span>
				<span style="margin-left:20pt;"><?=$phone?></span>

				<span class="title" style="margin-left:20pt;">โทรสาร : </span>
				<span style="margin-left:20pt;"><?=$fax?></span>
			
			</div>
			<div class="line-h16" style="margin-bottom:20pt;">
				<span class="title">Email : </span>
				<span style="margin-left:20pt;"><?=$email?></span>
			</div>
		
		</div>

		<div class="col-head">
            <h3>2. ข้อมูลเกี่ยวกับเรื่องร้องเรียน</h3>
        </div>
		
		<div class="detail">
			
			<div class="">
				<span class="title">ช่องทางการ้องเรียน : </span>
				<span style="margin-left:20pt;"><?=$complain_method?></span>
		
				<span class="title" style="margin-left:20pt;">ร้องเรียนถึง : </span>
				<span style="margin-left:20pt;"><?=$office_name?></span>
			</div>
			<div class="">
				<span class="title">ประเภทการร้องเรียน : </span>
				<span style="margin-left:20pt;"><?=$complain_type?></span>
				<?php if($complain_sub){?>
					<span class="title" style="margin-left:15pt;">ประเภทย่อย : </span>
					<span style="margin-left:20pt;"><?=$complain_sub?></span>
				<?php }?>
			</div>
			<div class="">
				<span class="title">ร้องเรียนบุคคล : </span>
				<span style="margin-left:20pt;"><?=$complain_person_type?></span>
			</div>
			<div class="">
				<span class="title">เรื่องที่ร้องเรียน : </span>
				<span style="margin-left:20pt;"><?=$name?></span>
			</div>
			<div class="line-h16">
				<span class="title">รายละเอียดเรื่องที่ร้องเรียน : </span>
				<span style="margin-left:20pt;"><?=$description?></span>
			</div>
			<div class="line-h16">
				<span class="title">สิ่งที่ต้องการให้แก้ไข : </span>
				<span style="margin-left:20pt;"><?=$improvement?></span>
			</div>
			<div class="" style="margin-bottom:20pt;">
				<span class="title">เอกสารประกอบ : </span>
				<span style="margin-left:20pt;">
					<?php
					if($files){
						echo 'มีเอกสารประกอบ';
					}else{
						echo "ไม่มี";
					}?>
				</span>
				<span class="title" style="margin-left:20pt;">หน่วยกำกับดูแล : </span>
				<span style="margin-left:20pt;"><?=$send_unit_name?></span>
			</div>
		</div>
		<div class="col-head">
            <h3>3. ข้อมูล ตอบ-แก้ไขข้อร้องเรียน </h3>
        </div>
      
    </div>
</body>
</html>
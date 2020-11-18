<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>พิมพ์รายละเอียด ร้องเรียน-ร้องทุกข์</title>

	<style>
	@page { margin: 32pt 20pt 80pt 20pt; }
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
		.pl-4{ margin-left:14pt; font-size:14pt;}
		.font-bold{ font-weight: bold; }
		.page_break { page-break-before: always; }
		.text-status{ text-align:center; margin-bottom: 20pt; font-size: 22pt;}
	</style>
</head>
<body>
	<!-- <div style="width:100%;position:static">
		<div style="float: left;width: 65%;">
		
		</div>
		<div style="float: right;border: 1px solid;width: 35%;padding:16px;">
		
			<div class="line-h10">เลขที่ร้องเรียน <b><?=$code?></b></div>
			<div class="line-h14">วันที่รับเรื่องร้องเรียน <?=$show_date_add?></div>
			<div class="line-h10">เวลา <?=substr($date_add,11,8)?> น.</div>
		</div>
	</div> -->
	<table width="100%">
		<tr>
			<td width="15%" style="text-align:center;">
			<img src="./assets/images/logo_dmh.jpg" width="75px">
			</td>
			<td width="40%" style="font-size:26px; font-weight: bold;vertical-align: top;">
				<div style="maring-top:-20px;">ระบบบริหารจัดการข้อคิดเห็น</div>
				<div style="line-height: 12pt;">ข้อร้องเรียน กรมสุขภาพจิต</div>
			</td>
			<td width="5%"></div>
			<td width="40%">
				<div style="border: 1px solid;width: 90%;padding:16px 10px; ">
					<div class="line-h10">เลขที่ร้องเรียน <b><?=$code?></b></div>
					<div class="line-h14">วันที่รับเรื่องร้องเรียน <?=$show_date_add?></div>
					<div class="line-h10">เวลา <?=substr($date_add,11,8)?> น.</div>
				</div>
			</td>
		</tr>
	</table>

    <div style="width:100%; margin-top: -14px;">
        <h2 class="text-center">การร้องเรียน - ร้องทุกข์</h2>
        <div class="col-head" >
            <h3>1. ข้อมูลผู้ร้องเรียน</h3>
        </div>

		<?php if($status == 0){?>
		<div class="detail">
			
			<div class="">
				<span class="title">ชื่อ - นามสกุล ผู้ร้องเรียน : </span>
				<span style="margin-left:20pt;"><?=$fname?> <?=$lname?></span>
		
				<span class="title" style="margin-left:15pt;">รหัสประจำตัวประชาชน : </span>
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
		<?php }else{ ?>
			<div class="detail text-status">ปกปิดข้อมูลผู้ร้องเรียน</div>
		<?php }?>


		<div class="col-head">
            <h3>2. ข้อมูลเกี่ยวกับเรื่องร้องเรียน</h3>
        </div>
		
		<div class="detail">
			
			<div class="">
				<span class="title">ช่องทางการร้องเรียน : </span>
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
        <div class="detail">
            <?php if($type == 5 || $type == 6){?>
            <div class="">
				<span class="title">ข้อความการตอบ-แก้ไข ข้อร้องเรียน : </span>
				<span style="margin-left:20pt;"><?=$answer_detail?></span>
			</div>
            <div class="">
				<span class="title">ไฟล์เอกสารแนบ : </span>
				<span style="margin-left:20pt;">
                <?php if($answer_file){
                    echo 'มีเอกสารแนบ';
                }else{
                    echo 'ไม่มี';
                }?>
                </span>
			</div>
            <div class="">
				<span class="title">วันที่ดำเนินการ : </span>
				<span style="margin-left:20pt;"><?=$show_date_answer?></span>
			</div>
            <?php }else{?>
                <div class="text-center" style="font-size:20pt;font-weight: bold;">
                    อยู่ระหว่างดำเนินการ
			    </div>
            <?php }?>
        </div>

		
    </div>
	
	<div class="page_break"></div>
	<div style="margin-top:5%">
		<div class="col-head">
            <h3>4. Timeline</h3>
        </div>
	</div>
	
	<div style="margin:10px">
		<?php if(count($log) == 0){?>
			<span class="text-center" style="font-weight: bold">ยังไม่ดำเนินการ</span>
		<?php }else{?>
			<span class=" " style="font-weight: bold"><?=count($log)?> การดำเนินการ</span>
		<?php } ?>

		<?php foreach($log as $k => $v){?>
			<div style="border: 1px solid #adb5bd; margin-top:6px;">
				<div style="padding:12px 0 0 12px;line-height: 18px; font-weight: bold;"><?=$v['user_name']?></div>
				<div style="padding-left:16px;line-height: 18px">
					<?php if($v['type'] == 1){?>
						<span>แจ้งกลับ/ยกเลิก ข้อร้องเรียน <small> (เจ้าหน้าที่ศูนย์รับเรื่องร้องเรียน)</small></span>
					<?php }else if($v['type'] == 2){?>
						<span>ส่งข้อร้องเรียนให้ หน่วยกำกับดูแล ชื่อหน่วย : <?=$unit_name?><small> (เจ้าหน้าที่ศูนย์รับเรื่องร้องเรียน)</small> </span>
							<?php if(!empty($send_comm)){?>
                                <div class="pl-3">คำสั่งการ : <?=$send_comm?></div>
                                            <div class="pl-3">
                                            เอกสารสั่งการ : 
                                                <?php if($send_files){
                                                    echo "<spna class='text-danger'>มีเอกสารสั่งการ </spna>";
                                                }else{
                                                    echo "<spna class='text-danger'>ไม่มี </spna>";
                                                }?>
                                            </div>
                                            <?php }?>
					<?php }else if($v['type'] == 3){?>
						<span>หน่วยกำกับดูแลรับเรื่องร้องเรียน </span>
					<?php }else if($v['type'] == 4){?>
						<span>หน่วยกำกับดูแล บันทึกการแก้ไขเรื่องร้องเรียน </span>
						<div class="pl-3">รายละเอียด : <?=$answer_detail?></div>
						<div class="pl-3">
						เอกสารแนบ : 
							<?php if($answer_file){
								echo "<spna class='text-danger'>มีเอกสารแนบ </spna>";
							}else{
								echo "<spna class='text-danger'>ไม่มี </spna>";
							}?>
						</div>
					<?php }else if($v['type'] == 5){?>
						<span>ศูนย์รับเรื่อง ยุติเรื่องร้องเรียน <small> (เจ้าหน้าที่ศูนย์รับเรื่องร้องเรียน)</small></span>
					<?php }else if($v['type'] == 6){?>
						<span>ศูนย์รับเรื่อง สอบถามการดำเนินการ <small> (เจ้าหน้าที่ศูนย์รับเรื่องร้องเรียน)</small></span>
						<?php if(isset($v['ask_unit'])){?>
							<div class="pl-4"><span class="font-bold"><i class="fas fa-question-circle"></i> ข้อซักถาม : </span><?=$v['ask_unit']?></div>
							<div class="pl-4 mb-2">เวลา : <?=$v['date_ask']?> <?=$v['time_ask']?></div>
							
							<?php if($v['comment_type'] == 2){?>
								<div class="pl-4"><span class="font-bold"><i class="fas fa-university"></i> คำตอบจากหน่วย : </span><?=$v['comment_unit']?></div>
								<div class="pl-4 mb-2">เวลา : <?=$v['date_com']?> <?=$v['time_com']?></div>
							<?php }else{?>
								<div class="pl-4 mb-2"><span class="font-bold"><i class="fas fa-university"></i> คำตอบจากหน่วย : </span><span class="text-danger">หน่วยยังไม่ตอบข้อซักถาม...</span></div>
							<?php }?>
						<?php }?>
					<?php }else if($v['type'] == 7){?>
						<span>แจ้งกลับ/ยกเลิก ข้อร้องเรียน <small> (เจ้าหน้าที่ศูนย์รับเรื่องร้องเรียน)</small></span>
					<?php }else if($v['type'] == 8){?>
						<span>เรียกข้อร้องเรียนกลับมาใช้งาน <small> (เจ้าหน้าที่ศูนย์รับเรื่องร้องเรียน)</small></span>
					<?php }?>
				</div>
				<div style="padding:0 0 12px 16px; line-height: 18px">
					<small>วันที่ : </small> <?=$v['date_add']?> <?=substr($v['date_time'],11,5)?> น.
				</div>
			</div>
		<?php }?>
	</div>

</body>
</html>
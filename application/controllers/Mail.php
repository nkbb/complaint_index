<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once './application/libraries/CIBase.php';

class Mail extends CIBase {

    public function index() {

    	$db_mail = $this->dbBase("log_mail");
    	$db_complaint = $this->dbBase("complaint");
    	$item = $db_mail->select("","where type = 1 LIMIT 10 ");
    	foreach ($item as $key => $value) {    		

    		$token = $value['rtoken'];
    		$c_code = $db_complaint->selone("code","where token = '$token' ");
    		$address = $value['email'];
    		$nameto = "";
    		$subject = "แจ้งผลการร้องเรียน ศูนย์ร้องเรียน กรมสุขภาพจิต";
    		$body = $this->template_mail_type1($c_code['code']);
    		$sendmail = $this->sendMail($address, $subject, $body, $nameto);
    		if($sendmail){
    			$upd['date_send'] = date("Y-m-d H:i:s");
    			$upd['send_error'] = $sendmail;
    			$upd['type'] = 2;
    			$db_mail->modify($upd, $value['ind']);
    		}
    	}

       
    }



    public function template_mail_type1($code){


    	$html = "
    		<div style=\"display: flex;\">
		    	<div style=\"width: 8%;\"></div>
		    	<div style=\"width: 84%;\">
		    	 	<h2>ศูนย์รับเรื่องร้องเรียน กรมสุขภาพจิต ขอแจ้งผลการร้องเรียน</h2>

		    		<div class='detial' style=\"margin-left:5%;font-size:10pt;\">
			    		<span>รหัสเรื่องร้องเรียน</span>
			    		<span style=\"padding-left:2%\">".$code."</span>
			    		<div>สามารถตรวจสอบรายละเอียดได้ที่  <a href=\"".base_url()."complain/detail/".$code."\">คลิก!!!</a></div>
			    		<div>ขอความร่วมมือ<a href=\"".base_url()."questionnaire/assessment\"> กรอกแบบสอบถามความพึงพอใจ</a></div>
		    		</div>

		    		<div style=\"text-align: right;\"><img src=\"".base_url()."assets/images/mascot.png\" width=\"250px\" alt=\"mascot\"></div>
		    		<div class=\"panel-footer\" style=\"width: 100%;
						    border-top: 10px solid #FB8C00;background:#eee;
						   \">
					    <div class=\"container\">
					      <div class=\"text-secondary\" style=\"text-align:center;font-size:8pt;padding:10px 0px;\">
					        ศูนย์รับเรื่องร้องเรียน สำนักงานเลขานุการกรม กรมสุขภาพจิต <br>
					        <span>80/20 หมู่ 4 ถนนติวานนท์ อำเภอเมือง จังหวัดนนทบุรี 11000</span>
					      </div>
					    </div>
					  </div>
				</div>
				<div style='width: 8%;'></div>
			</div>
			  ";

    	return $html;

    }


}
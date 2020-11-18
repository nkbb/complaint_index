<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once './application/libraries/CIBase.php';

class Linehook extends CIBase {


	public function index()
	{
	
		
	}

	public function zone1(){
		//$strAccessToken = "xhEE6fjBVE0Hf/aF3cvFRm/HL5PqNROWuLu/AlSXa6TYuajrGm0hiYZ1SxSpFs1Qpw2YvuOC6WX5Chad88knD8SMvEM+5+q4mKfub6ZYda6b0jUeeexii5YAKwfCiRNqIVtmqJVyMhrIhS3QcLx8FQdB04t89/1O/w1cDnyilFU=";
		$strAccessToken = "Zw4RNVXb3PlayMd7Qfv+6R2Hv401ikC3FcuBzP6egE1iP1ZslY5ZeNLKhPmLAWaYUT+/KgXNX/qCovNMZoQOFp0m2c3c9lATD4A8BbDFNSfoC4xNcDl21cRoGe/enzJwETdKq+hVSvQPNOKoKEEuQAdB04t89/1O/w1cDnyilFU=";
 		$db_user = $this->dbBase("user_info");
 		// /https://dev-backoffice.tarad.com/line/webhook

		$content = file_get_contents('php://input');
		$arrJson = json_decode($content, true);
		 
		$strUrl = "https://api.line.me/v2/bot/message/reply";
		 
		$arrHeader = array();
		$arrHeader[] = "Content-Type: application/json";
		$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
		
		if($arrJson['events'][0]['message']['text']!= ''){

			$arrPostData = array();
			$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
			$arrPostData['messages'][0]['type'] = "text";
			$arrPostData['messages'][0]['text'] = "ฉันไม่เข้าใจคำสั่ง";

			if($arrJson['events'][0]['message']['text'] == "ตรวจสอบสถานะ"){
			  $arrPostData['messages'][0]['type'] = "text";
			  $arrPostData['messages'][0]['text'] = "สวัสดีครับ ";
			}

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$strUrl);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$result = curl_exec($ch);
			curl_close ($ch);
		}
	}



	

	
}
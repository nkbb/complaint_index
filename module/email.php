<?php
function Send_mail($fromname,$from,$to,$toname,$subject_email,$content_email){
	$content_email=stripslashes($content_email);
	$MailServer="127.0.0.1";
	$return_path="return@solunic.com";
	echo("");
	$boundary="----=_NextPart_SolunicMailer_".time();
	/// $MailServer = "localhost";
	$fp = fsockopen($MailServer, 25, &$errno, &$errstr, 30);
	if(!$fp) { echo("sendmail Connect error: $errstr ($errno)\n"); exit; }
	fgets($fp, 128);
	fputs($fp, "mail from: <$return_path>\r\n");	$retval[0] = fgets($fp, 128);
	fputs($fp, "rcpt to: <$to>\r\n");	$retval[1] = fgets($fp, 128);
	fputs($fp, "data\r\n");			fgets($fp, 128);
	fputs($fp, "Return-Path: <$from>\r\n");
	fputs($fp, "From: $fromname <$from>\r\n");
	fputs($fp, "To: $toname <$to>\r\n");
	fputs($fp, "Subject: $subject_email\r\n");
	fputs($fp, "X-Mailer: mirror\r\n");
	fputs($fp, "MIME-Version: 1.0\r\n");
	fputs($fp, "Content-Type: multipart/alternative;\r\n");
	fputs($fp, "     boundary=\"".$boundary."\"\r\n");
	
	fputs($fp,"\r\n");
	fputs($fp,"This is a multi-part message in MIME format.\r\n");
	fputs($fp,"\r\n");
	fputs($fp,"--".$boundary."\r\n");
	fputs($fp,"Content-Type: text/html;\r\n");
	fputs($fp,"    charset=\"utf-8\"\r\n");
	fputs($fp,"Content-Transfer-Encoding: base64\r\n");
	fputs($fp,"\r\n");
	$body = chunk_split(base64_encode($content_email));
	fputs($fp,$body);
	fputs($fp,"\r\n\r\n");
	fputs($fp,"--".$boundary."--\r\n");
	fputs($fp,"\r\n.\r\n");
	
	$retval[2] = fgets($fp, 128);
	fclose($fp);
	if ( !ereg("^250", $retval[0]) || !ereg("^250", $retval[1]) || !ereg("^250", $retval[2]) )
		$ok=false;
	else
		$ok=true;
	return $ok;
}

function mail_fsend($to,$subject,$message='',$addon='',$file=''){
	
	// example on using PHPMailer with GMAIL
	include_once ("class.phpmailer.php");
	
	$mail             = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
//	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = ".com";      // sets GMAIL as the SMTP server
	$mail->Port       = 25;                   // set the SMTP port
	
	$mail->Username   = "ismartsurvey";  // GMAIL username
	$mail->Password   = "solunic741";            // GMAIL password
	
	$mail->From       = "ismartsurvey@ismartsurvey.com";
	$mail->FromName   = "ismartsurvey";
	$mail->Subject    = $subject;
	//$mail->AltBody    = ""; //Text Body
	
	$mail->MsgHTML($message);
	
	$mail->AddReplyTo("ismartsurvey@ismartsurvey.com","ismartsurvey");
	
	//$mail->AddAttachment("/path/to/file.zip");             // attachment
	//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment
	
	$mail->AddAddress($to,$to);
	
	$mail->IsHTML(true); // send as HTML
	
	if(!$mail->Send()) {
		return 1;
	} else {
		return 0;
	}
}

function mail_fsend2($tos,$subject,$message='',$addtion_header='',$files=array()){
	//첨부파일 가능용
	/*
	추천 해더설정
	$addtion_header['content_type']  ='text/html';
	$addtion_header['char_set']='UTF-8'; or $addtion_header['char_set']='EUC-KR';
	*/
	// $files: 는 서버내의 파일을 지목할 때 사용
	//============================================== 기초 설정
	$boundary = "----=b".md5(uniqid(time()));
	
	$content_type= $addtion_header['content_type'];    //기본내용형식 : 일반 text
	if(empty($content_type)) $content_type='text/plain';            //기본문자셋 : utf-8    
	$char_set = $addtion_header['char_set'];
	if(empty($char_set)) $char_set='UTF-8';            //기본문자셋 : utf-8
	//=====================================================to 설정
	if(is_string($tos)){
		$to = $tos;
	}else if(is_array($tos)){
			$to = implode(', ',$tos);
		}
	//=====================================================subject 설정
	if(empty($subject)){
		$subject = 'No title ';
	}
	//$subject = '=?EUC-KR?B?'.base64_encode($subject).'?=';
	$subject = '=?'.$char_set.'?B?'.base64_encode($subject).'?=';     
	//=====================================================해더 설정
	$headers=array();
	$headers['mime_version']='MIME-Version: 1.0';
	//$headers['content_type']="Content-type: multipart/alternative; boundary=\"{$boundary}\"";
	$headers['content_type']="Content-type: multipart/mixed; boundary=\"{$boundary}\"";
	
	
	if(!empty($addtion_header['from'])){
		$headers[]= "From: ".$addtion_header['from'];    
	}else{
		//	$headers[]= "From: webmaster@{$_SERVER['SERVER_NAME';]}";
	}
	if(!empty($addtion_header['cc'])){        $headers[]= "cc: ".$addtion_header['cc'];    }
	if(!empty($addtion_header['bcc'])){        $headers[]= "Bcc: ".$addtion_header['bcc'];    }            
	
	if(!empty($headers)){        $header = implode("\r\n",$headers)."\r\n";    }
	else{        $header ='';    }
	//======================================================== 메세지 인코딩
	$msg_content_type = "Content-type: {$content_type}; charset={$char_set}";
	
	$msg = '';
	$msg .= mail_fsend_enc_msg($boundary,$message,$msg_content_type); //본문 메세지 처리
	//======================================================== 첨부파일 인코딩
	if(!is_array($files)){$files=array($files);}//강제로 배열로 만든다.
	for($i =0,$m=count($files);$i<$m;$i++){
		$msg .= mail_fsend_enc_file($boundary,$files[$i]); //첨부파일 처리
	}
	//======================================================== 업로드 되는 첨부파일 인코딩    
	if(!empty($_FILES)){
		foreach($_FILES as $key=> $value){            $t = $key; break;        }
		$t_files = $_FILES[$t]['tmp_name'];
		$t_filenames = $_FILES[$t]['name'];
		$t_error = $_FILES[$t]['error'];
		if(!is_array($t_files)){$t_files=array($t_files);}
		if(!is_array($t_filenames)){$t_filenames=array($t_filenames);}
		if(!is_array($t_error)){$t_error=array($t_error);}
		for($i =0,$m=count($t_files);$i<$m;$i++){
			if($t_error[$i]==0){
				$msg .= mail_fsend_enc_file($boundary,$t_files[$i],$t_filenames[$i]); //첨부파일 처리
			}
		}    
	}
	//========================================================= 메세지 닫기
	$msg .='--'.$boundary."--";
	//===================================================== 메일 보내기
	//===================================================== 릴레이션 설정이 필요한 경우는 알아서...
	$result = mail ($to,$subject,$msg,$header);
	return $result;    
}
function mail_fsend_enc_msg($boundary,$msg='',$content_type='Content-type: text/plain; charset=utf-8'){
	//본문문자열 인코딩
	$re_str = '';
	$re_str = '--'.$boundary."\r\n"; //바운드리 설정
	$re_str .= $content_type."\r\n";
	$re_str .= 'Content-Transfer-Encoding: base64'."\r\n"."\r\n";    
	// RFC 2045 에 맞게 $data를 형식화
	$new_msg = chunk_split(base64_encode($msg));
	$re_str .=$new_msg."\r\n";
	return $re_str;
}
function mail_fsend_enc_file($boundary,$file,$filename=''){
	//첨부파일 인코딩
	$content_type = 'Content-Type: application/octet-stream; charset=UTF8';
	$re_str = '';
	$re_str = '--'.$boundary."\r\n"; //바운드리 설정
	$re_str .= $content_type."\r\n";
	$re_str .= 'Content-Transfer-Encoding: base64'."\r\n";    
	if(strlen($filename)==0){        $filename = basename($file);    }
	$re_str .= "Content-Disposition: attachment; filename=\"".'=?UTF-8?B?'.base64_encode($filename).'?='."\""."\r\n"."\r\n";        
	
	// RFC 2045 에 맞게 $data를 형식화    
	$fp = @fopen($file, "r");
	if($fp) {    $msg = fread($fp, filesize($file));    fclose($fp);    }    
	
	$new_msg = chunk_split(base64_encode($msg));
	$re_str .=$new_msg."\r\n";
	
	return $re_str;
} 

////////////////////////////////////////////
function xmail($type,$to,$to_name,$from,$from_name,$title,$message,$charset="utf-8")
{
	global $_FILES;
	
	if($type!='html'){
		$message = nl2br($message);
		$contentType = "Content-Type: text/plain; charset=\"$charset\"; format=flowed";
	}else{
		$contentType = "Content-Type: text/html; charset=\"$charset\"";
	}
	
	$boundary = '----='.uniqid(rand(),true);
	
	$title = "=?$charset?B?".base64_encode($title)."?=";
	$from_name = "=?$charset?B?".base64_encode($from_name)."?=";
	$to_name = "=?$charset?B?".base64_encode($to_name)."?=";
	$recipient = sprintf("%s <%s>", $to_name, $to);
	
	$headers = sprintf(
			"From: %s <%s>\r\n".
			"Reply-to: <%s>\r\n".
			"Subject: %s\r\n".
			"X-Mailer: webmailer\r\n".
			"MIME-Version: 1.0\r\n".
			"Content-Type: multipart/mixed;\r\n\tboundary=\"%s\"\r\n\r\n",
			$from_name,
			$from,
			$from,
			$title,
			$boundary
			);
	
	$body = sprintf(
			"--%s\r\n".
			"%s\r\n".
			"Content-Transfer-Encoding: base64\r\n".
			"Content-Disposition: inline\r\n\r\n".
			"%s\r\n".
			"--%s",
			$boundary,
			$contentType,
			chunk_split(base64_encode(strip_tags($message))),
			$boundary,
			chunk_split(base64_encode($message)),
			$boundary
			);
	
	$ufile = $_FILES['attach'];
	
	foreach( $ufile['tmp_name'] as $key=>$val )
	{
		if( empty($ufile['tmp_name'][$key]) ) continue;
		
		$ftype = $ufile['type'][$key];
		$fname = $ufile['name'][$key];
		
		$fp = fopen($ufile['tmp_name'][$key],"r");
		$file = fread($fp, $ufile['size'][$key]);
		fclose($fp);
		@unlink($ufile['tmp_name'][$key]);
		
		$body .= sprintf(
				"\r\nContent-Type: %s; name=\"=?$charset?B?".base64_encode($fname)."?=\"\r\n".
				"Content-Transfer-Encoding: base64\r\n".
				"Content-Disposition: attachment; filename=\"=?$charset?B?".base64_encode($fname)."?=\"\r\n\r\n".
				"%s\r\n".
				"--%s",
				$ftype,
				chunk_split( base64_encode($file) ),
				$boundary
				);
	}
	
	$body .= "--";
	
	return mail($recipient , $title, $body, $headers);
}
/*
HTML 코드

<form method='POST' enctype='multipart/form-data'>
<input type='file' name='attach[]'>
<input type='file' name='attach[]'>
<input type='file' name='attach[]'>
<input type='submit'>
</form>

*/
?>










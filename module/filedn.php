<?
//////////////////////////////////////////////////////////////////////////////////////////////////
//
//   이미지파일 오디오 비디오 파일 보여주기 및 파일 다운로드 처리
//
//    file_transact("[파일 절대경로]", "[파일처리타입]","[다운로드될때 파일이름]",[파일용량]);
//
//////////////////////////////////////////////////////////////////////////////////////////////////
function file_transact($file_path, $type,$default="",$filename="file",$filesize=0) {
   
   /*
   /////////////////////////////////////////////////////////////////////////////
   //
   //   <Type 설정 값>
   //   
   //   - 동영상 : video/mpeg
   //   - 이미지 : image/jpeg, image/gif, image/png
   //   - 파일다운로드 : file
   //
   /////////////////////////////////////////////////////////////////////////////
   */
   
   if($type == "file") {   // 파일다운로드의 경우
        if(eregi("(MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)) { // 브라우져 구분
             $save_file = urlencode($save_file); // 파일명이나 경로에 한글이나 공백이 포함될 경우를 고려
             Header("Content-Type: doesn/matter");
             Header("Content-Length: $filesize");   // 이부부을 넣어 주어야지 다운로드 진행 상태가 표시 됩니다.
             Header("Content-Disposition: inline; filename=$filename");
             Header("Content-Transfer-Encoding: binary");
             Header("Pragma: no-cache");
             Header("Expires: 0");
        } else {
             Header("Content-type: file/unknown");
             Header("Content-Length: $filesize");
             Header("Content-Disposition: attachment; filename=$filename");
             Header("Content-Description: PHP3 Generated Data");
             Header("Pragma: no-cache");
             Header("Expires: 0");
        }
   } else {
        header("Content-type: $type");
        header("Pragma: no-cache");
        header("Expires: 0");
   }

   if (is_file($file_path)) {
        $fp = fopen($file_path, "r");
        if (!fpassthru($fp))  // 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 기타 보단 이방법이...
             fclose($fp);
   } else if (is_file($default)){
        $fp = fopen($default, "r");
        if (!fpassthru($fp))  // 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 기타 보단 이방법이...
             fclose($fp);
   }else{
		echo "No have file";

   }
}


?>

<?
	// 경고창
	function popup($msg){
		echo "
		<script>
			alert( '".$msg."' );
			history.go(-1);
		</script>";
		exit;
	}
	// 메세지창
	function msg($msg){
		echo "
		<script>
			alert( '".$msg."' );			
		</script>";		
	}
	
	/// Alert("메세지",1->뒤로가기,2->창닫기,3->Opener 리로드하고 창닫기,그외->URL 로 가기,1->끝냄)
	function Alert() {
		$arg = func_get_args();
		if(!$arg[0]) $arg[0] = "에러입니다.";
		$arg[0] = str_replace("\n", " ", $arg[0]);
		$arg[0] = str_replace("\t", " ", $arg[0]);
		$arg[0] = str_replace("\r", " ", $arg[0]);
		echo "<script language=javascript>alert(\"$arg[0]\");
		";
		if($arg[1]) if($arg[1] == 1) echo "history.go(-1);";
		elseif($arg[1]==2) echo"self.close();";
		elseif($arg[1]==3) echo"opener.location.reload();self.close();";
		elseif($arg[1]) echo "location.href='$arg[1]'";
		echo "</script>";
		if($arg[2]) exit;
		return;
	}


	// 빈문자열 경우 1을 리턴
	function isblank($str) {
		$temp=str_replace("　","",$str);
		$temp=str_replace("\n","",$temp);
		$temp=strip_tags($temp);
		$temp=str_replace("&nbsp;","",$temp);
		$temp=str_replace(" ","",$temp);
		if(eregi("[^[:space:]]",$temp)) return 0;
		return 1;
	}


	// 숫자일 경우 1을 리턴
	function isnum($str) {
		if(eregi("[^0-9]",$str)) return 0;
		return 1;
	}


	// 숫자, 영문자 일경우 1을 리턴
	function isalNum($str) {
		if(eregi("[^0-9a-zA-Z\_]",$str)) return 0;
		return 1;
	}


	// HTML Tag를 제거하는 함수
	function del_html( $str ) {
		$str = str_replace( ">", "&gt;",$str );
		$str = str_replace( "<", "&lt;",$str );
		return $str;
	}


	// 주민등록번호 검사
	function check_jumin($jumin) { 
		$weight = '234567892345'; // 자리수 weight 지정 
		$len = strlen($jumin); 
		$sum = 0; 

		if ($len <> 13) return false;

		for ($i = 0; $i < 12; $i++) { 
			$sum = $sum + (substr($jumin,$i,1)*substr($weight,$i,1)); 
		} 

		$rst = $sum%11; 
		$result = 11 - $rst; 

		if ($result == 10) $result = 0;
		else if ($result == 11) $result = 1;

		$ju13 = substr($jumin,12,1); 

		if ($result <> $ju13) return false;
		return true; 
	} 


	// E-mail 주소가 올바른지 검사
	function ismail( $str ) {
		if( eregi("([a-z0-9\_\-\.]+)@([a-z0-9\_\-\.]+)", $str) ) return $str;
		else return ''; 
	}
	
	// 홈페이지 주소가 올바른지 검사
	function isHomepage( $str ) {
		if(eregi("^http://([a-z0-9\_\-\./~@?=&amp;-\#{5,}]+)", $str)) return $str;
		else return '';
	}


	// URL, Mail을 자동으로 체크하여 링크만듬
	function autolink($str) {
		// URL 치환
		$homepage_pattern = "/([^\"\'\=\>])(mms|http|HTTP|ftp|FTP|telnet|TELNET)\:\/\/(.[^ \n\<\"\']+)/";
		$str = preg_replace($homepage_pattern,"\\1<a href=\\2://\\3 target=_blank>\\2://\\3</a>", " ".$str);

		// 메일 치환
		$email_pattern = "/([ \n]+)([a-z0-9\_\-\.]+)@([a-z0-9\_\-\.]+)/";
		$str = preg_replace($email_pattern,"\\1<a href=mailto:\\2@\\3>\\2@\\3</a>", " ".$str);

		return $str;
	}


	// 문자열 끊기 (이상의 길이일때는 .. 로 표시)
 function cut_str($str, $size)
 {
  $substr = substr($str, 0, $size*2);
  $multi_size = preg_match_all('/[\x80-\xff]/', $substr, $multi_chars);

  if($multi_size >0)
   $size = $size + intval($multi_size/3)-1;

  if(strlen($str)>$size)
  {
   $str = substr($str, 0, $size);
   $str = preg_replace('/(([\x80-\xff]{3})*?)([\x80-\xff]{0,2})$/', '$1', $str);
   $str .= '...';
  }

  return $str;
 }


	function cut_str5($msg,$cut_size) {
		if($cut_size<=0) return $msg;
		if(ereg("\[re\]",$msg)) $cut_size=$cut_size+4;
		for($i=0;$i<$cut_size;$i++) if(ord($msg[$i])>127) $han++; else $eng++;
		$cut_size=$cut_size+(int)$han*0.6;
		$point=1;
		for ($i=0;$i<strlen($msg);$i++) {
			if ($point>$cut_size) return $pointtmp."..";
			if (ord($msg[$i])<=127) {
				$pointtmp.= $msg[$i];
				if ($point%$cut_size==0) return $pointtmp.".."; 
			} else {
				if ($point%$cut_size==0) return $pointtmp."..";
				$pointtmp.=$msg[$i].$msg[++$i];
				$point++;
			}
			$point++;
		}
		return $pointtmp;
	}
	// 문자열 끊기 (이상의 길이일때는 NULL 로 표시)
	function cut_str2($msg,$cut_size) {
		if($cut_size<=0) return $msg;
		if(ereg("\[re\]",$msg)) $cut_size=$cut_size+4;
		for($i=0;$i<$cut_size;$i++) if(ord($msg[$i])>127) $han++; else $eng++;
		$cut_size=$cut_size+(int)$han*0.6;
		$point=1;
		for ($i=0;$i<strlen($msg);$i++) {
			if ($point>$cut_size) return $pointtmp;
			if (ord($msg[$i])<=127) {
				$pointtmp.= $msg[$i];
				if ($point%$cut_size==0) return $pointtmp; 
			} else {
				if ($point%$cut_size==0) return $pointtmp;
				$pointtmp.=$msg[$i].$msg[++$i];
				$point++;
			}
			$point++;
		}
		return $pointtmp;
	}

	// 페이지 이동 스크립트
	function movepage($url) {
		global $connect;
		echo"<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
		if($connect) @mysql_close($connect);
		exit;
	}
	
	// TEXT 형식으로 변환
	function get_text($str, $html=0)
	{
	    /* 3.22 막음 (HTML 체크 줄바꿈시 출력 오류때문)
	    $source[] = "/  /";
	    $target[] = " &nbsp;";
	    */
	
	    // 3.31
	    // TEXT 출력일 경우 &amp; &nbsp; 등의 코드를 정상으로 출력해 주기 위함
	    if ($html == 0) {
	        $str = html_symbol($str);
	    }
	
	    $source[] = "/</";
	    $target[] = "&lt;";
	    $source[] = "/>/";
	    $target[] = "&gt;";
	    //$source[] = "/\"/";
	    //$target[] = "&#034;";
	    $source[] = "/\'/";
	    $target[] = "&#039;";
	    //$source[] = "/}/"; $target[] = "&#125;";
	    if ($html) {
	        $source[] = "/\n/";
	        $target[] = "<br/>";
	    }
	
	    return preg_replace($source, $target, $str);
	}
	
	// 리퍼러 체크
	function referer_check($url="")
	{
	    global $g4;
	
	    if (!$url)
	        $url = $g4[url];
	
	    if (!preg_match("/^http[s]?:\/\/".$_SERVER[HTTP_HOST]."/", $_SERVER[HTTP_REFERER]))
	        alert("제대로 된 접근이 아닌것 같습니다.", $url);
	}
	
	/*************************************************************************
	**
	**  FILE 관련 함수 모음
	**
	*************************************************************************/	
	function getscriptpath( $scriptfilename )
	{
		$strbuffer = strrev( $scriptfilename );
		$pos = strpos( $strbuffer, "/" );
		$strbuffer = substr( $strbuffer, $pos + 1 );
		$strbuffer = strrev( $strbuffer );
		return $strbuffer;
	}
	
	function getfilename( $filepath )
	{
		$strbuffer = strrev( $filepath );
		$pos = strlen( $filepath ) - strpos( $strbuffer, "/" );
		$strbuffer = strrev( $strbuffer );
		$strbuffer = substr( $strbuffer, $pos );
		return $strbuffer;
	}
	
	function savefile( $file, $savepath )
	{
		$savefile = tempnam( $savepath, "OYD".time() );
		if( copy( $file, $savefile ) == 0 ) {
			popup( "파일 복사에 실패했습니다. 다시 시도해 주세요." );
			$savefile = "";
		}
		else chmod( $savefile, 0666 );
		unlink( $file );
		return $savefile;
	}


?>
<?php 
/*
version : 1.01
*/

function isimg($type){
	if($type >=1 && $type<=3){
		return true;
	}
	return false;
}
// gd에 사용될 임시 변수들 
$IsTrueColor = false; 
$Extension = null; 
function isImageEx($file){
	list($r_width, $r_height, $r_img_type) = getimagesize($_FILES[picture][tmp_name]);
	if($r_img_type<1 && $r_img_type > 3){
		return 0;
	}
	return 1;
}
// 이미지를 로딩하는 함수입니다. 
function scaleimage($location, $maxw=NULL, $maxh=NULL){
    $img = @getimagesize($location);
    if($img){
        $w = $img[0];
        $h = $img[1];

        $dim = array('w','h');
        foreach($dim AS $val){
            $max = "max{$val}";
            if(${$val} > ${$max} && ${$max}){
                $alt = ($val == 'w') ? 'h' : 'w';
                $ratio = ${$alt} / ${$val};
                ${$val} = ${$max};
                ${$alt} = ${$val} * $ratio;
            }
        }
		$sc[w] = $w;
		$sc[h] = $h;
        return($sc);
    }
}
function GDImageLoad($filename) 
{ 
      global $IsTrueColor, $Extension; 
      if( !file_exists($filename) ) return false; 
      $image_type = getimagesize($filename); 
      switch( $image_type[2] ) { 
              case IMAGETYPE_JPEG: // JPEG일경우 
                    $im = imagecreatefromjpeg($filename); 
                    $Extension = "jpg"; 
                    break; 
              case IMAGETYPE_GIF: // GIF일 경우 
                    $im = imagecreatefromgif($filename); 
                    $Extension = "gif"; 
                    break; 
              case IMAGETYPE_PNG: // png일 경우 
                    $im = imagecreatefrompng($filename); 
                    $Extension = "png"; 
                    break; 
              default: 
                    break; 
      } 

      $IsTrueColor = @imageistruecolor($im); 

      return $im; 
} 
function GetImageExt($filename) { 
      global $IsTrueColor, $Extension; 
      if( !file_exists($filename) ) return false; 
      $image_type = getimagesize($filename); 
      switch( $image_type[2] ) { 
           case IMAGETYPE_JPEG: // JPEG일경우 
                 $Extension = "jpg"; 
                 break; 
           case IMAGETYPE_GIF: // GIF일 경우 
                 $Extension = "gif"; 
                 break; 
           case IMAGETYPE_PNG: // png일 경우 
                 $Extension = "png"; 
                 break; 
           default: 
                 break; 
      } 
      return $Extension; 
} 

// 이미지 크기를 줄입니다. 
function GDImageResize($src_file, $dst_file, $width = NULL, $height = NULL, $type = NULL, $quality = 90) 
{ 
      global $IsTrueColor, $Extension; 
      $im = GDImageLoad($src_file); 
      if( !$im ) return false; 

      if( !$width ) $width = imagesx($im); 
      if( !$height ) $height = imagesy($im); 

      if( $IsTrueColor && $type != "gif" ) $im2 = imagecreatetruecolor($width, $height); 
      else $im2 = imagecreate($width, $height); 

      if( !$type ) $type = $Extension; 

      imagecopyresampled($im2, $im, 0, 0, 0, 0, $width, $height, imagesx($im), imagesy($im)); 
      if( $type == "gif" ) { 
              imagegif($im2, $dst_file); 
      } 
      else if( $type == "jpg" || $type == "jpeg" ) { 
              imagejpeg($im2, $dst_file, $quality); 
      } 
      else if( $type == "png" ) { 
              imagejpeg($im2, $dst_file, $quality); 
//              imagepng($im2, $dst_file); 
      } 
      imagedestroy($im); 
      imagedestroy($im2); 

      return true; 
} // 이미지 크기를 줄입니다. 

function makethumbsize($mw,$mh,$iw,$ih){
  if($mw<$iw){
    $pw = $mw / $iw;
    $iw = $mw;
    $ih = round($ih*$pw);
  }
  if($mh<$ih){
    $ph = $mh / $ih;
    $ih = $mh;
    $iw = round($iw*$ph);
  }
  $ret['w'] = $iw;
  $ret['h'] = $ih;
  return $ret;
}
function makethumbsizein($mw,$mh,$iw,$ih){
	$omw = $mw;	$omh = $mh;	$oiw = $iw;	$oih = $ih;
	if($mw<$iw){
		$pw = $mw / $iw;
		$iw = $mw;
		$ih = round($ih*$pw);
		if($ih <$mh){
			$ph = $omh / $oih;
			$ih = $omh;
			$iw = round($oiw*$ph);
		}
	}
	if($mh<$ih){
		$ph = $mh / $ih;
		$ih = $mh;
		$iw = round($iw*$ph);
		if($iw <$mw){
			$pw = $omw / $oiw;
			$iw = $omw;
			$ih = round($oih*$pw);
		}
	}
	$ret['w'] = $iw;
	$ret['h'] = $ih;
	return $ret;
}
function cropimage($src,$save,$wid,$hg){
	list($width, $height) = getimagesize($src) ;
	$sz = makethumbsizein($wid,$hg,$width,$height);
	//Set new Dimensions
	$tn = imagecreatetruecolor($wid, $hg) ;
	
	//$image = imagecreatefromjpeg($src) ;
	$image = GDImageLoad($src);// imagecreatefromjpeg($src) ;
	imagecopyresampled($tn, $image, 0, 0, ($sz[w]-$wid)/2,($sz[h]-$hg)/2, $sz[w], $sz[h] , $width, $height) ;
	
	imagejpeg($tn, $save, 100);
	imagedestroy($image); 
	imagedestroy($tn); 
}

function getExifInfo($erdata,$debug=0) {
	$exposureMode = array('Auto Exposure','Manual Exposure','Auto Bracket');
	$exposureProgram = array("Not defined","Manual","Program (Auto)","Aperture priority","Shutter priority","Creative program","Action program","Portrait mode","Landscape mode");
	$whiteBalance = array("Auto WB","Manual WB");
	$meteringMode = array("Unknown","Average","CenterWeightedAverage","Spot","MultiSpot","Multi-segment","Partial");
	$flash = array("73"=>"On Compulsory Red-eye reduction","89"=>"On Auto Red-eye reduction","95"=>"On Auto Red-eye reduction");
	
	if (!$erdata||!$erdata["EXIF"]) { return; }
	
	$exif["Make"] = $erdata["IFD0"]["Make"]; // 제조사
	$exif["Model"] = $erdata["IFD0"]["Model"]; // 모델
	$exif["ExifVersion"] = $erdata["EXIF"]["ExifVersion"]; // EXIF 버전
	$exif["DateTime"] = $erdata["EXIF"]["DateTimeOriginal"]; // 촬영일
	$exif["Software"] = $erdata["IFD0"]["Software"]; // 사용 Software
	$exif["Width"] = $erdata["EXIF"]["ExifImageWidth"]; // 사진 크기
	$exif["Height"] = $erdata["EXIF"]["ExifImageLength"]; // 사진 크기
	
	$exif["ExposureMode"] = $exposureMode[$erdata["IFD0"]["ExposureMode"]]; // 노출모드
	if (!$exif["ExposureMode"]) { $exif["ExposureMode"] = $exposureMode[$erdata["EXIF"]["ExposureMode"]]; }
	
	$tmp =  explode("/",$erdata["EXIF"]["ExposureTime"]); // 노출시간 (셔터스피드)
	if($tmp[0])	$exif["ExposureTime"] = $tmp[0]/$tmp[0]."/".$tmp[1]/$tmp[0]."s";
	
	$tmp=null;
	
	$tmp = explode("/",$erdata["EXIF"]["FNumber"]); // 조리개값
	$exif["FNumber"] = "F".sprintf("%3.1f",@($tmp[0]/$tmp[1]));
	$tmp=null;
	
	$exif["ISO"] = "ISO-".$erdata["EXIF"]["ISOSpeedRatings"];  // ISO 감도
	$exif["ExposureProgram"] = $exposureProgram[$erdata["EXIF"]["ExposureProgram"]];
	
	$exif["WhiteBalance"] = $whiteBalance[$erdata["IFD0"]["WhiteBalance"]]; // 화이트벨런스 
	if (!$exif["WhiteBalance"]) { $exif["WhiteBalance"] = $whiteBalance[$erdata["EXIF"]["WhiteBalance"]]; }
	
	
	$tmp = explode("/",$erdata["EXIF"]["ExposureBiasValue"]); // 노출보정
	$exif["ExposureBias"] = sprintf("%4.2f",@($tmp[0]/$tmp[1]))."EV";
	$tmp=null;
	
	$exif["MeteringMode"] = $meteringMode[$erdata["EXIF"]["MeteringMode"]]; // 측광모드
	
	if ($flash[$erdata["EXIF"]["Flash"]]) { $flash_str = " (".$flash[$erdata["EXIF"]["Flash"]].")"; } // 플래시사용여부
	$exif["Flash"] = @($erdata["EXIF"]["Flash"]&7)>0?"Flash fired":"Flash not fired";
	
	$tmp = explode("/",$erdata["EXIF"]["FocalLength"]); // 초점거리
	$exif["FocalLength"] = @($tmp[0]/$tmp[1])."mm";
	$tmp=null;
	
	$tmp = (int)$erdata["COMPUTED"]["CCDWidth"]; // CCD
	if ($tmp>0) {
		$exif["CCDWidth"] = $tmp."mm";
	}
	$tmp=null;
	
	$exif["FocalLengthIn35mmFilm"] =  $erdata["EXIF"]["FocalLengthIn35mmFilm"]." mm"; // 35인치 환산값
	$exif["DigitalZoomRatio"] = $erdata["EXIF"]["DigitalZoomRatio"]; // 줌
	$exif["FirmwareVersion"] = $erdata["MAKERNOTE"]["FirmwareVersion"]; // 펌웨어 버전
	$exif["Lens"] = $erdata["MAKERNOTE"]["UndefinedTag:0x0095"]; // 사용랜즈 Canon Body & Canon Lens Only 
	
	while(list($k,$v)=each($exif)) {
		if ($v&&trim($v)!="F"&&trim($v)!="ISO-"&&trim($v)!="EV"&&trim($v)!="mm"&&trim($v)!="s") { $exif_data[$k] = $v; }
	}
	
	if ($debug) {
		echo "<pre>";
		print_r($erdata);
		echo "</pre>";
	}
	return $exif_data;
} 
function getgps($exif){
	if ($exif) {
		$gps_lat = null;$gps_lon = null;$gps_ele = null;
		if ($exif["GPS"]) { 
			if ($exif["GPS"]["GPSLatitude"] && $exif["GPS"]["GPSLongitude"]) { //위경도 좌표가 있다면
				list($temp_d1, $temp_d2) = sscanf($exif["GPS"]["GPSLatitude"][0], "%d/%d"); //문자->숫자로 계산
				$gps_lat_d = $temp_d1/$temp_d2;
				list($temp_d1, $temp_d2) = sscanf($exif["GPS"]["GPSLatitude"][1], "%d/%d");
				$gps_lat_m = $temp_d1/$temp_d2;
				list($temp_d1, $temp_d2) = sscanf($exif["GPS"]["GPSLatitude"][2], "%d/%d");
				$gps_lat_s = $temp_d1/$temp_d2;
				list($temp_d1, $temp_d2) = sscanf($exif["GPS"]["GPSLongitude"][0], "%d/%d"); //문자->숫자로 계산
				$gps_lon_d = $temp_d1/$temp_d2;
				list($temp_d1, $temp_d2) = sscanf($exif["GPS"]["GPSLongitude"][1], "%d/%d");
				$gps_lon_m = $temp_d1/$temp_d2;
				list($temp_d1, $temp_d2) = sscanf($exif["GPS"]["GPSLongitude"][2], "%d/%d");
				$gps_lon_s = $temp_d1/$temp_d2;
				$gps_lat = $gps_lat_d+$gps_lat_m/60+$gps_lat_s/3600; //도분초를 도로 변환
				$gps_lon = $gps_lon_d+$gps_lon_m/60+$gps_lon_s/3600;
				
				//				list($temp_d1, $temp_d2) = sscanf($exif["GPS"]["GPSAltitude"], "%d/%d"); //문자->숫자로 계산
				//				$gps_ele = $temp_d1/$temp_d2;
				//echo "GPS lat d, m, s :($gps_lat) $gps_lat_d, $gps_lat_m, $gps_lat_s<br />";
				//echo "GPS lon d, m, s :($gps_lon) $gps_lon_d, $gps_lon_m, $gps_lon_s<br />";
				//echo "GPS lat, lon, ele : $gps_lat, $gps_lon, $gps_ele<br />";
			}
		}
	}
	$ret[lat] = $gps_lat;
	$ret[lon] = $gps_lon;
	return $ret;
}

function ImageRotates($src_file,$angle){
	global $IsTrueColor, $Extension; 
	$im = GDImageLoad($src_file); 
      if( !$im ) return false; 
	
	if( !$width ) $width = imagesx($im); 
	if( !$height ) $height = imagesy($im); 
	
	if( $IsTrueColor && $type != "gif" ) $im2 = imagecreatetruecolor($width, $height); 
	else $im2 = imagecreate($width, $height); 
	
	if( !$type ) $type = $Extension; 
	
	imagecopyresampled($im2, $im, 0, 0, 0, 0, $width, $height, imagesx($im), imagesy($im)); 
	$im2=imagerotate($im2, $angle,$a);
	imagejpeg($im2, $src_file, 100); 
	imagedestroy($im); 
	imagedestroy($im2); 
	return true; 
}
class cimage{
	public $m_file;
	public $m_width;
	public $m_height;
	public $m_type;
	function cimage($file){
		$this->set($file);
	}
	function set($file){
		$this->m_file = $file;
		list($r_width, $r_height, $r_img_type) = getimagesize($file);
		if(isimg($r_img_type) == false){
			$this->m_type = false;
			return 0;
		}else{
			$this->m_width = $r_width;
			$this->m_height = $r_height;
			$this->m_type = $r_img_type;
			return 1;
		}
	}
	function width(){
		return $this->m_width;
	}
	function height(){
		return $this->m_height;
	}
	function getType(){
		return $this->m_type;
	}
	function resize($w,$h,$out){
		if($this->m_type !=false){
			$msize = makethumbsize($w,$h,$this->m_width,$this->m_height);
			GDImageResize($this->m_file, $out, $msize[w],$msize[h]) ;
			return 1;
		}
		return 0;
	}
	function resizenor($w,$h,$out){
		if($this->m_type !=false){
			GDImageResize($this->m_file, $out, $w,$h);
			return 1;
		}
		return 0;
	}
	function crop($w,$h,$out){
		if($this->m_type !=false){
			cropimage($this->m_file, $out,$w,$h);
			return 1;
		}
		return 0;
	}

}
?>
<?
//include "code_key.php";
header("Content-type:image/png");
    $width= "86";
    $height="21";
    $im = imagecreate($width,$height);
    $white = imagecolorallocate($im,255,255,255);
    $gray = imagecolorallocate($im,80,80,80);
    $rightgray = imagecolorallocate($im,204,204,204);
    // 원그리기 시작위치y 시작위치x 크기 x 크기 y
    for($i=15;$i<=585;$i+=rand(20,35)){ // 가로 시작점
        $f = rand(10,50);    // 세로 시작점
        $b = rand(3,5);        // 원의 크기
        ImageArc ($im, $i, $f, $b, $b, 0, 360, $gray); // 원 그리기
        ImageFill ($im, $i, $f, $gray); //그린원에 색채우기
    }
    // 격자 무늬 넣기
    $num = rand(0,5);
        for ($i=$num; $i<=$width; $i+=rand(15,20)){  // 가로 선
            imageline($im,$i,0,$i,$height,$rightgray);
        }
        for ($i=$num; $i<=$height+10; $i+=rand(10,15)){ //세로 선
            imageline($im,0,$i,$width,$i,$rightgray);
    }
    $write_code = substr(md5($_GET[time_key]),0,6);//write_code($_GET[time_key]);
	
    // 문자 만들기
    //$text = $_zb_path."font/gulim.ttc";
    //$text = $_zb_path."font/h2mkrb.ttf";
    //$text = $_zb_path."font/h2mkpb.ttf";
    $code_text = "($write_code[0])($write_code[1])  $write_code[5]";
    //imagettftext($im, 14, 1, 10, 30, $gray, "arial.ttf", $code_text); // 폰트크기,기울기,가로세로시작점
    $white = ImageColorAllocate($im, 255,5,100); 
	ImageString($im,13,15,2,$write_code,$white);
	//print_r($code_text); 
    imagepng($im);
    imagedestroy($im);
        
?>

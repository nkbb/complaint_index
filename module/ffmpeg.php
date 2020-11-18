<?php

function makeMultipleTwo ($value){
	$sType = gettype($value/2);
	if($sType == "integer"){
		return $value;
	} else {
		return ($value-1);
	}
}
function getInfo($srcfile){
	$ffmpegPath = "c:/ffmpeg.exe";
	$ffmpegPath2 = "c:/ffmpeg/convert.exe";
	
	$cmd = $ffmpegPath2 . " -i \"" . $srcfile . "\" -an -ss 1.000 -r 1 -vframes 1 -f mjpeg -y  \"c:\\" . getguid("ffmpg") .".jpg\" 2>&1" ;
	$fh = popen( $cmd, "r" );	
	while($rtv = fgets( $fh ) ) {$rt.=$rtv; }pclose( $fh );
	$exs = substr(strstr($rt, 'Duration: '),10,8);
	$sts = explode(":",$exs);
	$r = ($sts[0]*60*60)+($sts[1]*60)+$sts[2];
	return $r;
}
function convflv($srcfile,$destFile,$thumbfile,$pos=2){
	$len = getInfo($srcfile);
	$ffmpegPath = "c:/ffmpeg.exe";
	$ffmpegPath2 = "c:/ffmpeg/convert.exe";
	$ef = $ffmpegPath2 . " -i \"" . $srcfile . "\" -ar 22050 -ab 96 -f flv  -y \"" . $destFile ."\"";
	//$efjpg = $ffmpegPath2 . " -i \"" . $srcfile . "\" -an -ss 1.000 -r 1 -vframes 1 -f mjpeg -y  \"" . $thumbfile ."\"" ;
	for($i=0;$i<5;$i++){
		$nSec = round($len/5*$i);
		$efjpg = $ffmpegPath2 . " -i \"" . $srcfile . "\" -an -ss $nSec -r 1 -vframes 1 -f mjpeg -y  \"" . $thumbfile ."_$i\"" ;
		exec($efjpg);
	}
	
	//$ef = "ffmpeg -i $srcfile  -ar 22050  -f  flv -s 400x300 -y $destFile";
	exec($ef);
//	exec($efjpg);
	return 100;
	/*
	---------------------------
	ex
	---------------------------
	-i "G:\MVI_2071.avi" -an -ss 1.000 -r 1 -vframes 1 -f mjpeg -y "C:\show\output.jpg"
	---------------------------
	확인   
	---------------------------
		
	*/
}

function convflv3($srcfile,$destFile,$thumbfile,$pos=2){
	$ffmpegObj = new ffmpeg_movie($srcfile);
	$tm= $ffmpegObj->getDuration();
	$nppr = $ffmpegObj->getFrameCount();
	$frame = $ffmpegObj->getFrame(round($nppr/$pos));
	imagejpeg($frame->toGDImage(),$thumbfile);
	// Save our needed variables
	$srcWidth = makeMultipleTwo($ffmpegObj->getFrameWidth());
	$srcHeight = makeMultipleTwo($ffmpegObj->getFrameHeight());
	$srcFPS = $ffmpegObj->getFrameRate();
	$srcAB = intval($ffmpegObj->getAudioBitRate()/1000);
	$srcAR = $ffmpegObj->getAudioSampleRate();
	// Call our convert using exec()
	$ffmpegPath = "ffmpeg";
	$flvtool2Path = "flvtool2";
	$ef = $ffmpegPath . " -i '" . $srcfile . "' -ar " . $srcAR . " -ab " . $srcAB . " -f flv -s " . $srcWidth . "x" . $srcHeight . " -y " . $destFile . " ; " . $flvtool2Path . " -U stdin " . $destFile;
	//$ef = "ffmpeg -i $srcfile  -ar 22050 -ab 96 -f  flv -s 400x300 -y $destFile";
	exec($ef);
	return $tm;
}
?>
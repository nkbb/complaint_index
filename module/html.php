<?
function ga($arg,$binit=0){
	static $point=0;
	$rt = $arg[$point];
	$point++;
	if($binit ==1) {
		$point =0;
	}else	echo($rt);
}
function removecustomtag($htmltag){
	$ncnt = 100;
	while($ncnt){
		$rspos = strpos($htmltag, "##__:",0);
		if($rspos ===false) break;
		$repos = strpos($htmltag, ":__##",0);
		if($repos ===false) break;
		$strcustag = substr($htmltag,$rspos,($repos-$rspos)+5);
		$htmltag = str_replace($strcustag,"",$htmltag);
		$ncnt--;
		if($ncnt <=0) break;
	}
	return $htmltag;
}
function applyhtml($html){
	$nsz = func_num_args() -1;
	$args = func_get_args();
	for($i = 0 ; $i<$nsz; $i++)	{
		$findk = sprintf("##__:%d:__##",$i);
		$html = str_replace($findk,$args[$i+1],$html);
	}
	return (removecustomtag($html));
}
function applygethtml($html){
	$nsz = func_num_args() -1;
	$args = func_get_args();
	for($i = 0 ; $i<$nsz; $i++)	{
		$findk = sprintf("##__:%d:__##",$i);
		$html = str_replace($findk,$args[$i+1],$html);
	}
	return(removecustomtag($html));
}
function applyarrhtml($html,$arrquery){
	foreach($arrquery as $key => $value){
		$findk = sprintf("##__:%s:__##",$key);
		$html = str_replace($findk,$value,$html);
	}
	return (removecustomtag($html));
}
function applymaphtml($html,$arrmap){
	$ret = "";
	$nsz = count($arrmap);
	for($i=0; $i<$nsz; $i++)	{
		$ret .= applyarrhtml($html,$arrmap[$i]);
	}
	return $ret;
}



?>

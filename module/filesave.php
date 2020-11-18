<?
include_once "gd.php";
function savefileex($file,$target){
	if($file[name]){
		$oriname = $file[name];
		//$pr = explode(".",$oriname);
		$tfile = "./$target/".GetGUID($oriname);
		move_uploaded_file($file["tmp_name"], $tfile);
		return $tfile;
	}else return "";
}
function saveimage($file,$target,$ind,$w,$h){
	$tfile = "./$target/".$ind;
	GDImageResize($file["tmp_name"], $tfile, $w,$h);
}

?>

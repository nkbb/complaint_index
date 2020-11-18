<?php
function Yin_user($dir_session = "c:/xampp/tmp"){

	$time1 = 6 * 1000;
	$time2 = 6 * 2000;
	if (empty($dir_session)) return Array();
	if (!is_dir($dir_session)) return Array();

	$dir_array = Yget_filelist_in_dir($dir_session);
	$return = Array();
	$i = 1;
	foreach($dir_array as $val){
	if (filemtime($val) < (time() - $time2)) continue;

			$text = Yread_file($val);
			if($text)			$return[] = $text;
		$i++;
	}
	
	return $return;
}
function Yget_filelist_in_dir($dir_path){
  $dir_path = preg_replace("`/+$`", '', $dir_path);
  if(!is_dir($dir_path)) return Array();

  $return_file = Array();

	$d = dir($dir_path);
	if($d){
		while (false !== ($entry = $d->read())) {

		$temp_file = $dir_path . '/' . $entry;
		if (is_file($temp_file) && !preg_match("`\.$`", $temp_file)) {

		  $return_file[] = $temp_file;
		}
		}

		$d->close();
	}
  return $return_file;
}
function Yread_file ($read_file_path){

	if (empty($read_file_path) || !file_exists($read_file_path)) return false;

	if (is_readable($read_file_path) !== true) return "";

	$fr = @fopen($read_file_path, "r");
	
	if (empty($fr)) return false;

	$filesize = filesize($read_file_path);
	if (empty($filesize)) $filesize = 1024;
	$read_text = fread($fr, $filesize);
	fclose($fr);

	if (empty($read_text))  return false;

	return $read_text;
}
function sessgetdata($kdata,$skey){
	$pp2 = strpos($kdata,"\"$skey\";s:");
	if($pp2 !== false){
		$sd = substr($kdata,$pp2+9,100);
		$pp3 = strpos($sd,";s:");
		if($pp3 !== false) {
			$sd = substr($sd,0,$pp3);
			$sd = strstr($sd,"\"");
			$sd = str_replace("\"","",$sd);
		}
	}
	return $sd;
}
function sessgetkey($kdate,$skey,$user){
	$countins = 0;
	$countno = 0;
	$countus = 0;
	if($user->datas[ind]){
		$sd[ind] = $user->datas[ind];
		$sd[id] = $user->datas[id];
		$sd[name] = $user->datas[name];

		$uname[]= $sd;
		$countins = 1;
		$countus = 1;
	}else{
		$countins = 1;
		$countno = 1;
	}
	//print_r($kdate);
	$nsz = count($kdate);
	for($i=0;$i<$nsz;$i++){
		$pp = strpos($kdate[$i],$skey);
		if($pp !== false){
			$countins++;
			$sd[ind] = sessgetdata($kdate[$i],"ind");
			$sd[id] = sessgetdata($kdate[$i],"id");
			$sd[name] = sessgetdata($kdate[$i],"name");
			$nsz2 = count($uname);
			$isalready = 0;
			for($j = 0; $j<$nsz2; $j++){
				if($uname[$j][ind] == $sd[ind])$isalready = 1;
			}
			if($sd[ind] && $isalready == 0){
				$uname[] = $sd;
				$countus ++;
			}else{
				$countno++;
			}
		}
	}
	$udata[count] = $countins;
	$udata[nologin] = $countno;
	$udata[login] = $countus;
	$udata[data] = $uname;
	return $udata;
}

?>
<?
/*
version : 1.01
*/
function inc($file,$def=null){
	if(file_exists($file)){
		include $file;
		return 1;
	}else{
		if(file_exists($def)){
			include $file;
			return 1;
		}else{
			return 0;
		}
	}
}
function inc_once($file,$def=null){
	if(file_exists($file)){
		include_once $file;
		return 1;
	}else{
		if(file_exists($def)){
			include $file;
			return 1;
		}else{
			return 0;
		}
	}
}
class cfile{

}



?>
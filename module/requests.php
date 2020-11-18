<?php
class Requests{

	public $m_post;
	public $m_get;
	public $m_file;
	

	function getguids($cd){
		return md5(microtime(true).$cd); 
	}
	function request(){
		global $_GET;
		global $_POST;
		global $_FILES;
		$this->m_post = $_POST;
		$this->m_get = $_GET;
		$this->m_file = $_FILES;
	}
	function get(){
		return $this->m_get;
	}
	function post(){
		return $this->m_post;
	}
	function file(){
		return $this->m_file;
	}
	function getkey($key){
		return $this->m_get[$key];
	}
	function postkey($key){
		return $this->m_post[$key];
	}
	function filekey($key){
		return $this->m_file[$key];
	}
	function isfile($name){
		$file = $this->m_file[$name];
		if($file[error] == 0){ 
			return 1;
		}else{
			return 0;
		}
	}
	function getfilelen($name){
		$file = $this->m_file[$name];
		$size =$file['size'];
		return $size;
	}
	function gettmpname($name){
		$file = $this->m_file[$name];
		if($file[error] == 0){
			$otfnamestr = $file[tmp_name];
		}
		return $otfnamestr;	
	}
	function getfilename($name){
		$file = $this->m_file[$name];
		return $file["name"];
	}
	function savefile($name,$filename){
		$file = $this->m_file[$name];
		if($file[error] == 0){
			$otfnamestr = $this->m_file[$name]['tmp_name'];
			$otfname =  $filename;
			if(move_uploaded_file($otfnamestr,$otfname )){
				return $file[size];
			}
		}
		return 0;
	}
	
};
?>
<?
class esess{
	public $m_data;
	public $m_islogin;
	public $m_key;
	public $m_user;
	function datainit(){
		unset($this->m_data);
		$this->m_islogin = 0;
	}
	function esess($key){
		$this->m_key = $key;
	}
	function login($ind,$id,$data){
		$this->m_user[ind]=$ind;
		$this->m_user[id] = $id;
		$this->m_user[data] = $data;
		$this->m_islogin = 1;
		$this->refreshlogin();
	}
	function setlevel($lv){
		if($this->m_user[ind]){
			$this->m_user[level] = $lv;
			$this->refreshlogin();
		}
		
	}
	function logout(){
		$this->datainit();
		$this->setSession($this->m_key . "_LOGIN",""); 
	}
	function refreshlogin(){
		$this->setSession($this->m_key . "_LOGIN",$this->m_user); 
	}
	function setSession($key,$val){
		global $_SESSION;
		$_SESSION[$key] = $val;
	}
	function getSession($key){
		global $_SESSION;
		return $_SESSION[$key];
	}
	function getind(){
		$this->m_user = $this->getSession($this->m_key . "_LOGIN");
		return $this->m_user[ind];
	}
	function getlogin(){
		$this->m_user = $this->getSession($this->m_key . "_LOGIN");
		return $this->m_user;
	}
};
try{
session_start();
}catch(Exception $e){
}
?>
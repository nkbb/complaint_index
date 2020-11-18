<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once './application/libraries/CIBase.php';

class Main extends CIBase {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		$this->sethistory(1);
		if(!$this->sess_user('is_user_login')){
			//$db_slide = $this->dbBase('slide_img');
			$db_company = $this->dbBase('company');

			//$data['slide'] = $db_slide->select("url","where type = 1 and status = 1 order by ind DESC ");
			$data['abouts'] = $db_company->selone("email","where ind = 1 ");
			
			$this->load->view('index', $data);
		}else{
			redirect('admin', 'refresh');
		}
		
	}

	public function map(){
		$this->load->view('map');
	}

	public function admin(){
		$this->check_level();
		$db_comp = $this->dbBase("complaint");
		$db_unit = $this->dbBase("unit");

		$data["count-type0"] = "";
		$data["count-type2"] = "";
		$data["count-type3"] = "";
		$data["count-type4"] = "";
		if($this->sess_user('id')=="root" || $this->sess_user('id')=="admin"){
			$count = $db_comp->selone("count(ind) as ct","where type = 2 ");
			$data["count_type2"] = $count["ct"];

			$count = $db_comp->selone("count(ind) as ct","where type = 3 ");
			$data["count_type3"] = $count["ct"];

			$count = $db_comp->selone("count(ind) as ct","where type = 4 ");
			$data["count_type4"] = $count["ct"];

			$count = $db_comp->selone("count(ind) as ct","where (type = 0 || type = 6) ");
			$data["count_type0"] = $count["ct"];
		}else{

			$unit = $this->sess_user('unit');

			$data['show_unit'] = $db_unit->selone('name',"where ind = '$unit' ");

			$count = $db_comp->selone("count(ind) as ct","where type = 3 and send_unit = '$unit' ");
			$data["count_type3"] = $count["ct"];

			$count = $db_comp->selone("count(ind) as ct","where type = 4 and send_unit = '$unit'");
			$data["count_type4"] = $count["ct"];

			$count = $db_comp->selone("count(ind) as ct","where (type = 5 or type = 6) and send_unit = '$unit'");
			$data["count_type"] = $count["ct"];

		}

		$this->load->view('admin', $data);
	}

	public function login(){
		$data = array();
		$this->load->view('login', $data);
	}

	public function checklogin(){
		$pd = $this->input->post();
		$fpd = $this->dbBase("user_info");

		$uname = addslashes($this->input->post('username'));
		$password = md5(base64_decode("@PW".$pd["password"]."pw+-"));
		$item = $fpd->selone("","WHERE id ='$uname' and pw='$password' and type = 1 ");
		if (!empty($item)){

			$this->session->set_userdata(array(
				'token' => $item['token'], 
				'id' => $item['id'],
				'fname' => $item['auth_fname'],
				'lname' => $item['auth_lname'],
				'posititon' => $item['posititon'],
				'level' => $item['level'],
				'unit' => $item['unit'],
				'is_user_login' => true
			));
			redirect('admin', 'refresh');

		}else{
			redirect('login?alerts=error', 'refresh');
		}
		
	}

	public function logout(){
		$this->session->sess_destroy();	
		redirect('main', 'refresh');
	}

	public function loadamphur(){
		$id= $this->input->get('id');

		$fpd = $this->dbBase("th_amphur");
		$item = $fpd->select("amphur_id, amphur_name","where province_id = '$id'  order by  amphur_name ASC");
		$data["item"] = $item;
		echo json_encode($data);
	}

	public function loaaddistrict(){
		$id= $this->input->get('id');

		$fpd = $this->dbBase("th_district");
		$item = $fpd->select("district_id, district_name","where amphur_id = '$id'  order by  district_name ASC");
		$data["item"] = $item;
		echo json_encode($data);
	}

	public function loadcomplaintsub(){
		$id = $this->input->get('type');

		$fpd = $this->dbBase("complaint_sub");
		$item = $fpd->select("ind, name, complaint_type","where complaint_type = '$id'  order by  num ASC");
		$data["item"] = $item;
		echo json_encode($data);

	}

	public function showques(){
		$db_question = $this->dbBase('question');

		$type = $this->input->get('type'); 

		if(isset($type) && !empty($type)){
			$data['type'] = $type;
		}else{
			$data['type'] = '';
		}

		$data['item'] = $db_question->select("","where type = 1 order by orders ASC ");

		$this->load->view('_model_ques', $data);
	}

	public function showmanual(){
		$db_question = $this->dbBase('question');

		$data = "";
		$this->load->view('_model_manual', $data);
	}

	public function test2(){
		$this->send_sms('11111','0909736260');
	}

	

	
}
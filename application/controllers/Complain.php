<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once './application/libraries/CIBase.php';

class Complain extends CIBase {

	public function index()
	{
        $db_company = $this->dbBase('company');
        $data = $db_company->selone("conditions","where ind = 1");
		$this->load->view('complain', $data);
		
    }
    
    public function register(){
        $this->sethistory(1);
        $accept = $this->input->post('accept');
        if($accept=="Y"){

            $db_unit = $this->dbBase("unit");
            $db_type = $this->dbBase("complaint_type");
            $db_prov = $this->dbBase("th_province");
            $db_person_type = $this->dbBase("complaint_person");

            $data['unit'] = $db_unit->select("ind, name","where type = 1 order by ind ASC  ");
            $data['province'] = $db_prov->select("province_id, province_name","where 1 order by province_name ASC  ");
            $data['comp_type'] = $db_type->select("ind, name, num","where type != 0 order by num ASC  ");
            $data['token'] = $this->getToken();
            $data['complaint_person'] = $db_person_type->select("","where type != 0 order by num ASC");

            $this->load->view('complain_register', $data);
        }else{

        }     
    }

    public function savedata(){

        $gd = $this->input->post();
        $db_complaint = $this->dbBase("complaint");

        $token = $gd['token'];
        $upd = array();

        if($token){

            $upd['token'] = $gd['token'];
            $upd['complaint_method'] = (isset($gd['complaint_method'])) ? $gd['complaint_method'] : '';
            $upd['complain_level'] = (isset($gd['complain_level'])) ? $gd['complain_level'] : '';
            $upd['fname'] = $gd['fname'];
            $upd['lname'] = $gd['lname'];
            $upd['idcard'] = $gd['idcard'];
            $upd['sex'] = $gd['sex'];
            $upd['work'] = $gd['work'];
            $upd['address'] = $gd['address'];
            $upd['province'] = $gd['province'];
            $upd['amphur'] = $gd['amphur'];
            $upd['district'] = $gd['district'];
            $upd['zipcode'] = $gd['zipcode'];
            $upd['tel'] = $gd['tel'];
            $upd['fax'] = $gd['fax']; 
            $upd['phone'] = $gd['phone']; 
            $upd['email'] = $gd['email']; 
            $upd['office_unit'] = $gd['office_unit'];
            $upd['complaint_type'] = $gd['complaint_type'];
            $upd['complaint_sub'] = $gd['complaint_sub'];
            $upd['complaint_person'] = $gd['complaint_person'];
            $upd['name'] = $gd['name'];
            $upd['description'] = $gd['description'];
            $upd['improvement'] = $gd['improvement'];
            $upd['location'] = $gd['location'];
            $upd['location_date'] = (!empty($gd['location_date'])) ? $gd['location_date'] : '0000-00-00 00:00:00';

            $upd["files"] = "";
            if(isset($_FILES["file"]) && !empty($_FILES['file'])){
                $valid_extensions = array('jpeg', 'jpg', 'png', 'pdf' , 'doc'); // valid extensions
                $path = "assets/files/"; 
                $img = $_FILES['file']['name'];
                $tmp = $_FILES['file']['tmp_name'];
                $size = $_FILES['file']['size'];

                $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                if($size > '11097152'){
                    $data['code'] = "error";
                    $data['message'] = "กรุณาเลือก ไฟล์ที่แนบไม่เกิน 10 MB";
                    echo json_encode($data);
                    exit();
                }

                $final_image = rand(1000,1000000).$img;
                $name_image = substr(md5($final_image),15,2)."".substr(md5($final_image),0,10).".".$ext;
                if(in_array($ext, $valid_extensions)) 
                { 
                    $path = $path.strtolower($name_image);
                    if(move_uploaded_file($tmp,$path)){
                      $upd["files"] = $name_image;  
                    }
                }
            }
            

            $upd["complaint_method"] = "1";
            $upd["type_add"] = "1";
            if(isset($gd['status'])){
                if($gd["status"]!="on"){
                    $upd["status"] = "0";
                }else{
                    $upd["status"] = "1";
                }
            }else{
                $upd["status"] = "1";
            }

            $c_complaint = $db_complaint->selone("ind","where token = '$token' ");
            if($c_complaint){
                $upd['date_add'] = date("Y-m-d H:i:s");
                $db_complaint->modifyex($upd, "token", $token);
            }else{
                $upd['code'] = "";
                $upd['complaint_method'] = 1;
                $upd['complain_level'] = "";
                $upd['user_add'] = "";
                $upd['del_user'] = "";
                $upd['del_date'] = date("Y-m-d H:i:s");
                $upd['send_user'] = "";
                $upd['send_date'] = date("Y-m-d H:i:s");
                $upd['receive_user'] = "";
                $upd['receive_date'] = date("Y-m-d H:i:s");
                $upd['answer_detail'] = "";
                $upd['answer_file'] = "";
                $upd['answer_name'] = "";
                $upd['answer_date'] = date("Y-m-d H:i:s");
                $upd['finish_user'] = "";
                $upd['finish_date'] = date("Y-m-d H:i:s");
                $upd['type'] = 1;
                $upd['date_add'] = date("Y-m-d H:i:s");

                $db_complaint->ins($upd);
            }

            $data['token'] = $token;
            $data['code'] = "success";
        }else{
            $data['message'] = "";
            $data['code'] = "error";
        }
        
        echo json_encode($data);
    }

    public function show(){
        $token = $this->gd('token');
        $db_complaint = $this->dbBase("complaint");
        $data = $db_complaint->selone("","where token = '$token' ");
        $data['addressfull'] = $this->getfulldate($data['province'], $data['amphur'],  $data['district'], $data['zipcode']);

        $ppages=str_replace(" ","&nbsp;",$data["description"]); 
        $ppages2=str_replace(array("\r\n","\r","\n"),"<br/>",$ppages);
        $data["description"] = $ppages2;

        $ppages=str_replace(" ","&nbsp;",$data["improvement"]); 
        $ppages2=str_replace(array("\r\n","\r","\n"),"<br/>",$ppages);
        $data["improvement"] = $ppages2;

        $data['office_name'] = $this->getunit($data["office_unit"]);
        $data['complain_type'] = $this->getcomplainttype($data["complaint_type"]);

        $data["complain_sub"] = $this->getcomplaintsub($data["complaint_sub"]);

        $this->load->view('_model_showcomplain', $data);
    }

    public function accept(){
        $token = $this->pd('token');
        $db_complaint = $this->dbBase("complaint");
        if($token){
            $upd['code'] = $this->createCode();
            $upd['date_add'] = date("Y-m-d H:i:s");
            $upd['type'] = 2;
            $db_complaint->modifyex($upd, "token", $token);
            $this->sendLineGroupAdmin($token,2);

            redirect('complain/finish?token='.$token, 'refresh');
        }else{
            redirect('main', 'refresh');
        }
    }

    public function finish(){

        $this->sethistory(1);
        $token = $this->gd('token');
        $db_complaint = $this->dbBase("complaint");
        if($token){
            $data = $db_complaint->selone("code","where token = '$token' ");

            $this->load->view('complain_finish', $data);
        }else{
            redirect('main', 'refresh'); 
        }

    }

    public function follow($type = ""){
        $this->sethistory(1);
        $data["type"] = $type;

        $this->load->view('complain_follow', $data);
    }

    public function detail($code = ""){
        //$code = $this->input->get("code");
        $this->sethistory(1);

        if($code != "") {
            $code = urldecode($code);
            $db_complaint = $this->dbBase("complaint");
            $db_com_comment = $this->dbBase("complaint_comment");            
            $item = $db_complaint->selone("","where code = '$code' and type != 1 ");
            if(!$item){
               redirect('complain/follow/error', 'refresh');  
            }

        } else {
            redirect('complain/follow/error', 'refresh'); 
        }

        $item['office_name'] = $this->getunit($item["office_unit"]);
        $item['complain_type'] = $this->getcomplainttype($item["complaint_type"]);
        $item['showdate_add'] = $this->getDateThis4($item['date_add']);
        $item['showdate_send'] = $this->getDateThis4($item['send_date']);
        $item['showdate_receive'] = $this->getDateThis4($item['receive_date']);
        $item['showdate_answer'] = $this->getDateThis4($item['answer_date']);

        if($item['type'] == 2){
            $item['datediff'] = $this->DateDiff($item["date_add"],date("Y-m-d"));
        }

        if($item['type'] == 3){
            $item['datediff'] = $this->DateDiff($item["send_date"],date("Y-m-d"));
        }

        if($item['type'] == 4){
            $item['datediff'] = $this->DateDiff($item["receive_date"],date("Y-m-d"));
        }

        if($item['type'] == 5){
            $item['datediff'] = $this->DateDiff($item["answer_date"],date("Y-m-d"));
        }
        if($item['type'] == 6){
            $item['datediff'] = $this->DateDiff($item["date_add"],$item["answer_date"]);
        }

        $data = $item;
        $this->load->view('complain_detail', $data);
    }

    public function create() {

        $this->check_level('admin');

        $db_unit = $this->dbBase("unit");
        $db_type = $this->dbBase("complaint_type");
        $db_prov = $this->dbBase("th_province");
        $db_method = $this->dbBase("complaint_method");
        $db_person_type = $this->dbBase("complaint_person");

        $data['unit'] = $db_unit->select("ind, name","where type = 1 order by ind ASC  ");
        $data['province'] = $db_prov->select("province_id, province_name","where 1 order by province_name ASC  ");
        $data['comp_type'] = $db_type->select("ind, name, num","where type != 0 order by num ASC  ");
        $data['token'] = $this->getToken();
        $data['complaint_method'] = $db_method->select("","where type = 1 order by num ASC");
        $data['complaint_person'] = $db_person_type->select("","where type != 0 order by num ASC");

        $this->load->view('complain_create', $data);
    }

    public function check_complaint_id() {
        $data = $this->input->post(); print_r($data);
        if(!empty($data)) {
            $_SESSION['complaint_id'] = $data['id'];
        }
    }

    public function success(){
        $this->check_level('admin');
        $type = $this->gd('type');
        $data['type'] = $type;
        $this->load->view('complain_success', $data); 
    }

    public function edit($token){
        $this->check_level('admin');

        $db_complaint = $this->dbBase("complaint");
        $db_com_comment = $this->dbBase("complaint_comment");
        $db_sub = $this->dbBase("complaint_sub");
        $db_log = $this->dbBase("complaint_log");
        $db_user = $this->dbBase("user_info");
        $db_unit = $this->dbBase("unit");
        $db_type = $this->dbBase("complaint_type");
        $db_prov = $this->dbBase("th_province");
        $db_distr = $this->dbBase("th_district");
        $db_amphur = $this->dbBase("th_amphur");
        $db_person_type = $this->dbBase("complaint_person");

        $item = $db_complaint->selone("","where token = '$token' ");

        $data['unit'] = $db_unit->select("ind, name","where type = 1 order by ind ASC  ");
        $data['province'] = $db_prov->select("province_id, province_name","where 1 order by province_name ASC  ");
        $data['comp_type'] = $db_type->select("ind, name, num","where type != 0 order by num ASC  ");
        $data['complaint_person'] = $db_person_type->select("","where type != 0 order by num ASC");
        $data['amphur'] = $db_amphur->select("amphur_id, amphur_name","where province_id = '$item[province]' ");
        $data['district'] = $db_distr->select("district_id, district_name","where amphur_id = '$item[amphur]' ");


        if(!empty($item['complaint_sub'])){
            $data['complaint_sub'] = $db_sub->select("ind, name, complaint_type","where complaint_type  ='$item[complaint_type]' and type != 0 order by num ASC ");
        }else{
            $data['complaint_sub'] = array();
        }

        $data['item'] = $item;

        // echo '<pre>';print_r($data);exit();
        $this->load->view('complain_edit', $data); 
    }

    public function update(){
        $this->check_level('admin');
        $pd = $this->pd();

        $db_complaint = $this->dbBase("complaint");

        $upd['ind'] = $pd['ind'];
        $upd['fname'] = $pd['fname'];
        $upd['lname'] = $pd['lname'];
        $upd['idcard'] = $pd['idcard'];
        $upd['sex'] = $pd['sex'];
        $upd['work'] = $pd['work'];
        $upd['address'] = $pd['address'];
        $upd['province'] = $pd['province'];
        $upd['amphur'] = $pd['amphur'];
        $upd['district'] = $pd['district'];
        $upd['zipcode'] = $pd['zipcode'];
        $upd['tel'] = $pd['tel'];
        $upd['fax'] = $pd['fax'];
        $upd['phone'] = $pd['phone'];
        $upd['email'] = $pd['email'];
        $upd['office_unit'] = $pd['office_unit'];
        $upd['complaint_type'] = $pd['complaint_type'];
        $upd['complaint_sub'] = $pd['complaint_sub'];
        $upd['complaint_person'] = $pd['complaint_person'];
        $upd['name'] = $pd['name'];
        $upd['description'] = $pd['description'];
        $upd['improvement'] = $pd['improvement'];

        $db_complaint->modify($upd, $pd['ind']);

        redirect('manage/accept', 'refresh'); 
    }
}
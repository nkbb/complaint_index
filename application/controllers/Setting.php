<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once './application/libraries/CIBase.php';

class Setting extends CIBase {

	public function index()
	{
		$this->check_level('admin');
        $data = "";
        $this->load->view('setting', $data);
		
    }
    
    public function unit(){
        $this->check_level('admin');
        $db_unit = $this->dbBase('unit');
        $item = $db_unit->select("","where type = 1 order by ind ASC ");
        $data['item'] = $item;
        $this->load->view('setting_unit', $data);
    }

    public function unit_create(){
        if($this->session->userdata('is_user_login') != "root" ){
            redirect('main', 'refresh');
        }else{
            $this->load->view('setting_unit_input');
        }
    }

    public function unit_edit(){
        if($this->session->userdata('is_user_login') != "root" ){
            redirect('main', 'refresh');
        }else{
            $db_unit = $this->dbBase('unit');
            $token = $this->gd('token');
            $data = $db_unit->selone("","where token = '$token' ");
            if($data){
                $this->load->view('setting_unit_input', $data);
            }else{
                redirect('main', 'refresh');
            }   
        }
    }

    public function unit_delete(){
        if($this->session->userdata('is_user_login') != "root" || $this->session->userdata('is_user_login') != "admin"){
            redirect('main', 'refresh');
        }else{
            $db_unit = $this->dbBase('unit');
            $token = $this->gd('token');
            if($token){
                $upd["type"] = 0;
                $db_unit->modifyex($upd, "token", $token);
                redirect('setting/unit', 'refresh');
            }else{
                redirect('main', 'refresh');
            }   
        }
    }

    public function unit_save(){
        $this->check_level();
        $pd = $this->pd();
        $db_unit = $this->dbBase('unit');

        $upd = $pd;

        if($pd['token']){
            $db_unit->modifyex($upd, "token", $pd['token']);
        }else{
            $upd['token'] = $this->getToken();
            $upd['type'] = 1;
            $db_unit->ins($upd);
        }

        redirect('setting/unit', 'refresh');
    }

	public function complaint(){
        $this->check_level('root');
        $db_company = $this->dbBase('company');

        $data = $db_company->selone("","where ind = 1");
        $this->load->view('setting_complaint', $data);
    }

    public function complaint_save(){
        $this->check_level('root');
        $pd = $this->pd();
        $db_company = $this->dbBase('company');
       
        $upd = $pd;
        if($pd['ind']){
            $db_company->modify($upd , $pd['ind']);
        }

        redirect('setting', 'refresh');
    }

    public function complaint_type(){
        $this->check_level('root');
        $db_type = $this->dbBase("complaint_type");
        $db_sub = $this->dbBase("complaint_sub");

        $item = $db_type->select("","where type != 0 order by num ASC ");
        $cc = count($item);
        for($i=0;$i<$cc;$i++){

            if($item[$i]['type']==2){
                $id = $item[$i]['ind'];
                $sub = $db_sub->select("","where complaint_type = '$id' and type = 1 order by num ASC ");
                $item[$i]['sub'] = $sub;
            }
        }

        $data['item'] = $item;
        $this->load->view('setting_type', $data);
    }

    public function complaint_typesave(){
        $this->check_level('root');
        $pd = $this->pd();

        if($pd["id"] && $pd["time_span"] && $pd["type"]){
            $upd["time_span"] = $pd["time_span"];

            if($pd["type"] == "type"){
                $fdb = $this->dbBase("complaint_type");
                $fdb->modify($upd,$pd["id"]);
            }else if($pd["type"] == "sub"){
                $fdb = $this->dbBase("complaint_sub");
                $fdb->modify($upd,$pd["id"]);
            }

            redirect('setting/complaint_type', 'refresh');
        }else{
            redirect('setting', 'refresh');
        }

    }

    public function repassword(){
        $this->check_level();
        $this->load->view('setting_password');
    }

    public function checkoldpw(){
        $fpd = $this->dbBase("user_info");

        $id = $this->sess_user('id');
        $password = $this->pd("password");
        $pw = md5(base64_decode("@PW".$password."pw+-"));

        $c_pw = "pw".$this->pd('password')."@PwS";
        $item = $fpd->selone("","WHERE pw='$pw' and id = '$id' ");

        if($item){
            echo "ok";
        }

    }

    public function resetpassword(){
        $this->check_level();
        $pd = $this->pd();

        $fpd = $this->dbBase("user_info");
        $id = $this->sess_user('id');
        if($id){

            $upd['pw'] = md5(base64_decode("@PW".$pd['c_pw']."pw+-"));
            $fpd->modifyex($upd, "id", $id);
        }

        redirect('admin', 'refresh');
    }

    public function user(){
        $this->check_level('root');
        $fdb= $this->dbBase('user_info');
        $db_unit = $this->dbBase('unit');

        $item = $fdb->select("","where type = 1 and level != 'root' ");
        foreach ($item as $key => $value) {
            $unit = $value['unit'];

            $unit_name = $db_unit->selone("name","where ind ='$unit' ");

            $item[$key]['show_unit'] = "";

            if($value['level'] == 'user'){
                $item[$key]['show_unit'] = $unit_name['name'];
            }
            
        }
        $data["item"] = $item;

        $this->load->view('setting_user',$data);
    }

    public function user_create(){
        $this->check_level('root');
        $db_unit = $this->dbBase("unit");

        $data['unit'] = $db_unit->select("","where type = 1 order by ind ASC ");
        $this->load->view('setting_user_input', $data);
    }

    public function user_edit(){
        $this->check_level('root');
        $db_user = $this->dbBase('user_info');
        $db_unit = $this->dbBase("unit");

        $token = $this->input->get('token');

        if($token){

            $data['unit'] = $db_unit->select("","where type = 1 order by ind ASC ");
            $item = $db_user->selone("","where token = '$token' ");

            $data['item'] = $item;
            $this->load->view('setting_user_edit', $data);

        }else{
            redirect('setting/user', 'refresh');
        }
    }

    public function checkID(){
        $id = $this->gd('id');
        $fdb= $this->dbBase('user_info');

        $c_id = $fdb->selone("ind","where id = '$id' ");
        if(!$c_id){
            echo "ok";
        }
    }

    public function user_save(){
        $this->check_level('root');
        $pd = $this->pd();
        $fdb= $this->dbBase('user_info');
        $upd = $pd;



        $upd['token']  = $this->getToken();
        $upd['pw'] = md5(base64_decode("@PW".$pd['password']."pw+-"));

        if($pd["level"] == "admin"){
            $upd["unit"] = "";
        }

        $upd['posititon'] = '';
        $upd['line_id'] = '';
        $upd['line_name'] = '';
        $upd['line_status'] = '';
        $upd['otp'] = '';
        $upd['otp_end'] = date("Y-m-d H:i:s");
        $upd['type'] = 1;

       
        $fdb->ins($upd);

        redirect('setting/user', 'refresh');
    }

    public function user_update_pw(){
        $this->check_level('root');
        $pd = $this->pd();
        $fdb= $this->dbBase('user_info');

        if($pd['ind'] and $pd['password']){
            $upd['pw'] = md5(base64_decode("@PW".$pd['password']."pw+-"));

            $fdb->modify($upd,$pd['ind']);
        }

        redirect('setting/user', 'refresh');
    }

    public function user_update(){
        $this->check_level('root');
        $pd = $this->pd();
        $fdb= $this->dbBase('user_info');
        $upd = $pd;
        if($pd['ind']){
            $fdb->modify($upd, $pd['ind']);
        }
        redirect('setting/user', 'refresh');

    }

    public function user_delete(){

        $this->check_level('root');
        $fdb= $this->dbBase('user_info');
        $token = $this->gd('token');
        if($token){
            $upd["type"] = 0;
            $fdb->modifyex($upd, "token", $token);
            redirect('setting/user', 'refresh');
        }else{
            redirect('main', 'refresh');
        } 

    }

    public function timefinish(){
        $this->check_level('root');
        $db_company = $this->dbBase('company');

        $data = $db_company->selone("","where ind = 1");
        $this->load->view('setting_timefinish', $data);

    }

    public function time_save(){
        $this->check_level('root');
        $pd = $this->pd();
        $db_company = $this->dbBase('company');
       
        $upd = $pd;
        if($pd['ind']){
            $db_company->modify($upd , $pd['ind']);
        }

        redirect('setting', 'refresh');
    }

    public function line(){
        $this->check_level('root');
        $db_company = $this->dbBase('company');

        $data = $db_company->selone("","where ind = 1");
        $this->load->view('setting_line', $data);
    }

    public function line_save(){
        $this->check_level('root');
        $pd = $this->pd();
        $db_company = $this->dbBase('company');
       
        $upd = $pd;
        
        if($pd["user_line"] == "on"){
            $upd["user_line"] = "on";
        }else{
            $upd["user_line"] = "off";
        }
        if($pd['ind']){
            $db_company->modify($upd , $pd['ind']);
        }

        redirect('setting/line?alert=save', 'refresh');
    }

    public function slide(){
        $this->check_level('root');
        $fpd = $this->dbBase('slide_img');

        $data['item'] = $fpd->select("","where type = 1 order by ind DESC ");

        $this->load->view('setting_slide', $data);
    }

    public function slide_create(){
        $this->check_level('root');

        $this->load->view('setting_slide_input', $data);
    }

    public function slide_save(){
        $this->check_level('root');
        $fpd = $this->dbBase('slide_img');
       
        if($_FILES["file"]){
            $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
            $path = "assets/images/slide/"; 
            $img = $_FILES['file']['name'];
            $tmp = $_FILES['file']['tmp_name'];

            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            

            $name_image = date("YmdHis")."_".rand(100000,100000000).".".$ext;
            //$name_image = substr(md5($final_image),15,2)."".substr(md5($final_image),0,10).".".$ext;
            if(in_array($ext, $valid_extensions)) 
            { 
                $path = $path.strtolower($name_image);
                if(move_uploaded_file($tmp,$path)){
                  $upd["url"] = $name_image;  
                  $upd["status"] = 1;
                  $upd["date_add"] = date("Y-m-d H:i:s");
                  $upd["type"] = 1;
                  $fpd->ins($upd);
                }
            }
        } 

        redirect('setting/slide', 'refresh');
    }

    public function slide_status(){
        $this->check_level('root');
        $fpd = $this->dbBase('slide_img');
        $gd = $this->gd();

        if($gd["id"]){
            $upd['status'] = $gd["status"];
            $fpd->modify($upd, $gd["id"]);
        }

        redirect('setting/slide', 'refresh');
    }

    public function slide_delete(){
        $this->check_level('root');
        $fpd = $this->dbBase('slide_img');
        $gd = $this->gd();

        if($gd["id"]){
            $upd['type'] = 0;
            $fpd->modify($upd, $gd["id"]);
        }

        redirect('setting/slide', 'refresh');
    }

    public function history(){
        $this->check_level('root');
        $fpd = $this->dbBase('history');


        $ii = 1;
        for($i=0;$i<30;$i++){
            $ii = $ii -1 ;
            $day = date("Y-m-d", strtotime($ii." day"));
            $data["his_day"][$i]["day"] = $this->getDateThis4($day);


            $start_day = $day." 00:00:00";
            $end_day = $day." 23:59:59";

            $data["his_day"][$i]["count"] = $this->setnumber($fpd->selone("count(ind) as num","where datehis between '$start_day' and '$end_day' and type = 1 "));
        }

        //echo "<pre>";print_r($data);exit();

        $ii = 1;
        for($i=0;$i<12;$i++){
            $ii = $ii -1 ;
            $month = date("Y-m", strtotime($ii." months"));
            $sub_month = substr($month, -2);
            $sub_year = substr($month,0,4)+543;
            $data["his_month"][$i]["month"] = $this->getMonTh($sub_month)." ".$sub_year;


            $start_month = $month."-01 00:00:00";
            $end_month = $month."-31 23:59:59";

            $data["his_month"][$i]["count"] = $this->setnumber($fpd->selone("count(ind) as num","where datehis between '$start_month' and '$end_month' and type = 1 "));
        }


        $year = date("Y");
        for($i=0; $i<10;$i++){
            $start_year = $year."-01-01 00:00:00";
            $end_year = $year."-12-31 23:59:59";

            $data["his_year"][$i]["count"] = $this->setnumber($fpd->selone("count(ind) as num","where datehis between '$start_year' and '$end_year' and type = 1 "));
            $data["his_year"][$i]["year"] = $year+543;
            $year = $year - 1;
        }

        $this->load->view('setting_history', $data);
    }

    public function question(){
        $this->check_level('root');
        $fpd = $this->dbBase('question');

        $item = $fpd->select("","where type = 1 order by orders ASC");
        $data['item'] = $item;
        $this->load->view('setting_question', $data);
    }

    public function question_create(){
        $this->check_level('root');


        $this->load->view('setting_question_input');
    }

    public function question_edit($id){
        $this->check_level('root');
        $fpd = $this->dbBase('question');

        $data = $fpd->selone("","where ind = '$id' ");
        $this->load->view('setting_question_input', $data);
    }

    public function question_save(){
        $this->check_level('root');

        $pd = $this->input->post();
        $fpd = $this->dbBase('question');

        if($pd['ind']){
            $upd['name'] = $pd['name'];
            $fpd->modify($upd, $pd['ind']);

        }else{

            $max = $fpd->selone("max(orders) as ct","where type = 1");
            if(empty($max)){
                $orders = 1;
            }else{
                $orders = $max['ct'] + 1;
            }

            $upd['name'] = $pd['name'];
            $upd['orders'] = $orders;
            $upd['type'] = 1;
            $fpd->ins($upd);
        }

        redirect('setting/question', 'refresh');

    }

    public function question_delete($id){
        $this->check_level('root');

        $pd = $this->input->post();
        $fpd = $this->dbBase('question');
        $upd['type'] = 0;
        $fpd->modify($upd, $id);

        redirect('setting/question', 'refresh');
    }

    public function question_order($type){
        $this->check_level('root');
        $id = $this->input->get('id');
        $order = $this->input->get('order');
        $re_id = $this->input->get('re_id');
        $re_order = $this->input->get('re_order');

        $fpd = $this->dbBase('question');

        $upd['orders'] = $order;
        $fpd->modify($upd, $id);

        $upd_re['orders'] = $re_order;
        $fpd->modify($upd_re, $re_id);

        redirect('setting/question', 'refresh');

    }

    public function method_type(){
        $this->check_level('root');
        $fpd = $this->dbBase('complaint_method');
        $item = $fpd->select("","where type !=0 order by num ASC");
        $data['item'] = $item;

        $this->load->view('setting_method_type', $data);
    }

    public function method_create(){
        $this->check_level('root');
        $this->load->view('setting_method_input');
    }

    public function method_save(){
        $this->check_level('root');

        $pd = $this->input->post();
        $fpd = $this->dbBase('complaint_method');

        if($pd['ind']){
            $upd['name'] = $pd['name'];
            $fpd->modify($upd, $pd['ind']);

        }else{

            $max = $fpd->selone("max(num) as ct","where type = 1");
            if(empty($max)){
                $orders = 1;
            }else{
                $orders = $max['ct'] + 1;
            }

            $upd['name'] = $pd['name'];
            $upd['num'] = $orders;
            $upd['type'] = 1;
            $fpd->ins($upd);
        }

        redirect('setting/method_type', 'refresh');
    }

    public function method_edit($id){
        $this->check_level('root');
        $fpd = $this->dbBase('complaint_method');

        $data = $fpd->selone("","where ind = '$id' ");
        $this->load->view('setting_method_input', $data);
    }

    public function method_delete($id){
        $this->check_level('root');

        $pd = $this->input->post();
        $fpd = $this->dbBase('complaint_method');
        $upd['type'] = 0;
        $fpd->modify($upd, $id);

        redirect('setting/method_type', 'refresh');
    }

    public function method_order($type){
        $this->check_level('root');
        $id = $this->input->get('id');
        $order = $this->input->get('order');
        $re_id = $this->input->get('re_id');
        $re_order = $this->input->get('re_order');

        $fpd = $this->dbBase('complaint_method');

        $upd['num'] = $order;
        $fpd->modify($upd, $id);

        $upd_re['num'] = $re_order;
        $fpd->modify($upd_re, $re_id);

        redirect('setting/method_type', 'refresh');

    }

    public function person_type(){
        $this->check_level('root');
        $fpd = $this->dbBase('complaint_person');
        $item = $fpd->select("","where type !=0 order by num ASC");
        $data['item'] = $item;

        $this->load->view('setting_person_type', $data);
    }

    public function person_type_create(){
        $this->check_level('root');
        $this->load->view('setting_person_type_input');
    }

    public function person_type_edit($id){
        $this->check_level('root');
        $fpd = $this->dbBase('complaint_person');

        $data = $fpd->selone("","where ind = '$id' ");
        $this->load->view('setting_person_type_input', $data);
    }

    public function person_type_save(){
        $this->check_level('root');

        $pd = $this->input->post();
        $fpd = $this->dbBase('complaint_person');

        if($pd['ind']){
            $upd['name'] = $pd['name'];
            $fpd->modify($upd, $pd['ind']);

        }else{

            $max = $fpd->selone("max(num) as ct","where type = 1");
            if(empty($max)){
                $orders = 1;
            }else{
                $orders = $max['ct'] + 1;
            }

            $upd['name'] = $pd['name'];
            $upd['num'] = $orders;
            $upd['type'] = 1;
            $fpd->ins($upd);
        }

        redirect('setting/person_type', 'refresh');

    }

    public function person_type_delete($id){
        $this->check_level('root');

        $pd = $this->input->post();
        $fpd = $this->dbBase('complaint_person');
        $upd['type'] = 0;
        $fpd->modify($upd, $id);

        redirect('setting/person_type', 'refresh');
    }

    public function person_type_order($type){
        $this->check_level('root');
        $id = $this->input->get('id');
        $order = $this->input->get('order');
        $re_id = $this->input->get('re_id');
        $re_order = $this->input->get('re_order');

        $fpd = $this->dbBase('complaint_person');

        $upd['num'] = $order;
        $fpd->modify($upd, $id);

        $upd_re['num'] = $re_order;
        $fpd->modify($upd_re, $re_id);

        redirect('setting/person_type', 'refresh');

    }
/*
    public function genUser(){
        $db_unit = $this->dbBase('unit');
        $db_user = $this->dbBase('user_info');

        $unit = $db_unit->select('','where 1');
        foreach($unit as $k => $v){

            
            $key = '';
            if($v['ind'] < 10){
                $key = 'secret0'.$v['ind'];
            }else{
                $key = 'secret'.$v['ind'];
            }

            echo $key.'<br/>';

            $upd['token'] = $this->getToken();
            $upd['pw'] = md5(base64_decode("@PW".$key."pw+-"));
            $upd['auth_phone'] = '';
            $upd['auth_fax'] = '';
            $upd['auth_email'] = '';
            $upd['posititon'] = '';
            $upd['line_id'] = '';
            $upd['line_name'] = '';
            $upd['line_status'] = '';
            $upd['otp'] = '';
            $upd['otp_end'] = date("Y-m-d H:i:s");
            $upd['type'] = 1;
            $upd['unit'] = $v['ind'];
            $upd['auth_fname'] = "เจ้าหน้าที่";
            $upd['auth_lname'] = $v['name'];
            $upd['id'] = $key;
            $upd['level'] = 'unit';
            $db_user->ins($upd);
        }
    }*/

 	
}
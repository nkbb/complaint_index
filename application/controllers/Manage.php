<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once './application/libraries/CIBase.php';

class Manage extends CIBase {

	public function index()
	{
        redirect('admin', 'refresh');
		
    }

    public function accept(){

        $this->check_level('admin');
        $db_unit = $this->dbBase('unit');
        $db_company = $this->dbBase('company');

        $data["unit"] = $db_unit->select("","where type = 1 order by name ASC, ind ASC ");
        $data['about'] = $db_company->selone("key_title","where ind = 1 ");

        $this->load->view('manage_accept2', $data);
    }
    
    public function selectaccept(){
        $this->check_level('admin');
        $db_sub = $this->dbBase("complaint_sub");
        $db_company = $this->dbBase('company');
        $db_log = $this->dbBase('complaint_log');
        $db_unit = $this->dbBase('unit');
        $gd = $this->gd();
        $db = $this->db;

        $wh = " and c.type =  2 ";

        if(isset($gd["s_unit"]) && $gd["s_unit"]){
            $s_unit = $gd["s_unit"];
            $wh .= " and c.office_unit = '$s_unit' ";
        }

        if(isset($gd["s_code"]) && $gd["s_code"]){
            $about = $db_company->selone("key_title","where ind = 1 ");
            $s_code = $about["key_title"].$gd["s_code"];
            $wh .= " and c.code = '$s_code' ";
        }

        if(isset($gd["page"]) && $gd["page"]){ 
            $start = ($gd['page']-1)*15;
            $end = 15;
            $page = $gd['page'];
        }else{
            $start = 0;
            $end = 15;
            $page = 1;
        }
        $limit = "limit $start,$end";

        $qry = "SELECT count(c.ind) as ct FROM complaint c, complaint_type t
                WHERE c.complaint_type = t.ind $wh ";
        $count = $db->qdf($qry);
        $ct['count'] = $count['ct'];
        $ct['page'] = $page;
        $data['ct'] = $ct;

        $qry = "SELECT c.token, c.code, c.date_add , t.name as type_name, c.name as title_name, t.type as comp_type,
            c.date_add, c.office_unit, c.complaint_method, c.ind, c.complaint_sub
            FROM complaint c, complaint_type t
            WHERE c.complaint_type = t.ind 
            $wh order by c.code DESC $limit";

        $item = $db->querydata($qry);
        foreach($item as $key => $value){
            $id = $value['ind'];
            $item[$key]["date_post"] = $this->DateDiff($value["date_add"],date("Y-m-d"));
            $item[$key]["date_add"] = $this->getDateThis2($value["date_add"],0,10);
            $item[$key]["time_add"] = substr($value["date_add"],11,5);
            
            if($value["complaint_sub"]){
                $subid = $value["complaint_sub"];
                $subname = $db_sub->selone("name","where ind = '$subid' ");
                if($subname){
                    $item[$key]["type_name"] .= " (".$subname["name"].") ";
                }
            }
            
            $item[$key]['complaint_method_name'] = $this->getMethodComplaint($item[$key]['complaint_method']);

            //หน่วยที่ถูกร้อง
            $uid = $item[$key]['office_unit'];
            $unit = $db_unit->selone("name","where ind ='$uid' ");
            $item[$key]['unit_name'] = $unit['name'];

            $log =  $db_log->selone("count(ind) as ct","where complaint_id = '$id' ");
            $item[$key]['process'] = $log['ct'];

        }

        $data['items'] = $item;
		echo json_encode($data);
    }

    public function sendaccept(){
        $this->check_level('admin');
        $token = $this->pd('token');

        if($token){

            $db_complaint = $this->dbBase("complaint");
            $db_log = $this->dbBase("complaint_log");
            $upd["complain_level"] = $this->input->post("complain_level");
            $upd['send_date'] = date("Y-m-d H:i:s");
            $upd["send_user"] = $this->sess_user('id');
            $upd['send_unit'] = $this->input->post('send_unit');
            $upd['send_comm'] = $this->input->post('send_comm');
            $upd['type'] = 3;

            $upd["send_files"] = "";
            if(isset($_FILES["file"]) && !empty($_FILES['file'])){
                $valid_extensions = array('pdf'); // valid extensions
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
                      $upd["send_files"] = $name_image;  
                    }
                }
            }
            
            $comp_id = $db_complaint->selone('ind','where 1 order by ind DESC');
            $log['user_id'] = $upd['send_user'];
            $log['date_time'] = $upd['send_date'];
            $log['complaint_id'] = $comp_id['ind'];
            $log['type'] = 2;
            $db_log->ins($log);

            $db_complaint->modifyex($upd, "token", $token);
            $this->sendLineGroupUser($token,3);

            echo "ok";
        }else{
            echo "error";
        }
    }

    public function savereceive(){
         $this->check_level('user');
         $pd = $this->gd();
        if($pd['token']){

            $db_complaint = $this->dbBase("complaint");
            $db_log = $this->dbBase("complaint_log");
            $upd = $pd;
            $upd['receive_date'] = date("Y-m-d H:i:s");
            $upd["receive_user"] = $this->sess_user('id');
            $upd["type"] = 4;
            $db_complaint->modifyex($upd, "token", $pd['token']);
            $this->sendLineGroupAdmin($upd["token"], 4);

            $token = $pd['token'];
            $comp_id = $db_complaint->selone('ind', "where token = '$token' ");
            $log['user_id'] = $this->sess_user('id');
            $log['date_time'] = $upd['receive_date'];
            $log['complaint_id'] = $comp_id['ind'];
            $log['type'] = 3;
            $db_log->ins($log);

            echo "ok";
        }else{
            echo "error";
        }
    }

    public function deleteaccept(){
        $this->check_level('admin');
        $token = $this->gd('token');
        if($token){

            $db_complaint = $this->dbBase("complaint");
            $db_log = $this->dbBase("complaint_log");
            $upd['del_date'] = date("Y-m-d H:i:s");
            $upd["del_user"] = $this->sess_user('id');
            $upd['type'] = 0;
            $db_complaint->modifyex($upd, "token", $token);

            $comp_id = $db_complaint->selone('ind', "where token = '$token' ");
            $log['user_id'] = $this->sess_user('id');
            $log['date_time'] = $upd['del_date'];
            $log['complaint_id'] = $comp_id['ind'];
            $log['type'] = 7;
            $db_log->ins($log);

            echo "ok";
        }else{
            echo "error";
        }
    }

    public function showaccept(){
        $this->check_level();
        $token = $this->gd('token');
        $db_complaint = $this->dbBase("complaint");
        $db_com_comment = $this->dbBase("complaint_comment");

        $data = $db_complaint->selone("","where token = '$token' ");
        $data['addressfull'] = $this->getfulldate($data['province'], $data['amphur'],  $data['district'], $data['zipcode']);

        $ppages=str_replace(" ","&nbsp;",$data["description"]); 
        $ppages2=str_replace(array("\r\n","\r","\n"),"<br/>",$ppages);
        $data["description"] = $ppages2;

        $ppages=str_replace(" ","&nbsp;",$data["improvement"]); 
        $ppages2=str_replace(array("\r\n","\r","\n"),"<br/>",$ppages);
        $data["improvement"] = $ppages2;

        $data["show_date_add"] = $this->getDateThis4($data["date_add"]);

        if($data["type"] >= 4){
            $ppages=str_replace(" ","&nbsp;",$data["answer_detail"]); 
            $ppages2=str_replace(array("\r\n","\r","\n"),"<br/>",$ppages);
            $data["answer_detail"] = $ppages2;

            $data["show_date_answer"] = $this->getDateThis4($data["answer_date"]);
        }

        $data['office_name'] = $this->getunit($data["office_unit"]);
        $data['complain_type'] = $this->getcomplainttype($data["complaint_type"]);

        $data['comment'] = "";
        if($data["type"] >= 4){
            $data['comment'] = $db_com_comment->select("","where rtoken = '$token' and type != 0 ");
            foreach ($data["comment"] as $key => $value) {
                $data['comment'][$key]["date_ask"] = $this->getDateThis4($value["date_ask"]);
                $data['comment'][$key]["date_com"] = $this->getDateThis4($value["date_com"]);
            }
            
        }

        if($this->sess_user('level')=="root" || $this->sess_user('level')=="admin"){
            $this->load->view('_model_show_accept', $data);
        }else{
            $this->load->view('_model_show', $data);
        }
    }

    public function viewcomplain($page = ""){
        $this->check_level();
        $token = $this->gd('token');
        $db_complaint = $this->dbBase("complaint");
        $db_com_comment = $this->dbBase("complaint_comment");
        $db_sub = $this->dbBase("complaint_sub");
        $db_log = $this->dbBase("complaint_log");
        $db_user = $this->dbBase("user_info");

        $data = $db_complaint->selone("","where token = '$token' ");
        $data['addressfull'] = $this->getfulldate($data['province'], $data['amphur'],  $data['district'], $data['zipcode']);

        $ppages=str_replace(" ","&nbsp;",$data["description"]); 
        $ppages2=str_replace(array("\r\n","\r","\n"),"<br/>",$ppages);
        $data["description"] = $ppages2;

        $ppages=str_replace(" ","&nbsp;",$data["improvement"]); 
        $ppages2=str_replace(array("\r\n","\r","\n"),"<br/>",$ppages);
        $data["improvement"] = $ppages2;

        $data["show_date_add"] = $this->getDateThis4($data["date_add"]);

        if($data["type"] >= 4){
            $ppages=str_replace(" ","&nbsp;",$data["answer_detail"]); 
            $ppages2=str_replace(array("\r\n","\r","\n"),"<br/>",$ppages);
            $data["answer_detail"] = $ppages2;

            $data["show_date_answer"] = $this->getDateThis4($data["answer_date"]);
        }

        $data['office_name'] = $this->getunit($data["office_unit"]);
        $data['unit_name'] = $this->getunit($data["send_unit"]);
        $data['complain_type'] = $this->getcomplainttype($data["complaint_type"]);

        if($data['complaint_sub']){
            $sub_id = $data['complaint_sub'];
            $data['sub_name'] = $db_sub->selone("name","where ind = '$sub_id' ");
        }

        $data['comment'] = "";
        if($data["type"] >= 4){
            $data['comment'] = $db_com_comment->select("","where rtoken = '$token' and type != 0 ");
            foreach ($data["comment"] as $key => $value) {
                $data['comment'][$key]["date_ask"] = $this->getDateThis4($value["date_ask"]);
                $data['comment'][$key]["date_com"] = $this->getDateThis4($value["date_com"]);
            }
            
        }

        $id = $data['ind'];
        $log = $db_log->select("","where complaint_id = '$id' order by date_time DESC");
        foreach($log as $k => $v){
            // db_user
            $user_id = $v['user_id'];
            $user = $db_user->selone("auth_fname, auth_lname","where id = '$user_id' ");
            $log[$k]['user_name'] = $user['auth_fname'].' '.$user['auth_lname'];
            $log[$k]['date_add'] = $this->getDateThis2($v['date_time']);

            //db_com_comment
            if(!empty($v['comment_id'])){
                $comment_id = $v['comment_id'];
                $comment = $db_com_comment->selone('',"where ind = '$comment_id' ");
                if(!empty($comment)){
                    $log[$k]['ask_unit'] = $comment['ask_unit'];
                    $log[$k]['comment_unit'] = $comment['comment_unit'];
                    $log[$k]['user_com'] = $comment['user_com'];
                    $log[$k]['comment_type'] = $comment['type'];
                    $log[$k]['comment_status'] = $comment['status'];
                    $log[$k]['date_ask'] = $this->getDateThis2($comment['date_ask']);
                    $log[$k]['time_ask'] = substr($comment['date_ask'],11,5);
                    $log[$k]['date_com'] = $this->getDateThis2($comment['date_ask']);
                    $log[$k]['time_com'] = substr($comment['date_ask'],11,5);
                }
            }
        }

        $data['log'] = $log;
        $data['page'] = $page;

        $data['status_name'] = $this->getStatusComplaint($data['type'], 'name');
        
        $data['time_add'] = substr($data['date_add'],11,5);
        $data['date_add'] = $this->getDateThis2($data['date_add']);
        // echo '<pre>';print_r($data);exit();
        if($this->sess_user('level')=="root" || $this->sess_user('level')=="admin"){
            $this->load->view('manage_show_complain_admin', $data);
        }else{
            $this->load->view('manage_show_complain', $data);
        }

    }

    public function commitfollow(){
        $this->check_level();
        $token = $this->gd('token');
        $db_complaint = $this->dbBase("complaint");
        $db_com_comment = $this->dbBase("complaint_comment");

        $data = $db_complaint->selone("","where token = '$token' ");
        $data['addressfull'] = $this->getfulldate($data['province'], $data['amphur'],  $data['district'], $data['zipcode']);

        $ppages=str_replace(" ","&nbsp;",$data["description"]); 
        $ppages2=str_replace(array("\r\n","\r","\n"),"<br/>",$ppages);
        $data["description"] = $ppages2;

        $ppages=str_replace(" ","&nbsp;",$data["improvement"]); 
        $ppages2=str_replace(array("\r\n","\r","\n"),"<br/>",$ppages);
        $data["improvement"] = $ppages2;

        $data["show_date_add"] = $this->getDateThis4($data["date_add"]);

        if($data["type"] >= 4){
            $ppages=str_replace(" ","&nbsp;",$data["answer_detail"]); 
            $ppages2=str_replace(array("\r\n","\r","\n"),"<br/>",$ppages);
            $data["answer_detail"] = $ppages2;

            $data["show_date_answer"] = $this->getDateThis4($data["answer_date"]);
        }

        $data['office_name'] = $this->getunit($data["office_unit"]);
        $data['complain_type'] = $this->getcomplainttype($data["complaint_type"]);

        $data['comment'] = "";
        if($data["type"] >= 4){
            $data['comment'] = $db_com_comment->select("","where rtoken = '$token' and type != 0 ");
            foreach ($data["comment"] as $key => $value) {
                $data['comment'][$key]["date_ask"] = $this->getDateThis4($value["date_ask"]);
                $data['comment'][$key]["date_com"] = $this->getDateThis4($value["date_com"]);
            }
            
        }
        $this->load->view('_model_show_follow', $data);
       
    }

    public function follow(){
        $this->check_level('admin');
        $db_unit = $this->dbBase('unit');
        $db_company = $this->dbBase('company');

        $data["unit"] = $db_unit->select("","where type = 1 order by name ASC ");
        $data['about'] = $db_company->selone("key_title","where ind = 1 ");
        $this->load->view('manage_follow2', $data);

    }

    public function selectfollow(){
        $this->check_level('admin');
        $db_sub = $this->dbBase("complaint_sub");
        $db_company = $this->dbBase('company');
        $db_com_comment = $this->dbBase('complaint_comment');
        $db_unit = $this->dbBase('unit');
        $db_log = $this->dbBase('complaint_log');
        $gd = $this->gd();
        $db = $this->db;

        $wh = "";
        if(isset($gd["s_unit"]) && $gd["s_unit"]){
            $s_unit = $gd["s_unit"];
            $wh .= " and c.send_unit = '$s_unit' ";

        }

        if(isset($gd["s_code"]) && $gd["s_code"]){
            $about = $db_company->selone("key_title","where ind = 1 ");
            $s_code = $about["key_title"].$gd["s_code"];
            $wh .= " and c.code = '$s_code' ";
        }

        if(isset($gd["s_status"]) && $gd["s_status"]){

            if(isset($gd['check_status'])){
                $wh .= " and (c.type = 4)";
            }else{
                $s_status = $gd["s_status"];
                $wh .= " and c.type = '$s_status' ";
            }
            
        }else{
            $wh .= " and c.type > 1 ";
        }

        if(isset($gd["page"]) && $gd["page"]){ 
            $start = ($gd['page']-1)*15;
            $end = 15;
            $page = $gd['page'];
        }else{
            $start = 0;
            $end = 15;
            $page = 1;
        }
        $limit = "limit $start,$end";

        $qry = "SELECT count(c.ind) as ct FROM complaint c, complaint_type t
                WHERE c.complaint_type = t.ind $wh ";
        $count = $db->qdf($qry);
        $ct['count'] = $count['ct'];
        $ct['page'] = $page;
        $data['ct'] = $ct;

        $qry = "SELECT c.ind, c.token, c.code, c.type, c.date_add, c.send_date, c.receive_date, c.send_user, c.answer_date, c.finish_date, t.name as type_name, c.name, t.type as comp_type, t.name as title_name,
            c.complaint_method, c.office_unit, c.complaint_sub
            FROM complaint c, complaint_type t
            WHERE c.complaint_type = t.ind 
            $wh order by c.code DESC $limit";

        $item = $db->querydata($qry);
        foreach($item as $key => $value){
            $id = $value['ind'];
            $token = $value["token"];
            $item[$key]["link"] = "";
            $item[$key]["show_date"] = $this->getDateThis4($value["date_add"]);

            if($value["complaint_sub"]){
                $subid = $value["complaint_sub"];
                $subname = $db_sub->selone("name","where ind = '$subid' ");
                if($subname){
                    $item[$key]["type_name"] .= " (".$subname["name"].") ";
                }
            }

            $item[$key]["date_post"] = $this->DateDiff($value["date_add"],date("Y-m-d"));
            $item[$key]["date_add"] = $this->getDateThis2($value["date_add"],0,10);
            $item[$key]["time_add"] = substr($value["date_add"],11,5);
            
            $item[$key]['complaint_method_name'] = $this->getMethodComplaint($item[$key]['complaint_method']);

            //หน่วยที่ถูกร้อง
            $uid = $item[$key]['office_unit'];
            $unit = $db_unit->selone("name","where ind ='$uid' ");
            $item[$key]['unit_name'] = $unit['name'];
            
            /*$item[$key]["date_status"] = "";
            if($value["type"] == 1){
                 $item[$key]["date_status"] = "";
            }else if($value["type"] == 2){
                $item[$key]["date_status"] = "- / - / - / - ";
            }else if($value["type"] == 3){
                $dateadd = $this->DateDiff($value["date_add"],$value["send_date"]);
                $item[$key]["date_status"] = $dateadd." / - / - / - ";
            }else if($value["type"] == 4){
                $dateadd = $this->DateDiff($value["date_add"],$value["send_date"]);
                $datesent = $this->DateDiff($value["send_date"],$value["receive_date"]);
                $item[$key]["date_status"] = $dateadd." / ".$datesent." / - / - ";

                $c_comment = $db_com_comment->selone("count(ind) as ct","where rtoken = '$token' and type != 0 ");
                if($c_comment['ct'] > 0 ){
                    $item[$key]["link"] = "<a href='javascript:sendComment(\"".$value['token']."\")' data-toggle=\"tooltip\" data-placement=\"top\" title=\"สอบถามสถานะ ดำเนินการ\"><i class=\"fas fa-bell\" style='font-size:22px;color:#dc3545;'></i></a>";
                }else{
                    $item[$key]["link"] = "<a href='javascript:sendComment(\"".$value['token']."\")' data-toggle=\"tooltip\" data-placement=\"top\" title=\"สอบถามสถานะ ดำเนินการ\"><i class=\"far fa-bell\" style='font-size:22px'></i></a>";
                }
            


            }else if($value["type"] == 5){
                $dateadd = $this->DateDiff($value["date_add"],$value["send_date"]);
                $datesent = $this->DateDiff($value["send_date"],$value["receive_date"]);
                $datareceive = $this->DateDiff($value["receive_date"],$value["answer_date"]);
                $item[$key]["date_status"] = $dateadd." / ".$datesent." / ".$datareceive." / - ";

                 $item[$key]["link"] = "<a href='javascript:commitData(\"".$value['token']."\")' style='color:#5cb85c' data-toggle=\"tooltip\" data-placement=\"top\" title=\"ยุติ และรายงานผู้บริหาร\"><i class=\"fas fa-clipboard-check\" style='font-size:22px'></i></a>";

            }else if($value["type"] == 6){
                $dateadd = $this->DateDiff($value["date_add"],$value["send_date"]);
                $datesent = $this->DateDiff($value["send_date"],$value["receive_date"]);
                $datareceive = $this->DateDiff($value["receive_date"],$value["answer_date"]);
                $datefinish = $this->DateDiff($value["answer_date"],$value["finish_date"]);
                $item[$key]["date_status"] = $dateadd." / ".$datesent." / ".$datareceive." / ".$datefinish;
            }else{
                $item[$key]["date_status"] = "- / - / - / - ";

            }
            
            if($value["type"] == 6){
                $num_date = $this->DateDiff($value["date_add"], $value["finish_date"]);
                $item[$key]["finish_type"] = "รวมทั้งสิ้น ".$num_date." วัน";
            }else{
                $item[$key]["finish_type"] ="ยังไม่เสร็จสิ้น";
            }*/

            $item[$key]['status_name'] = $this->getStatusComplaint($item[$key]['type'],'name');

            $log =  $db_log->selone("count(ind) as ct","where complaint_id = '$id' ");
            $item[$key]['process'] = $log['ct'];

        }

        $data['items'] = $item;
		echo json_encode($data);
    }

    public function sendcomment(){
        $this->check_level();
        $db_comment = $this->dbBase("complaint_comment");
        $token = $this->gd('token');

        $item = $db_comment->select("","where rtoken = '$token' ");
        foreach ($item as $key => $value) {
            $item[$key]["date_ask"] = $this->getDateThis4($value["date_ask"]);
        }
        $data['item'] = $item;

        $data['token'] = $token;
        $this->load->view('_model_show_commentsend', $data);
    }



    public function saveask(){
        $this->check_level();
         $pd = $this->gd();
          if($pd['token']){

            $db_comment = $this->dbBase("complaint_comment");
            $db_complaint = $this->dbBase("complaint");
            $db_log = $this->dbBase("complaint_log");
           
            $upd["rtoken"] = $pd["token"];
            $upd["ask_unit"] = $pd["ask_unit"];
            $upd['date_ask'] = date("Y-m-d H:i:s");
            $upd["user_ask"] = $this->sess_user('id');
            $upd['comment_unit'] = '';
            $upd['user_com'] = '';
            $upd['date_com'] = date("Y-m-d H:i:s");
            $upd['type'] = 1;
            $upd['status']  = 0;
            $db_comment->ins($upd);

            $this->sendLineGroupUser($pd['token'], 2);

            $token = $pd['token'];
            $comment_id = $db_comment->selone("ind","where rtoken = '$token' order by ind DESC");
            $comp_id = $db_complaint->selone('ind', "where token = '$token' ");
            $log['user_id'] = $this->sess_user('id');
            $log['date_time'] = $upd['date_ask'];
            $log['complaint_id'] = $comp_id['ind'];
            $log['comment_id'] = $comment_id['ind'];
            $log['type'] = 6;
            $db_log->ins($log);

            echo "ok";
        }else{
            echo "error";
        }
    }

    public function returndata(){
        $this->check_level('admin');
        $token = $this->gd('token');
        if($token){

            $db_complaint = $this->dbBase("complaint");
            $db_log = $this->dbBase("complaint_log");
            $upd['type'] = 2;
            $db_complaint->modifyex($upd, "token", $token);

            $comp_id = $db_complaint->selone('ind', "where token = '$token' ");
            $log['user_id'] = $this->sess_user('id');
            $log['date_time'] = date("Y-m-d H:i:s");
            $log['complaint_id'] = $comp_id['ind'];
            $log['type'] = 8;
            $db_log->ins($log);
            

            echo "ok";
        }else{
            echo "error";
        }
    }

    public function alter(){
        $this->check_level('user');
        $db_company = $this->dbBase('company');

        $data['about'] = $db_company->selone("key_title","where ind = 1 ");
        $this->load->view('manage_alter2', $data);

    }

    public function selectalter(){
        $this->check_level('user');
        $unit = $this->sess_user('unit');
        $db_sub = $this->dbBase("complaint_sub");
        $db_company = $this->dbBase('company');
        $db_comment = $this->dbBase('complaint_comment');
        $db_log = $this->dbBase('complaint_log');
        $db_unit = $this->dbBase('unit');
        $gd = $this->gd();
        $db = $this->db;

        $wh = "AND c.type = 4 AND c.send_unit = '$unit' ";

        if(isset($gd["s_code"]) && $gd["s_code"]){
            $about = $db_company->selone("key_title","where ind = 1 ");
            $s_code = $about["key_title"].$gd["s_code"];
            $wh .= " and c.code = '$s_code' ";
        }

        if(isset($gd["page"]) && $gd["page"]){ 
            $start = ($gd['page']-1)*15;
            $end = 15;
            $page = $gd['page'];
        }else{
            $start = 0;
            $end = 15;
            $page = 1;
        }
        $limit = "limit $start,$end";

        $qry = "SELECT count(c.ind) as ct FROM complaint c, complaint_type t
                WHERE c.complaint_type = t.ind $wh ";
        $count = $db->qdf($qry);
        $ct['count'] = $count['ct'];
        $ct['page'] = $page;
        $data['ct'] = $ct;

        $qry = "SELECT c.token, c.code, c.date_add, c.receive_date, t.name as type_name, c.name as title_name, t.type as comp_type ,
                c.complaint_method, c.office_unit, c.ind, c.complaint_sub
                FROM complaint c, complaint_type t
                WHERE c.complaint_type = t.ind 
                $wh order by c.code DESC $limit";

        $item = $db->querydata($qry);
        foreach($item as $key => $value){
            $id = $value['ind'];
            $item[$key]["show_date"] = $this->getDateThis4($value["date_add"]);
            $item[$key]["date_wait"] = $this->DateDiff($value["receive_date"],date("Y-m-d"));

            $token = $value["token"];
            $count =  $db_comment->selone("count(ind) as ct","where rtoken = '$token' and type = 1");
            if($count["ct"] >= 1){
                $item[$key]["comment"] = "<span class='comment-count'>".$count['ct']."</span>";
            }else{
                $item[$key]["comment"] = "";
            }
           
            if($value["comp_type"]){
                $subid = $value["complaint_sub"];
                $subname = $db_sub->selone("name","where ind = '$subid' ");
                if($subname){
                    $item[$key]["type_name"] .= " (".$subname["name"].") ";
                }
            }

            $item[$key]["date_add"] = $this->getDateThis2($value["date_add"],0,10);
            $item[$key]["time_add"] = substr($value["date_add"],11,5);
            
            $item[$key]['complaint_method_name'] = $this->getMethodComplaint($item[$key]['complaint_method']);

            //หน่วยที่ถูกร้อง
            $uid = $item[$key]['office_unit'];
            $unit = $db_unit->selone("name","where ind ='$uid' ");
            $item[$key]['unit_name'] = $unit['name'];

            $log =  $db_log->selone("count(ind) as ct","where complaint_id = '$id' ");
            $item[$key]['process'] = $log['ct'];
        }

        $data['items'] = $item;
        echo json_encode($data);

    }

    public function showcomment(){
        $this->check_level('user');
        $id = $this->gd("comment");
        $token = $this->gd("token");
        $db_comment = $this->dbBase("complaint_comment");

        $item = $db_comment->select("","where rtoken = '$token' and ind = '$id' ");
        foreach ($item as $key => $value) {
            $item[$key]["date_ask"] = $this->getDateThis4($value["date_ask"]);
        }
        $data["item"] = $item;

        $comment = $db_comment->select("","where rtoken = '$token' and type = 1 ");
        $data["comment"] = $comment;

        $data['comment_id'] = $id;
        $this->load->view('_model_show_commentuser', $data);
    }

    public function savecomment(){
        $this->check_level('user');
        $pd = $this->gd();
          if($pd['comment_id']){

            $db_comment = $this->dbBase("complaint_comment");
            $upd["comment_unit"] = $pd["comment_unit"];
            $upd['date_com'] = date("Y-m-d H:i:s");
            $upd["user_com"] = $this->sess_user('id');
            $upd["type"] = 2;
            $db_comment->modify($upd, $pd['comment_id']);

            $id = $pd["comment_id"];
            $c_data = $db_comment->selone("rtoken","where ind ='$id' ");

            $this->sendLineGroupAdmin($c_data["rtoken"], 3);
            echo "ok";
        }else{
            echo "error";
        }
    }

    public function saveconfirm(){
        $this->check_level('user');
        $pd = $this->gd();
          if($pd['token']){

            $db_complaint = $this->dbBase("complaint");
            $db_log = $this->dbBase("complaint_log");
            $upd["answer_detail"] = $pd["answer_detail"];
            $upd['finish_date'] = date("Y-m-d H:i:s");
            $upd["finish_user"] = $this->sess_user('id');
            $upd["type"] = 6;
            $db_complaint->modifyex($upd, "token", $pd['token']);

            $this->logmail($pd['token'],1);
            $this->sendLineGroupUser($pd['token'],6);

            $token = $pd['token'];
            $comp_id = $db_complaint->selone('ind', "where token = '$token' ");
            $log['user_id'] = $this->sess_user('id');
            $log['date_time'] = $upd['finish_date'];
            $log['complaint_id'] = $comp_id['ind'];
            $log['type'] = 5;
            $db_log->ins($log);

            echo "ok";
        }else{
            echo "error";
        }
    }

    public function receive(){
        $this->check_level('user');
        $db_company = $this->dbBase('company');
        $unit = $this->sess_user('unit');

        $data['about'] = $db_company->selone("key_title","where ind = 1 ");
        $this->load->view('manage_receive2', $data);
    }

    public function selectreceive(){
        $this->check_level('user');
        $unit = $this->sess_user('unit');
        $db_sub = $this->dbBase("complaint_sub");
        $db_company = $this->dbBase('company');
        $db_unit = $this->dbBase('unit');
        $db_log = $this->dbBase('complaint_log');
        $gd = $this->gd();
        $db = $this->db;

        $wh = "AND c.type = 3 AND c.send_unit = '$unit' ";


        if(isset($gd["s_code"]) && $gd["s_code"]){
            $about = $db_company->selone("key_title","where ind = 1 ");
            $s_code = $about["key_title"].$gd["s_code"];
            $wh .= " and c.code = '$s_code' ";
        }

        if(isset($gd["page"]) && $gd["page"]){ 
            $start = ($gd['page']-1)*15;
            $end = 15;
            $page = $gd['page'];
        }else{
            $start = 0;
            $end = 15;
            $page = 1;
        }
        $limit = "limit $start,$end";

        $qry = "SELECT count(c.ind) as ct FROM complaint c, complaint_type t
                WHERE c.complaint_type = t.ind $wh ";
        $count = $db->qdf($qry);
        $ct['count'] = $count['ct'];
        $ct['page'] = $page;
        $data['ct'] = $ct;

        $qry = "SELECT c.token, c.code, c.type, c.date_add, c.send_date, c.answer_date, c.finish_date , c.complaint_sub, t.name as type_name, c.name as title_name, t.type as comp_type,
                c.complaint_method, c.office_unit, c.ind, c.complaint_sub
                FROM complaint c, complaint_type t
                WHERE c.complaint_type = t.ind 
                $wh order by c.code DESC $limit";

        $item = $db->querydata($qry);
        foreach($item as $key => $value){
            $id = $value['ind'];
            $item[$key]["date_send"] = $this->getDateThis2($value["send_date"]);
            $item[$key]["time_send"] = substr($value["send_date"],11,5);
            $item[$key]["date_wait"] = $this->DateDiff($value["send_date"], date("Y-m-d H:i:s"));


            if($value["complaint_sub"]){
                $subid = $value["complaint_sub"];
                $subname = $db_sub->selone("name","where ind = '$subid' ");
                if($subname){
                    $item[$key]["type_name"] .= " (".$subname["name"].") ";
                }
            }

            $item[$key]["date_add"] = $this->getDateThis2($value["date_add"],0,10);
            $item[$key]["time_add"] = substr($value["date_add"],11,5);
            
            $item[$key]['complaint_method_name'] = $this->getMethodComplaint($item[$key]['complaint_method']);

            //หน่วยที่ถูกร้อง
            $uid = $item[$key]['office_unit'];
            $unit = $db_unit->selone("name","where ind ='$uid' ");
            $item[$key]['unit_name'] = $unit['name'];
            
     
            $item[$key]['status_name'] = $this->getStatusComplaint($item[$key]['type'],'name');

            $log =  $db_log->selone("count(ind) as ct","where complaint_id = '$id' ");
            $item[$key]['process'] = $log['ct'];

        }

        $data['items'] = $item;
        echo json_encode($data);
    }

    public function showreceive(){
        $this->check_level();
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

        $data["show_date_add"] = $this->getDateThis4($data["date_add"]);

        $data['office_name'] = $this->getunit($data["office_unit"]);
        $data['complain_type'] = $this->getcomplainttype($data["complaint_type"]);

        $this->load->view('_model_show_receive', $data);
    }

    public function severeceive(){
        $this->check_level('user');
         $pd = $this->gd();
          if($pd['token']){

            $db_complaint = $this->dbBase("complaint");
            $db_respon = $this->dbBase("respon_preson");
            $upd = $pd;
            $upd['receive_date'] = date("Y-m-d H:i:s");
            $upd["receive_user"] = $this->sess_user('id');
            $db_complaint->modifyex($upd, "token", $pd['token']);


            $pud["rtoken"] = $pd['token'];
            $pud["auth_fname"] = $pd['auth_fname'];
            $pud["auth_lname"] = $pd['auth_lname'];
            $pud["auth_phone"] = $pd['auth_phone'];
            $pud["auth_fax"] = $pd['auth_fax'];
            $pud["auth_email"] = $pd['auth_email'];
            $db_respon->ins($pud);

            echo "ok";
        }else{
            echo "error";
        }
    }

    public function showanswer(){
        $this->check_level();
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

        $data["show_date_add"] = $this->getDateThis4($data["date_add"]);

        $data['office_name'] = $this->getunit($data["office_unit"]);
        $data['complain_type'] = $this->getcomplainttype($data["complaint_type"]);

        $this->load->view('_model_show_answer', $data);
    }

    public function saveanswer(){
        $this->check_level('user');
        $pd = $this->pd();
          if($pd['token']){

            $db_complaint = $this->dbBase("complaint");
            $db_log = $this->dbBase("complaint_log");

            $upd = $pd;
            $upd["answer_file"] = "";
            if(isset($_FILES["file"]) && !empty($_FILES['file'])){
                $valid_extensions = array('jpeg', 'jpg', 'png', 'pdf' , 'doc'); // valid extensions
                $path = "assets/files/"; 
                $img = $_FILES['file']['name'];
                $tmp = $_FILES['file']['tmp_name'];
                $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

                $final_image = rand(1000,1000000).$img;
                $name_image = substr(md5($final_image),15,2)."".substr(md5($final_image),0,10).".".$ext;
                if(in_array($ext, $valid_extensions)) 
                { 
                    $path = $path.strtolower($name_image);
                    if(move_uploaded_file($tmp,$path)){
                      $upd["answer_file"] = $name_image;  
                    }
                }
            }

            $upd['answer_date'] = date("Y-m-d H:i:s");
            $upd["answer_name"] = $this->sess_user('id');
            $db_complaint->modifyex($upd, "token", $pd['token']);

            $this->sendLineGroupAdmin($pd['token'],5);

            $token = $pd['token'];
            $comp_id = $db_complaint->selone('ind', "where token = '$token' ");
            $log['user_id'] = $this->sess_user('id');
            $log['date_time'] = $upd['answer_date'];
            $log['complaint_id'] = $comp_id['ind'];
            $log['type'] = 4;
            $db_log->ins($log);

            $data['code'] = "success";
        }else{
            $data['code'] = "error";
        }

        echo json_encode($data);
    }

    public function userfollow(){

        $this->check_level('user');
        $db_company = $this->dbBase('company');

        $data['about'] = $db_company->selone("key_title","where ind = 1 ");
        $this->load->view('manage_userfollow2', $data);
    }

    public function selectuserfollow(){

        $this->check_level('user');
        $unit = $this->sess_user('unit');
        $db_sub = $this->dbBase("complaint_sub");
        $db_log = $this->dbBase('complaint_log');
        $db_unit = $this->dbBase('unit');
        $gd = $this->gd();
        $db = $this->db;

        $wh = "and c.send_unit = '$unit' ";

        if(isset($gd["s_code"]) && $gd["s_code"]){
            $about = $db_company->selone("key_title","where ind = 1 ");
            $s_code = $about["key_title"].$gd["s_code"];
            $wh .= " and c.code = '$s_code' ";
        }

        if(isset($gd["s_status"]) && $gd["s_status"]){
            $s_status = $gd["s_status"];
            $wh .= " and c.type = '$s_status' ";
        }else{
            $wh .= " and c.type >= 5 ";
        }

        if(isset($gd["page"]) && $gd["page"]){ 
            $start = ($gd['page']-1)*15;
            $end = 15;
            $page = $gd['page'];
        }else{
            $start = 0;
            $end = 15;
            $page = 1;
        }
        $limit = "limit $start,$end";

        $qry = "SELECT count(c.ind) as ct FROM complaint c, complaint_type t
                WHERE c.complaint_type = t.ind $wh ";
        $count = $db->qdf($qry);
        $ct['count'] = $count['ct'];
        $ct['page'] = $page;
        $data['ct'] = $ct;
        

        $qry = "SELECT c.token, c.code, c.type, c.date_add,c.send_date, c.receive_date, c.answer_date, c.finish_date , t.name as type_name, c.name as title_name, t.type as comp_type,
                c.ind, c.complaint_method, c.office_unit, c.complaint_sub
                FROM complaint c, complaint_type t
                WHERE c.complaint_type = t.ind 
                $wh order by c.code DESC $limit";

        $item = $db->querydata($qry);
        foreach($item as $key => $value){
            $id = $value['ind'];
            $item[$key]["show_date"] = $this->getDateThis4($value["date_add"]);

            if($value["complaint_sub"]){
                $subid = $value["complaint_sub"];
                $subname = $db_sub->selone("name","where ind = '$subid' ");
                if($subname){
                    $item[$key]["type_name"] .= " (".$subname["name"].") ";
                }
            }
            
            $item[$key]["date_status"] = "";
            if($value["type"] == 5){
                $dateadd = $this->DateDiff($value["date_add"],$value["send_date"]);
                $datesent = $this->DateDiff($value["send_date"],$value["receive_date"]);
                $datareceive = $this->DateDiff($value["receive_date"],$value["answer_date"]);
                $item[$key]["date_status"] = $dateadd." / ".$datesent." / ".$datareceive." / - ";
            }else if($value["type"] == 6){
                $dateadd = $this->DateDiff($value["date_add"],$value["send_date"]);
                $datesent = $this->DateDiff($value["send_date"],$value["receive_date"]);
                $datareceive = $this->DateDiff($value["receive_date"],$value["answer_date"]);
                $datefinish = $this->DateDiff($value["answer_date"],$value["finish_date"]);
                $item[$key]["date_status"] = $dateadd." / ".$datesent." / ".$datareceive." / ".$datefinish;
   
            }else{
                $item[$key]["date_status"] = "- / - / - / - ";

            }
            
            if($value["type"] == 6){
                $num_date = $this->DateDiff($value["date_add"], $value["finish_date"]);
                $item[$key]["finish_type"] = "รวมทั้งสิ้น ".$num_date." วัน";
            }else{
                $item[$key]["finish_type"] ="ยังไม่เสร็จสิ้น";
            }

            $item[$key]["date_add"] = $this->getDateThis2($value["date_add"],0,10);
            $item[$key]["time_add"] = substr($value["date_add"],11,5);
            $item[$key]['complaint_method_name'] = $this->getMethodComplaint($item[$key]['complaint_method']);

            //หน่วยที่ถูกร้อง
            $uid = $item[$key]['office_unit'];
            $unit = $db_unit->selone("name","where ind ='$uid' ");
            $item[$key]['unit_name'] = $unit['name'];

            $log =  $db_log->selone("count(ind) as ct","where complaint_id = '$id' ");
            $item[$key]['process'] = $log['ct'];
            
            $item[$key]['status_name'] = $this->getStatusComplaint($item[$key]['type'],'name');
        }

        $data['items'] = $item;
        echo json_encode($data);
    }

    public function save(){
        $gd = $this->pd();
        $db_complaint = $this->dbBase("complaint");
        

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
            $upd['location'] = '';
            $upd['location_date'] = '';
            // $upd['date_unit'] = (isset($gd['date_unit']))? $gd['dte_unit'] : date('');
            $upd['send_unit'] = $gd['send_unit'];

            $upd["files"] = "";      
        if(isset($_FILES["file"]) && !empty($_FILES['file'])){
            $valid_extensions = array('jpeg', 'jpg', 'png', 'pdf' , 'doc'); // valid extensions
            $path = "assets/files/"; 
            $img = $_FILES['file']['name'];
            $tmp = $_FILES['file']['tmp_name'];
            $size = $_FILES['file']['size'];

            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            if($size <= '2097152'){
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
        }

        if(isset($gd['status'])){
            if($gd["status"]!="on"){
                $upd["status"] = "0";
            }else{
                $upd["status"] = "1";
            }
        }else{
            $upd["status"] = "1";
        }
        
        $upd["token"] = $this->getToken();
        $upd['code'] = $this->createCode();

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
        if($gd['type_add'] == 2){
            $upd['date_add'] = date("Y-m-d H:i:s");
            $upd['type'] = 2;
        }else if($gd['type_add'] == 3){
            $upd['date_add'] = $gd['date_unit'].' '.date("H:i:s");
            
            $upd['send_date'] = date("Y-m-d H:i:s");
            $upd['send_user'] = $this->sess_user('id');

            $upd['receive_date'] = date("Y-m-d H:i:s");
            $upd['receive_user'] = $this->sess_user('id');
            $upd['type'] = 4;
        }
        $upd['type_add'] = $gd['type_add'];
        $upd['user_add'] = $this->sess_user('id');
        $db_complaint->ins($upd);
       $this->sendLineGroupAdmin($upd["token"],"2");

        redirect('complain/success?type='.$upd['type_add'], 'refresh');
    }

    public function commitdata(){
        $this->check_level('admin');
        $token = $this->gd('token');
        if($token){

            $db_complaint = $this->dbBase("complaint");
            $upd['finish_date'] = date("Y-m-d H:i:s");
            $upd["finish_user"] = $this->sess_user('id');
            $upd['type'] = 6;
            $db_complaint->modifyex($upd, "token", $token);
            echo "ok";
        }else{
            echo "error";
        }
    }

    public function received(){
        $this->check_level('admin');
        $db_unit = $this->dbBase('unit');
        $db_company = $this->dbBase('company');

        $data["unit"] = $db_unit->select("","where type = 1 order by ind ASC ");
        $data['about'] = $db_company->selone("key_title","where ind = 1 ");
        $this->load->view('manage_received2', $data);
    }

    public function proceed(){
        $this->check_level('admin');
        $db_unit = $this->dbBase('unit');
        $db_company = $this->dbBase('company');

        $data["unit"] = $db_unit->select("","where type = 1 order by ind ASC ");
        $data['about'] = $db_company->selone("key_title","where ind = 1 ");
        $this->load->view('manage_proceed2', $data);
    }

    public function terminate(){
        $this->check_level('admin');
        $db_unit = $this->dbBase('unit');
        $db_company = $this->dbBase('company');

        $data["unit"] = $db_unit->select("","where type = 1 order by ind ASC ");
        $data['about'] = $db_company->selone("key_title","where ind = 1 ");
        $this->load->view('manage_terminate2', $data);
    }

    public function selectterminate(){

        $this->check_level('admin');
        $db_sub = $this->dbBase("complaint_sub");
        $db_company = $this->dbBase('company');
        $db_unit = $this->dbBase('unit');
        $db_log = $this->dbBase('complaint_log');
        $gd = $this->gd();
        $db = $this->db;

        $wh = "";
        if(isset($gd["s_unit"]) && $gd["s_unit"]){
            $s_unit = $gd["s_unit"];
            $wh .= " and c.office_unit = '$s_unit' ";

        }

        if(isset($gd["s_code"]) && $gd["s_code"]){
            $about = $db_company->selone("key_title","where ind = 1 ");
            $s_code = $about["key_title"].$gd["s_code"];
            $wh .= " and c.code = '$s_code' ";
        }

        $wh .= " and (c.type = 0 or c.type = 6) ";

        if(isset($gd["page"]) && $gd["page"]){ 
            $start = ($gd['page']-1)*15;
            $end = 15;
            $page = $gd['page'];
        }else{
            $start = 0;
            $end = 15;
            $page = 1;
        }
        $limit = "limit $start,$end";

        $qry = "SELECT count(c.ind) as ct FROM complaint c, complaint_type t
                WHERE c.complaint_type = t.ind $wh ";
        $count = $db->qdf($qry);
        $ct['count'] = $count['ct'];
        $ct['page'] = $page;
        $data['ct'] = $ct;

        $qry = "SELECT c.token, c.code, c.type, c.date_add, c.send_date, c.receive_date, c.send_user, c.answer_date, c.finish_date, c.del_date, t.name as type_name, c.name, t.type as comp_type, t.name as title_name,
                c.complaint_method, c.office_unit, c.finish_date, c.ind, c.complaint_sub
                FROM complaint c, complaint_type t
                WHERE c.complaint_type = t.ind 
                $wh order by c.code DESC $limit";

        $item = $db->querydata($qry);
        
        foreach($item as $key => $value){
            $id = $value['ind'];
            $item[$key]["link"] = "";
            // $item[$key]["show_date"] = $this->getDateThis4($value["date_add"]);
            
            $item[$key]["date_add"] = $this->getDateThis2($value["date_add"],0,10);
            $item[$key]["time_add"] = substr($value["date_add"],11,5);

            if($value["complaint_sub"]){
                $subid = $value["complaint_sub"];
                $subname = $db_sub->selone("name","where ind = '$subid' ");
                if($subname){
                    $item[$key]["type_name"] .= " (".$subname["name"].") ";
                }
            }

            $item[$key]['complaint_method_name'] = $this->getMethodComplaint($item[$key]['complaint_method']);

            //หน่วยที่ถูกร้อง
            $uid = $item[$key]['office_unit'];
            $unit = $db_unit->selone("name","where ind ='$uid' ");
            $item[$key]['unit_name'] = $unit['name'];
            
            if($value['type'] == 0){
                $item[$key]["finish_date"] = $this->getDateThis2($value["del_date"],0,10);
                $item[$key]["finish_time"] = substr($value["del_date"],11,5);
            }else if($value['type'] == 6){
                $item[$key]["finish_date"] = $this->getDateThis2($value["finish_date"],0,10);
                $item[$key]["finish_time"] = substr($value["finish_date"],11,5);
                
            }
            $item[$key]['status_name'] = $this->getStatusComplaint($item[$key]['type'],'name');

            $log =  $db_log->selone("count(ind) as ct","where complaint_id = '$id' ");
            $item[$key]['process'] = $log['ct'];
           
        }

        $data['items'] = $item;
        echo json_encode($data);
    }

}
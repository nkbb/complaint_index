<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once './application/libraries/CIBase.php';
// require_once __DIR__ . '/vendor/autoload.php';
// require_once 'dompdf/autoload.inc.php';

class Prints extends CIBase {

	
	public function index()
	{

	}

	public function appeal($token){
		$this->check_level('user');
		$data = array();
		set_time_limit(300); 

		$db_complaint = $this->dbBase("complaint");
		$db_com_comment = $this->dbBase("complaint_comment");
		$db_com_type = $this->dbBase("complaint_type");
		$db_com_sub = $this->dbBase("complaint_sub");
		$db_method = $this->dbBase("complaint_method");
		$db_person_type = $this->dbBase("complaint_person");
		$db_log = $this->dbBase("complaint_log");
		$db_user = $this->dbBase("user_info");
		
		$data = $db_complaint->selone("","where token = '$token' ");
		if(empty($data)){
			echo 'ไม่มีรหัสร้องเรียน ร้องทุกข์นี้';
			exit();
		}

		
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
		$data['send_unit_name'] = $this->getunit($data["send_unit"]);
		$data['unit_name'] = $this->getunit($data["send_unit"]);

		$com_type = $db_com_type->selone("name","where ind = '$data[complaint_type]' ");
		$data['complain_type'] = $com_type['name'];

		$com_sub = $db_com_sub->selone("name","where ind = '$data[complaint_sub]' ");
		if($com_sub){
			$data['complain_sub'] = $com_sub['name'];
		}else{
			$data['complain_sub'] = $com_sub['name'];
		}

		$com_method = $db_method->selone("name","where ind = '$data[complaint_method]' ");
		$data['complain_method'] = $com_method['name'];

		$com_person_type = $db_person_type->selone("name","where ind = '$data[complaint_person]' ");
		$data['complain_person_type'] = $com_person_type['name'];
		// exit();


		$id = $data['ind'];
        $log = $db_log->select("","where complaint_id = '$id' order by date_time DESC");
        foreach($log as $k => $v){
            // db_user
            $user_id = $v['user_id'];
            $user = $db_user->selone("auth_fname, auth_lname","where id = '$user_id' ");
            $log[$k]['user_name'] = $user['auth_fname'].' '.$user['auth_lname'];
			$log[$k]['date_add'] = $this->getDateThis2($v['date_time']);
			
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
		
		$this->load->view('print_complaint',$data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$dompdf = new PDF();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4');
		$dompdf->render();
		$dompdf->stream("appeal.pdf", array("Attachment"=>0));
	}

	

	
}
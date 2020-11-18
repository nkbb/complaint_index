<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once './application/libraries/CIBase.php';
//include_once("./application/libraries/LineLoginLib.php");
class Line extends CIBase {


    public function index(){
        $this->check_level('admin');
        $id = $this->sess_user('id');
        $unit = $this->sess_user('unit');
        $db_line = $this->dbBase("line_groups");

        $item = $db_line->selone("","where unit = '$unit' ");
        $data = $item;
        $this->load->view('line_group_unit', $data);
    }

    public function save(){
        $this->check_level('admin');
        $pd = $this->pd();
        $db_line = $this->dbBase("line_groups");

        if(!isset($pd['is_use'])){
            $upd['is_use'] = 0;
        }else{
            $upd['is_use'] = $pd['is_use'];
        }

        $upd['name'] = $pd['name'];
        $upd['token'] = $pd['token'];

        if(!empty($pd['ind'])){
            $db_line->modify($upd, $pd['ind']);
        }else{
            $upd['unit'] = $this->sess_user('unit');
            $upd['type']  = 1;
            $db_line->ins($upd);
        }

        if($upd['is_use'] == 1){
            redirect('line/view/success', 'refresh');
        }else{
            redirect('line/view/error', 'refresh');
        }
        
    }

    public function view($type){
        $this->check_level('admin');
        $data = array();
        $db_line = $this->dbBase("line_groups");

        if($type == 'success'){
            $unit = $this->sess_user('unit');
            $data = $db_line->selone("","where unit = '$unit' ");
            $this->load->view('line_success', $data);
        }else{
            $this->load->view('line_error', $data);
        }
        
    }

    public function testLINE(){
        $gd = $this->gd();

        try {
			
            $message = $gd['message'];
            $lineapi = $gd['token'];
            $mms =  trim($message); // ข้อความที่ต้องการส่ง
            date_default_timezone_set("Asia/Bangkok");
            $chOne = curl_init();
            curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
            // SSL USE
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
            //POST
            curl_setopt( $chOne, CURLOPT_POST, 1);
            curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms");
            curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);
            $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'', );
                curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
            curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec( $chOne );
        
            curl_close( $chOne );
            $this->saveLogLine("", $message, date("Y-m-d H:i:s"), 3);
			echo $result;
		} catch (Exception $e) {
            $error = json_encode('Caught exception: ',  $e->getMessage(), "\n");
            $this->saveLogLine("", $error, date("Y-m-d H:i:s"), 3);
            echo $error;
		}
    }


}
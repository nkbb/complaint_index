<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//include_once './application/libraries/__init.php';
include_once './module/pb_script.php';
include_once './module/requests.php';
// require_once './application/libraries/class.phpmailer.php';
/*

out Token
echo($this->getToken());


*/

class CIBase extends CI_Controller {
	public $init;
	public $isdebug;
	public $mallSysInfo;
	public $mallSysInfo2;
	public $menuData;
	public $db;
	public $req;
	public $pagedata;
	public function __construct (){
		parent::__construct();
		$this->load->helper(array('html', 'form', 'language', 'url'));
		$this->load->library(array('form_validation', 'session'));
		$this->load->helper('cookie');

        $dbuser = "root";
        $dbpassword = "1234";
        $dbname ="db_complaint";
		
        $this->db = new dbmysql($dbuser,$dbpassword ,$dbname);
		$this->req = new requests();

	}

    public function loadView($viewPage,$data){
        $gd = $this->input->get();
        $pd = $this->input->post();
        $data['_gd'] = $gd;
        $data['_pd'] = $pd;
        
        /*$data['_pageData'] = $this->pagedata;
        $data['_sysinfo'] = $this->mallSysInfo2;
        $data["msgbox"] = $this->messageList();*/
        $this->load->view($this->prefix() . $viewPage,$data);
    }

    public function prefix()
    {
        $prefix_mob = "";
        $ret = "";
        $ismobilechk = "";
        if(get_cookie('ismob')){
            $ismobilechk = true;
            
        }

        if($ismobilechk){
            $ret = "@mob_";
        }
        return $ret;
    }

    public function dbBase($tname){
        return  new dbbase($this->db, $tname);
    }
    //make new token
    public function getToken(){
        return $this->getguids('newtok');
    }

    public function getYear(){
        return 2562;
    }

    public function getguids($cd){
        return md5(microtime(true).$cd);
    }
    //Admin Session Check
    public function check_level($type = "all"){
        // $this->session->set_userdata('username', 'John Doe');

        if (!$this->session->userdata('is_user_login')) {
            redirect('main' , 'refresh');
        }

        $this->sethistory(1);
    }

    public function sethistory($type){

        $db_his = $this->dbBase("history");
        
         $time = date('H:i:s', strtotime('-1 hour'));
         $c_date = date("Y-m-d");
         $check = $c_date." ".$time;

         $ip = $this->getIP();
         $date = date("Y-m-d H:i:s");
         
        $c_add = $db_his->selone("","where ipaddress ='$ip' and datehis  BETWEEN '$check' and '$date' and type = 1 ");
        
        if(!$c_add){
            $upd['ipaddress'] = $ip;
            $upd['datehis'] = $date;
            $upd['type'] = $type;

            $db_his->ins($upd);
        }
    }

    public function setnumber($data){

        if($data['num'] == ""){
            return $num = 0;
        }else{
            return $num = $data['num'];
        }

    }

    //Admin Session Check
    public function check_level2($type,$c_level){
        if($type == 'root'){
            if($c_level != 'root'){
                echo "คุณไม่มีสิทธิ์เข้าถึง ...";
            }
        }
    }
    //GET HTTP Param
    public function gd($key = ''){
        if($key){
            return $this->input->get($key);
        }else{
            return $this->input->get();
        }
        
    }
    //POST HTTP Param
    public function pd($key = ''){
        if($key){
            return $this->input->post($key);
        }else{
            return $this->input->post();
        }
    }
    //SESSION User Data Param
    public function sess_user($key){
        return $this->session->userdata($key);
    }

    public function createCode(){

        $db_complaint = $this->dbBase("complaint");
        $db_company = $this->dbBase("company");
        $c_id = $db_complaint->selone("MAX(SUBSTR(code,-6))+1 as maxid","where 1");

        $type = $db_company->selone("key_title","where ind = '1' ");

        if($c_id["maxid"] == ""){
            $id = $type["key_title"]."000001";
        }else{
            $std_id="".sprintf("%06d",$c_id["maxid"]);
            $id = $type["key_title"]."".$std_id;
        }

        return $id;
    }

    public function setPrice($price){
        $total = "";
        $price2 = explode(",",$price);
        foreach ($price2 as $value) {
            $total .= $value;
        }

        return $total;
    }

    public function getunit($id){
        $db = $this->dbBase("unit");
        $uname = $db->selone("name","where ind ='$id' ");
        $name =$uname['name'];
        
        return $name;
    }

    public function getcomplainttype($type){
        $db = $this->dbBase("complaint_type");
        $uname = $db->selone("name","where ind ='$type' ");
        $name =$uname['name'];
        
        return $name;
    }

    public function getcomplaintsub($type=""){
        $db = $this->dbBase("complaint_sub");
        $uname = $db->selone("name","where ind ='$type' ");
        if($uname){
            $name =$uname['name'];
        }else{
            $name = "";
        }
        
        return $name;
    }

    public function getIP(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return  $ipaddress;
    }

    public function getfulldate($prov, $amp, $dis, $zipcode){
        $db_prov = $this->dbBase("th_province");
        $db_amp = $this->dbBase("th_amphur");
        $db_dis = $this->dbBase("th_district");
        $data = "";

        if($dis){
            $name = $db_dis->selone("district_name","where district_id = '$dis' ");
            $data .=" ตำบล".$name["district_name"];
        }

        if($amp){
            $name = $db_amp->selone("amphur_name","where amphur_id = '$amp' ");
            $data .=" อำเภอ".$name["amphur_name"];
        }

        if($prov){
            $name = $db_prov->selone("province_name","where province_id = '$prov' ");
            $data .=" จังหวัด".$name["province_name"];
        }
        
        if($zipcode){
            $data .=" ".$zipcode;
        }

        return $data;
    }



    public function getDateThis($data){

        $year = substr($data,0,4);
        $mon = substr($data,5,2);
        $date = substr($data,8,2);

        $y = substr($year+543,-2);
        $d = $date+1-1;
        $m = $this->getMonTh($mon);
        

        return $d." ".$m." 25".$y;
    }

    public function getDateThis4($data){

        $year = substr($data,0,4);
        $mon = substr($data,5,2);
        $date = substr($data,8,2);

        $y = substr($year+543,-2);
        $d = $date+1-1;
        $m = $this->getMonTh($mon);
        

        return $d." ".$m." ".$y;
    }

    public function getDateThis2($data){

        $year = substr($data,0,4);
        $mon = substr($data,5,2);
        $date = substr($data,8,2);

        $y = $year+543;
        $d = $date+1-1;
        $m = $mon+1-1;
        

        return $d."/".$m."/".$y;
    }

    public function getDateThis3($data){

        $year = substr($data,0,4);
        $mon = substr($data,5,2);
        $date = substr($data,8,2);

        $y = substr($year+543,-2);
        $d = $date+1-1;
        $m = $this->getMonThfull($mon);
        

        return $d." เดือน ".$m." พ.ศ. 25".$y;
    }

    public function getMonTh($mon){
        $c_m = $mon-1;

        $c_mon = array("ม.ค.", "ก.พ.", "มี.ค." ,"เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $m = $c_mon[$c_m];

        return $m;
    }

    public function getMonThfull($mon){
        $c_m = $mon-1;

        $c_mon = array("มกราคม", "กุมภาพันธ์", "มีนาคม" ,"เมษายน","พฤษภาคม","มิถุยายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $m = $c_mon[$c_m];

        return $m;
    }

    function DateDiff($strDate1,$strDate2)
    {
        $strDate1  = substr($strDate1,0,10);
        $strDate2  = substr($strDate2,0,10);
        return (strtotime($strDate2) - strtotime($strDate1))/ ( 60 * 60 * 24 ); // 1 day = 60*60*24
    }

    function logmail($token,$status=2){

        $db_complaint = $this->dbBase("complaint");
        $db_mail = $this->dbBase("log_mail");
        $c_data  = $db_complaint->selone("email","where token ='$token' ");
        if($c_data['email']){

            $upd['rtoken'] = $token;
            $upd['email'] = $c_data['email'];
            $upd['status'] = $status;
            $upd['type'] = 1;
            $db_mail->ins($upd);
        }

    }


    public function sendMail($address = "", $subject = "", $body = "", $nameto="" ) {
        $mail = new PHPMailer(true);

        if($nameto==""){
            $nameto = $address;
        }

        $mail->isSMTP();
        try {
            $mail->SMTPDebug = 0;
            $mail->Encoding = "quoted-printable";
            $mail->CharSet = "utf-8";
            $mail->SMTPSecure = "tls";
            $mail->Host = "smtp.gmail.com";
            $mail->Port = "587";
            $mail->SMTPAuth = true;
            $mail->Username = "pr.sec.moph@gmail.com";
            $mail->Password = "pr.sec.moph@1234";
            $mail->addReplyTo("pr.sec@dmh.mail.go.th", "ศูนย์รับเรื่อองเรียน กรมสุขภาพจิต");
            $mail->addAddress($address, $nameto);
            $mail->setFrom("pr.sec@dmh.mail.go.th", "ศูนย์รับร้องเรียน กรมสุขภาพจิต");
            $mail->Subject = $subject;
            $mail->msgHTML($body);
            $mail->isHTML(true);
            $mail->Send();
            return "ok";
        }
        catch (phpmailerException $e) {
            return "error";
        }
        catch (Exception $e) {
            return "error";
        }
    }

    function sendLineGroupAdmin($token = "", $type = ""){
    // function sendLineGroup($token = "", $type = ""){

        $db_company = $this->dbBase("company");
        $db_complaint = $this->dbBase("complaint");

        $chcek_auth = $db_company->selone("user_line, token_line","where ind = 1 ");
        if($chcek_auth["user_line"] == "on" and $token ){
            $lineapi = $chcek_auth['token_line'];

            if($type==2){
                $data = $db_complaint->selone("ind,code, date_add","where token = '$token' ");

                 $message = "มีการแจ้งเรื่องร้องเรียน\n";
                 $message .= "รหัสเรื่อง ".$data["code"]."\n";
                 $message .= " ".$data["date_add"];
            }

            if($type==3){
                //หน่วยตอบ comment
                $data = $db_complaint->selone("ind,code, receive_date","where token = '$token' ");
                $message = "หน่วยแจ้งสถานะการดำเนินการ\n";
                 $message .= "รหัสเรื่อง ".$data["code"]."\n";
                 $message .= " ".$data["receive_date"];
            }

            if($type==4){
                $data = $db_complaint->selone("ind, code, receive_date","where token = '$token' ");
                $message = "หน่วยรับเรื่องร้องเรียน แล้ว\n";
                 $message .= "รหัสเรื่อง ".$data["code"]."\n";
                 $message .= " ".$data["receive_date"];
            }

            if($type==5){
                $data = $db_complaint->selone("ind,code, receive_date","where token = '$token' ");
                $message = "หน่วยดำเนินการแก้ไขเรื่องร้องเรียน เรียบร้อยแล้ว\n";
                 $message .= "รหัสเรื่อง ".$data["code"]."\n";
                 $message .= " ".$data["receive_date"];
            }


            try {
                // $message = $gd['message'];
                // $lineapi = $gd['token'];
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
                // echo $result;
                $this->saveLogLine($data['ind'],$result, date("Y-m-d H:i:s"), 1);
            } catch (Exception $e) {
                $error = json_encode('Caught exception: ',  $e->getMessage(), "\n");
                $this->saveLogLine($data['ind'],$error, date("Y-m-d H:i:s"), 1);
            }

        }
        
    }


    public function sendLineGroupUser($token ="", $type=""){
        // public function sendLine($token ="", $type=""){sendLineGroupAdmin
        $db_complaint = $this->dbBase("complaint");
        $db_unit = $this->dbBase("unit");
        $db_user = $this->dbBase("user_info");
        $db_line = $this->dbBase("line_groups");

        $c_unit = $db_complaint->selone("ind, office_unit, code, send_unit", "where token = '$token' ");
        if(!$c_unit){
            exit();
        }
        $unit_id = $c_unit["send_unit"];
        $code  = $c_unit["code"];
   
        if($type =="3"){
            $msg = "เรื่องร้องเรียน กรุณารับเรื่องร้องเรียน\nรหัสเรื่อง ".$code;
            //$arrPostData['messages'][0]['text'] .= "\n".base_url();
        }

        if($type == 2){
            //หน่วยถาม คอมเม้น
            $msg = "ศูนย์ร้องเรียนติดตาม ขั้นตอนการดำเนินการ\nรหัสเรื่อง ".$code;
        }

        if($type == 6){
            //admin confirm
            $msg = "ตอบข้อร้องเรียนเสร็จสิ้นแล้ว\nรหัสเรื่อง ".$code;
        }
        
        $user = $db_line->select("token,type","where unit = '$unit_id' and is_use = '1' ");
        foreach ($user as $key => $value) {
            if($value['token']){

                try {
			
                    $message = $msg;
                    $lineapi = $value['token'];
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
                    // echo $result;
                    $this->saveLogLine($c_unit['ind'],$result, date("Y-m-d H:i:s"), 2);
                } catch (Exception $e) {
                    $error = json_encode('Caught exception: ',  $e->getMessage(), "\n");
                    $this->saveLogLine($c_unit['ind'],$error, date("Y-m-d H:i:s"), 2);
                }
            }
           
        }
    }

    public function saveLogLine($complanint_id, $meagess, $date_send, $status){
        $db_log_line = $this->dbBase("log_line");

        $upd['complanint_id'] = $complanint_id;
        $upd['meagess'] = $meagess;
        $upd['date_send'] = $date_send;
        $upd['status'] = $status; //1 admin // 2  unit //3 test

        $db_log_line->ins($upd);
    }

    public function send_sms($otp , $msisdn){

        $username = "nkbbpro99";
        $password = "bV8a!3Sq@%";
        $message = "ระบบแจ้งเตือน ศูนย์รับเรื่องร้องเรียน กรมสุขภาพจิต รหัสยืนยันOTP: ".$otp." มีอายุใช้งาน 15 นาที";
        $sender = "SMS";
        $ScheduledDelivery = date("YmdHis");
        $force = "standard";

        if($msisdn){
            $result = sms::send_sms($username,$password,$msisdn,$message,$sender,$ScheduledDelivery,$force);
        }
        echo $result;
    }

    public function getMethodComplaint($type){
        if($type == 1){
            $name = 'ระบบรับเรื่องร้องร้องเรียน';
        }else if($type == 2){
            $name = 'ร้องเรียนด้วยตนเอง';
        }else if($type == 3){
            $name = 'ตู้รับความคิดเห็น';
        }else if($type == 4){
            $name = 'จดหมาย';
        }else if($type == 5){
            $name = 'โทรศัพท์';
        }else if($type == 6){
            $name = 'อีเมล';
        }else{
            $name = 'อื่นๆ';
        }

        return $name;
    }

    public function getStatusComplaint($type, $type_name = 'name'){
        $name = '';
        $color = '';

        if($type == 0){
            $name = 'ไม่ใช่/แจ้งกลับ';
            $color = '';
        }else if($type == 1){
            $name = 'แจ้งเรื่องร้องเรียน';
            $color = '';
        }else if($type == 2){
            $name = 'รอศูนย์รับเรื่องร้องเรียน (ตรวจสอบ)';
            $color = '';
        }else if($type == 3){
            $name = 'ส่งให้หน่วยดำเนินการ';
            $color = '';
        }else if($type == 4){
            $name = 'หน่วยกำลังดำเนินการ';
            $color = '';
        }else if($type == 5){
            $name = 'รอศูนย์รับเรื่องร้องเรียน (ตรวจสอบ/ยุติเรื่อง)';
            $color = '';
        }else if($type == 6){
            $name = 'ยุติเรื่อง';
            $color = '';
        }else{
            $name = 'ผิดพลาด';
            $color = '';
        }

        if($type_name == 'name'){
            return $name;
        }else if($type_name == 'color'){
            return $color;
        }else{
            return '';
        }
        
    }



}


?>

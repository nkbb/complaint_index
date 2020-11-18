<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once './application/libraries/CIBase.php';

class Questionnaire extends CIBase {


	public function index()
	{
		$this->check_level('root');
		$db_vote = $this->dbBase('question_vote');
		$db_question = $this->dbBase('question');
		$db_detial = $this->dbBase('question_detial');

		$data['sex1'] = $db_vote->selone("count(ind) as ct","where sex = 1"); 
		$data['sex2'] = $db_vote->selone("count(ind) as ct","where sex = 2"); 

		$data['age1'] = $db_vote->selone("count(ind) as ct","where age < 20 ");
		$data['age2'] = $db_vote->selone("count(ind) as ct","where age <= 30 and age >= 20 ");
		$data['age3'] = $db_vote->selone("count(ind) as ct","where age <= 40 and age > 30 ");
		$data['age4'] = $db_vote->selone("count(ind) as ct","where age <= 40 and age > 50 ");
		$data['age5'] = $db_vote->selone("count(ind) as ct","where age > 50");

		$data['qua1'] = $db_vote->selone("count(ind) as ct","where qualification = 1 ");
		$data['qua2'] = $db_vote->selone("count(ind) as ct","where qualification = 2 ");
		$data['qua3'] = $db_vote->selone("count(ind) as ct","where qualification = 3");
		$data['qua4'] = $db_vote->selone("count(ind) as ct","where qualification = 4 ");

		$data['work1'] = $db_vote->selone("count(ind) as ct","where work = 1 ");
		$data['work2'] = $db_vote->selone("count(ind) as ct","where work = 2 ");
		$data['work3'] = $db_vote->selone("count(ind) as ct","where work = 3 ");
		$data['work4'] = $db_vote->selone("count(ind) as ct","where work = 4 ");
		$data['work5'] = $db_vote->selone("count(ind) as ct","where work = 5 ");
		$data['work6'] = $db_vote->selone("count(ind) as ct","where work = 6 ");

		$data['item'] = $db_question->select("ind,name","where type = 1 order by orders ASC ");
		foreach ($data['item'] as $key => $value) {
			$id = $value['ind'];
			$score1 = $db_detial->selone("count(ind) as ct ","where ques = '$id' and score = 1 ");
			$score2 = $db_detial->selone("count(ind) as ct ","where ques = '$id' and score = 2 ");
			$score3 = $db_detial->selone("count(ind) as ct ","where ques = '$id' and score = 3 ");
			// $score4 = $db_detial->selone("count(ind) as ct ","where ques = '$id' and score = 4 ");
			$data['item'][$key]['data'] = $score1['ct'].",".$score2['ct'].",".$score3['ct'];

		}

		$this->load->view('question', $data);
		
	}

	public function assessment()
	{

		$db_question = $this->dbBase('question');

		$data['item'] = $db_question->select("","where type = 1 order by orders ASC ");
		$this->load->view('question_assessment', $data);
		
	}

	public function save(){
		$pd = $this->pd();
		$db_vote = $this->dbBase('question_vote');
		$db_detail = $this->dbBase('question_detial');

		$upd = $pd;
		$upd['token'] = $this->getToken();
		$upd['ip'] = $this->getIP();
		$upd['date_add'] = date("Y-m-d H:i:s");
		$db_vote->ins($upd);

		foreach ($pd['choice'] as $key => $value) {

			$upc['rtoken'] = $upd['token'];
			if($value){
				$upc['score'] = (int)$value;
			}else{
				$upc['score'] = 3;	
			}
			$upc['ques'] = $key;

		
			$db_detail->ins($upc);
		}
		redirect('questionnaire/finish', 'refresh');
	}

	public function saveques(){
		$pd = $this->pd();
		$db_vote = $this->dbBase('question_vote');
		$db_detail = $this->dbBase('question_detial');

		$upd = $pd;
		$upd['token'] = $this->getToken();
		$upd['ip'] = $this->getIP();
		$upd['date_add'] = date("Y-m-d H:i:s");
		$db_vote->ins($upd);

		foreach ($pd['choice'] as $key => $value) {

			$upc['rtoken'] = $upd['token'];
			if($value){
				$upc['score'] = (int)$value;
			}else{
				$upc['score'] = 3;	
			}
			$upc['ques'] = $key;

		
			$db_detail->ins($upc);
		}
		
		echo 'ok';
	}


	public function finish(){
		$this->load->view('question_finish');
	}



	

	
}
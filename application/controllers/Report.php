<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once './application/libraries/CIBase.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends CIBase {

	public function index()
	{
		$this->check_level();
		$data = array();
		$this->load->view('report', $data);
		
	}

	public function chart_main(){

		$db_type = $this->dbBase("complaint_type");
		$db_complaint = $this->dbBase("complaint");
		$item = $db_type->select("ind,name","where 1 order by ind ASC ");

		foreach ($item as $key => $value) {
			$data['item'][$key]['name'] = $value["name"];
			$id = $value["ind"];

			$ii = -30;
	        for($i=0;$i<15;$i++){

	        	$ii = $ii +2 ;
            	$day = date("Y-m-d", strtotime($ii." day"));

            	$start_day = $day." 00:00:00";
            	$end_day = $day." 23:59:59";

            	$count = $db_complaint->selone("count(ind) as num","where complaint_type = '$id' and date_add between '$start_day' and '$end_day' and type != 1 ");

	        	$data['item'][$key]['data'][$i] = (float)$count['num'];
	        }
		}

		$ii = -30;
        for($i=0;$i<15;$i++){
            $ii = $ii +2 ;
            $day = date("Y-m-d", strtotime($ii." day"));
            $data["categories"][$i]= $this->getDateThis4($day);
        }
		echo json_encode($data);
	}

	public function unit(){
		$this->check_level();
		// echo 'unit';
		$data = array();
		$data['unit'] = $this->session->userdata('unit');
		$this->load->view('report_unit', $data);
	}

	public function reportMethod(){
		$gd = $this->gd();

		if(isset($gd['unit']) && !empty($gd['unit'])){
			$wh = "and send_unit = '$gd[unit]' ";
		}else{
			$wh = "";
		}

		$db_method = $this->dbBase("complaint_method");
		$db_complanit = $this->dbBase("complaint");

		$method_type = $db_method->select("ind,name","where type !=0 order by num ASC ");
		$sum_total = $db_complanit->selone('count(ind) as ct',"where type != 1 $wh");
		$chart = array();
		foreach($method_type as $k => $v){
			$id = $v['ind'];
			$total = $db_complanit->selone('count(ind) as ct',"where complaint_method = '$id' and type != 1 $wh");
			$method_type[$k]['total'] = $total['ct'];
			$method_type[$k]['percen'] = number_format( ($total['ct']*100) / $sum_total['ct'], 2);

			array_push($chart, array('name'=>$v['name'], 'y'=> (float)number_format( ($total['ct']*100) / $sum_total['ct'], 2) ));
			
		}

		$data['item'] = $method_type;
		$data['sum'] = $sum_total['ct'];
		$data["chart"] = $chart;
		echo json_encode($data);

	}

	public function reportType(){
		$gd = $this->gd();

		if(isset($gd['unit']) && !empty($gd['unit'])){
			$wh = "and send_unit = '$gd[unit]' ";
		}else{
			$wh = "";
		}

		$db_type = $this->dbBase("complaint_type");
		$db_sub = $this->dbBase("complaint_sub");
		$db_complanit = $this->dbBase("complaint");

		$complaint_type = $db_type->select("ind,name,type","where type !=0 order by num ASC ");
		$sum_total = $db_complanit->selone('count(ind) as ct',"where type != 1 $wh");
		$chart = array();
		foreach($complaint_type as $k => $v){
			$id = $v['ind'];
			$total = $db_complanit->selone('count(ind) as ct',"where complaint_type = '$id' and type != 1 $wh");
			$complaint_type[$k]['total'] = $total['ct'];
			$complaint_type[$k]['percen'] = number_format( ($total['ct']*100) / $sum_total['ct'], 2);

			$complaint_sub = $db_sub->select("ind,name","where complaint_type = '$id' order by num ASC");
			foreach($complaint_sub as $k_sub => $v_sub){
				$id_sub = $v_sub['ind'];
				$total_sub = $db_complanit->selone('count(ind) as ct',"where complaint_sub = '$id_sub' and type != 1 $wh");
				$complaint_sub[$k_sub]['total'] = $total_sub['ct'];
				$complaint_sub[$k_sub]['percen'] = number_format( ($total_sub['ct']*100) / $sum_total['ct'], 2);
			}

			$complaint_type[$k]['sub'] = $complaint_sub;
			array_push($chart, array('name'=>$v['name'], 'y'=> (float)number_format( ($total['ct']*100) / $sum_total['ct'], 2) ));
			
		}


		$data['item'] = $complaint_type;
		$data['sum'] = $sum_total['ct'];
		$data["chart"] = $chart;
		echo json_encode($data);

	}

	public function reportPerson(){
		$gd = $this->gd();

		if(isset($gd['unit'])){
			$wh = "and send_unit = '$gd[unit]' ";
		}else{
			$wh = "";
		}

		$db_tyep_person = $this->dbBase("complaint_person");
		$db_complanit = $this->dbBase("complaint");

		$person_type = $db_tyep_person->select("ind,name","where type !=0 order by num ASC ");
		$sum_total = $db_complanit->selone('count(ind) as ct',"where type != 1 $wh");
		$chart = array();
		foreach($person_type as $k => $v){
			$id = $v['ind'];
			$total = $db_complanit->selone('count(ind) as ct',"where complaint_person = '$id' and type != 1 $wh");
			$person_type[$k]['total'] = $total['ct'];
			$person_type[$k]['percen'] = number_format( ($total['ct']*100) / $sum_total['ct'], 2);

			array_push($chart, array('name'=>$v['name'], 'y'=> (float)number_format( ($total['ct']*100) / $sum_total['ct'], 2) ));
			
		}

		$data['item'] = $person_type;
		$data['sum'] = $sum_total['ct'];
		$data["chart"] = $chart;
		echo json_encode($data);
	}

	public function reportCease(){
		$gd = $this->gd();

		if(isset($gd['unit'])){
			$wh = "and send_unit = '$gd[unit]' ";
		}else{
			$wh = "";
		}

		$db_complanit = $this->dbBase("complaint");

		$type[0]['name'] = 'ยิตุเรื่อง';
		$type[0]['ind'] = 0;
		$type[1]['name'] = 'อยู่ระหว่างดำเนินการ';
		$type[1]['ind'] = 1;
		// array_push($type, array('name'=> 'อยู่ระหว่างดำเนินการ', 'ind'=>1));

		$sum_total = $db_complanit->selone('count(ind) as ct',"where type != 1 $wh");
		$chart = array();
		foreach($type as $k => $v){
			$id = $v['ind'];

			if($id == 0){
				$total = $db_complanit->selone('count(ind) as ct',"where (type= 0 or type = 5 or type = 6 )  $wh");
			}else{
				$total = $db_complanit->selone('count(ind) as ct',"where ( type = 2 or type =3 or type =4) $wh");
			}
			
			$type[$k]['total'] = $total['ct'];
			$type[$k]['percen'] = number_format( ($total['ct']*100) / $sum_total['ct'], 2);

			array_push($chart, array('name'=>$v['name'], 'y'=> (float)number_format( ($total['ct']*100) / $sum_total['ct'], 2) ));
			
		}

		$data['item'] = $type;
		$data['sum'] = $sum_total['ct'];
		$data["chart"] = $chart;
		echo json_encode($data);
	}

	public function reportOffice(){
		$gd = $this->gd();

		if(isset($gd['unit'])){
			$wh = "and send_unit = '$gd[unit]' ";
		}else{
			$wh = "";
		}

		$db_unit = $this->dbBase("unit");
		$db_complanit = $this->dbBase("complaint");

		$report_unit = $db_unit->select("ind,name","where type !=0 order by ind ASC ");
		$sum_total = $db_complanit->selone('count(ind) as ct',"where type != 1 ");
		$chart = array();
		foreach($report_unit as $k => $v){
			$id = $v['ind'];
			$total = $db_complanit->selone('count(ind) as ct',"where send_unit = '$id' and type != 1 ");
			$report_unit[$k]['total'] = $total['ct'];
			$report_unit[$k]['percen'] = number_format( ($total['ct']*100) / $sum_total['ct'], 2);

			array_push($chart, array('name'=>$v['name'], 'y'=> (float)number_format( ($total['ct']*100) / $sum_total['ct'], 2) ));
			
		}

		$data['item'] = $report_unit;
		$data['sum'] = $sum_total['ct'];
		$data["chart"] = $chart;
		echo json_encode($data);
	}


	public function method(){
		$this->check_level();
		$data = array();
		$this->load->view('report_method', $data);
	}

	public function office(){
		$this->check_level();
		$data = array();
		$this->load->view('report_office', $data);
	}

	public function excel(){
		$this->check_level();
		$data = array();


		$db_complanit_type = $this->dbBase("complaint_type");
		$data['type'] = $db_complanit_type->select("ind,name","where type != 0 order by num ASC");

		$this->load->view('report_excel', $data);
	}
	
	public function exportExcel(){
		$this->check_level();
		$wh = " ";
		$type = $this->input->get('type');
		$date_from = $this->input->get('date_from');
		$date_to = $this->input->get('date_to');

		if(!empty($type)){
			$wh .= "and complaint_type  = '$type' ";
		}

		if(!empty($date_from) && !empty($date_to) ){
			$from = $date_from.' 00:00:00';
			$to = $date_to.' 23:59:59';
			$wh .= "and date_add  BETWEEN '$from' and '$to' ";
		}

		$db_complanit = $this->dbBase("complaint");
		$db_complaint_method = $this->dbBase("complaint_method");
		$db_complaint_person = $this->dbBase("complaint_person");
		$db_complaint_type = $this->dbBase("complaint_type");
		$db_complaint_sub = $this->dbBase("complaint_sub");
		$db_unit = $this->dbBase("unit");
	
		$spreadsheet = new Spreadsheet();
		$spreadsheet->getDefaultStyle()->getFont()->setName('TH SarabunPSK');
		// set default font size
		$spreadsheet->getDefaultStyle()->getFont()->setSize(14);
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setTitle('ทะเบียนรวม');
		$sheet->setCellValue('A3', 'รหัสเรื่อง');
		$sheet->setCellValue('B3', 'วันที่บันทึก');
		$sheet->setCellValue('C3', 'ประเภทช่องทาง');
		$sheet->setCellValue('D3', 'ผู้ถูกร้องเรียน');
		$sheet->setCellValue('E3', 'ประเด็นข้อร้องเรียน');
		$sheet->setCellValue('F3', 'หน่วยที่เกี่ยวข้อง');
		$sheet->setCellValue('G3', 'เรื่องที่ร้องเรียน');
		$sheet->setCellValue('H3', 'รายละเอียดเรื่องที่ร้องเรียน');
		$sheet->setCellValue('I3', 'สิ่งที่ต้องการให้แก้ไข');
		$sheet->setCellValue('J3', 'เอกสารประกอบ');
		$sheet->setCellValue('K3', 'ระดับความรุนแรง');
		$sheet->setCellValue('L3', 'หน่วยงานที่รับผิดชอบ/สถานที่ส่ง');
		$sheet->setCellValue('M3', 'วันที่ส่งเรื่องให้หน่วย');
		$sheet->setCellValue('N3', 'วันที่หน่วยรับเรื่อง');
		$sheet->setCellValue('O3', 'วิธีการแก้ไขผลการดำเนินการ');
		$sheet->setCellValue('P3', 'เอกสารแนบ');
		$sheet->setCellValue('Q3', 'วันที่ดำเนินการแก้ไข');
		$sheet->setCellValue('R3', 'สถานะเรื่อง');
		$sheet->getStyle('A3:R3')->getFont()->setBold(true);

		$item = $db_complanit->select("","where type != 1 $wh order by ind ASC ");
		$numrow = 4;
		foreach($item as $v){

			$sheet->setCellValue('A'.$numrow, $v['code']);
			$sheet->setCellValue('B'.$numrow, $this->getDateThis4($v['date_add']));
			//getDateThis4 

			$mehod = $db_complaint_method->selone("name","where ind = '$v[complaint_method]' ");
			$sheet->setCellValue('C'.$numrow, $mehod['name']);

			$person = $db_complaint_person->selone("name","where ind = '$v[complaint_person]' ");
			$sheet->setCellValue('D'.$numrow, $person['name']);

			//db_complaint_type db_complaint_sub
			$type = $db_complaint_type->selone("num","where ind = '$v[complaint_type]' ");
			if(!empty($v['complaint_sub'])){
				$sub = $db_complaint_sub->selone("num","where ind = '$v[complaint_sub]' ");
				$sheet->setCellValue('E'.$numrow, $type['num'].'.'.$sub['num']);
			}else{
				$sheet->setCellValue('E'.$numrow, $type['num']);
			}

			if(!empty($v['complain_level'])){
				$sheet->setCellValue('K'.$numrow, $v['complain_level']);
			}

			if($v['type'] >= 2){
				$send_unit = $db_unit->selone("name","where ind = '$v[send_unit]' ");
				$sheet->setCellValue('L'.$numrow, $send_unit['name']);
				$sheet->setCellValue('M'.$numrow, $this->getDateThis4($v['send_date']));
			}

			if($v['type'] >= 3){
				$sheet->setCellValue('N'.$numrow, $this->getDateThis4($v['receive_date']));
			}

			if($v['type'] >= 4){
				$sheet->setCellValue('O'.$numrow, $v['answer_detail']);
				$answer_file = (!empty($v['answer_file'])) ? 'มีเอกสาร' : 'ไม่มี';
				$sheet->setCellValue('P'.$numrow, $answer_file);
				$sheet->setCellValue('Q'.$numrow, $this->getDateThis4($v['answer_date']));
				
			}

			$office_unit = $db_unit->selone("name","where ind = '$v[office_unit]' ");
			$sheet->setCellValue('F'.$numrow, $office_unit['name']);

			$sheet->setCellValue('G'.$numrow, $v['name']);
			$sheet->setCellValue('H'.$numrow, $v['description']);
			$sheet->setCellValue('I'.$numrow, $v['improvement']);

			$files = (!empty($v['files'])) ? 'มีเอกสาร' : 'ไม่มี';
			$sheet->setCellValue('J'.$numrow, $files);
			$sheet->setCellValue('R'.$numrow, $this->getStatusComplaint($v['type']));
			

			$numrow++;
		}


		$numrow--;
		$sheet->getStyle('A1:R'.$numrow)
			->getAlignment()->setWrapText(true);
		$sheet->getRowDimension('3')->setRowHeight(50);

		$sheet->getColumnDimension('A')->setWidth('15');
		$sheet->getColumnDimension('B')->setWidth('15');
		$sheet->getColumnDimension('C')->setWidth('15');
		$sheet->getColumnDimension('D')->setWidth('15');
		$sheet->getColumnDimension('E')->setWidth('15');
		$sheet->getColumnDimension('F')->setWidth('15');
		$sheet->getColumnDimension('G')->setWidth('25');
		$sheet->getColumnDimension('H')->setWidth('35');
		$sheet->getColumnDimension('I')->setWidth('35');
		$sheet->getColumnDimension('J')->setWidth('15');
		$sheet->getColumnDimension('K')->setWidth('15');
		$sheet->getColumnDimension('L')->setWidth('25');
		$sheet->getColumnDimension('M')->setWidth('15');
		$sheet->getColumnDimension('N')->setWidth('15');
		$sheet->getColumnDimension('O')->setWidth('35');
		$sheet->getColumnDimension('P')->setWidth('15');
		$sheet->getColumnDimension('Q')->setWidth('15');
		$sheet->getColumnDimension('R')->setWidth('20');

		$styleArray = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '000000'],
				],
			],
		];
		
		$sheet->getStyle('A3:R'.$numrow)->applyFromArray($styleArray);

		$sheet->getStyle('A3:R'.$numrow)
    	->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
		$sheet->getStyle('A3:R'.$numrow)
		->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		

		$writer = new Xlsx($spreadsheet);

		$date = 'file.'.date("YmdHis");
		$writer->save('assets/files/export/'.$date.'.xlsx');
		echo $date;
	}
	
}
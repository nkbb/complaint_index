<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once './application/libraries/CIBase.php';

class Welcome extends CIBase {

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
		echo 'test';
		// $this->load->view('welcome_message');
	}

	function testpdf()
	{
		$this->load->library('pdf');
		$html = 'testing pdf testing pdf';

		$dompdf = new PDF();
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->setPaper('A4');
		$dompdf->render();

		$output = $dompdf->output();
		file_put_contents('assets/pdf/test.pdf', $output);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skor extends CI_Controller {

	function __construct() {
		parent::__construct();
		
        if(!$this->session->userdata('logged_In')){
            redirect('index.php/admin', 'refresh');
        }
        $this->load->model('skorModel');
    }

	public function index($filter = 0) {
		$data['content'] = 'pages/skor';
		//$data['pelamar'] = $this->admModel->view($filter);
		$data['formasi'] = $this->skorModel->formasi();
		$data['pelamar'] = $this->skorModel->formasi($filter);
		$data['filter'] = $filter;
		$this->load->view('pages/index', $data);
	}

	public function cetak($filter = 0){
		$data['formasi'] = $this->skorModel->formasi();
		$data['pelamar'] = $this->skorModel->formasi($filter);
		$data['filter'] = $filter;
		$this->load->view('pages/skor_print', $data);
	}

}

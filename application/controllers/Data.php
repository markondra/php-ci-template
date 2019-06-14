<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

	function __construct() {
		parent::__construct();
		
        if(!$this->session->userdata('logged_In')){
            redirect('index.php/admin', 'refresh');
        }
        $this->load->model('dataModel');
    }

	public function index($filter = 0) {
		$data['content'] = 'pages/data';
		//$data['pelamar'] = $this->dataModel->view($filter);
		$data['formasi'] = $this->dataModel->formasi();
		$data['pelamar'] = $this->dataModel->formasi($filter);
		$data['filter'] = $filter;
		$this->load->view('pages/index', $data);
	}

	public function cetak($filter = 0){
		$data['formasi'] = $this->dataModel->formasi();
		$data['pelamar'] = $this->dataModel->formasi($filter);
		$data['filter'] = $filter;
		$this->load->view('pages/data_print', $data);
	}
}

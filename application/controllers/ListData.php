<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListData extends CI_Controller {

	function __construct() {
		parent::__construct();
		
        if(!$this->session->userdata('logged_In')){
            redirect('index.php/admin', 'refresh');
        }
        $this->load->model('listDataModel');
    }

	public function index($filter = 0) {
		$data['content'] = 'pages/list';
		$data['pelamar'] = $this->listDataModel->view($filter);
		$data['formasi'] = $this->listDataModel->formasi();
		$this->load->view('pages/index', $data);
	}

	public function del($id){
		$result = $this->listDataModel->del($id);
		echo $result;
	}
}

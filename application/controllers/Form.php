<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

	function __construct() {
		parent::__construct();
		
        if(!$this->session->userdata('logged_In')){
            redirect('index.php/admin', 'refresh');
        }
        $this->load->model('formModel');
    }

	public function index() {
		$data['content'] = 'pages/form';
		$data['akreditasi'] = $this->formModel->akreditasi();
		$data['formasi'] = $this->formModel->formasi();
		$this->load->view('pages/index', $data);
	}

	public function save(){
		$result = $this->formModel->save();
		echo $result;
	}
}

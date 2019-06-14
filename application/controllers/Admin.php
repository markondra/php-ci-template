<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
        if(!$this->session->userdata('logged_In')){
            redirect('login', 'refresh');
        }
    }

	public function index() {
		$data['content'] = 'pages/dashboard';
		$this->load->view('pages/index', $data);
	}

	public function logout(){
    	$this->session->sess_destroy();
        redirect('admin');
	}
}
